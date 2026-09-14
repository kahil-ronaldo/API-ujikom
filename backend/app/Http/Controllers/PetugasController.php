<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class PetugasController extends Controller
{
    // =========================================================
    // =========================================================
    // DASHBOARD PETUGAS
    // =========================================================

    public function dashboard()
    {
        $totalPeminjaman = Peminjaman::count();
        $menunggu = Peminjaman::where('status', 'diajukan')->count();
        $dipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $dikembalikan = Peminjaman::where('status', 'dikembalikan')->count();
        $telat = Peminjaman::where('status', 'telat')->count();

        $peminjamansTerbaru = Peminjaman::with([
            'user',
            'detailPinjam.alat'
        ])
        ->latest()
        ->take(5)
        ->get();

        return view('petugas.dashboard', compact(
            'totalPeminjaman',
            'menunggu',
            'dipinjam',
            'dikembalikan',
            'telat',
            'peminjamansTerbaru'
        ));
    }

    // KELOLA PEMINJAMAN
    // =========================================================

    // Menampilkan daftar pengajuan peminjaman
    public function indexPeminjaman(Request $request)
    {
        $search = $request->input('search');    

        $peminjamans = Peminjaman::with([
            'user',
            'detailPinjam.alat'
        ])
        ->where('status', 'diajukan')
        ->when($search, function ($query, $search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->get();

        return view(
            'petugas.peminjaman.index',
            compact('peminjamans', 'search')
        );
    }

    // Menyetujui peminjaman
    public function setujuiPeminjaman($id)
    {
        DB::beginTransaction();

        try {
            $peminjaman = Peminjaman::with('detailPinjam')
                ->findOrFail($id);

            // Pastikan masih diajukan
            if ($peminjaman->status !== 'diajukan') {
                DB::rollback();

                return redirect()
                    ->back()
                    ->with(
                        'error',
                        'Peminjaman ini sudah diproses sebelumnya.'
                    );
            }

            // Cek stok terlebih dahulu
            foreach ($peminjaman->detailPinjam as $detail) {
                $alat = Alat::findOrFail($detail->alat_id);

                if ($alat->stok < $detail->jumlah) {
                    DB::rollback();

                    return redirect()
                        ->back()
                        ->with(
                            'error',
                            "Stok alat {$alat->nama_alat} tidak mencukupi."
                        );
                }
            }

            // Ubah status menjadi dipinjam
            $peminjaman->update([
                'status' => 'dipinjam'
            ]);

            // Kurangi stok
            foreach ($peminjaman->detailPinjam as $detail) {
                $alat = Alat::findOrFail($detail->alat_id);

                $alat->stok -= $detail->jumlah;
                $alat->save();
            }

            DB::commit();

            return redirect()
                ->back()
                ->with(
                    'success',
                    'Peminjaman disetujui dan stok alat dikurangi.'
                );

        } catch (Exception $e) {
            DB::rollback();

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Terjadi kesalahan: ' . $e->getMessage()
                );
        }
    }

    // Menolak peminjaman
    public function tolakPeminjaman($id)
    {
        try {
            $peminjaman = Peminjaman::findOrFail($id);

            if ($peminjaman->status === 'diajukan') {

                $peminjaman->delete();

                return redirect()
                    ->back()
                    ->with(
                        'success',
                        'Pengajuan peminjaman berhasil ditolak.'
                    );
            }

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Status peminjaman sudah berubah.'
                );

        } catch (Exception $e) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Terjadi kesalahan: ' . $e->getMessage()
                );
        }
    }


    // =========================================================
    // KELOLA PENGEMBALIAN
    // =========================================================

    // Menampilkan daftar peminjaman yang sedang dipinjam
    public function indexPengembalian(Request $request)
    {
        $search = $request->input('search');

        $pengembalians = Pengembalian::with([
            'peminjaman.user',
            'peminjaman.detailPinjam.alat'
        ])
        
        ->when($search, function ($query, $search) {
            $query->whereHas('peminjaman.user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->get();

        return view(
            'petugas.pengembalian.index',
            compact('pengembalians', 'search')
        );
    }


    // Memproses pengembalian
    public function prosesPengembalian(Request $request, $peminjamanId)
    {
        $request->validate([
            'kondisi_kembali' => 'required|string',
            'denda' => 'nullable|integer|min:0',
        ]);

        DB::beginTransaction();

        try {

            $peminjaman = Peminjaman::with('detailPinjam')
                ->findOrFail($peminjamanId);

            // Pastikan peminjaman sedang dipinjam
            if ($peminjaman->status !== 'dipinjam') {

                DB::rollback();

                return redirect()
                    ->back()
                    ->with(
                        'error',
                        'Peminjaman ini tidak sedang dipinjam.'
                    );
            }

            // Cek apakah sudah pernah dikembalikan
            $sudahKembali = Pengembalian::where(
                'peminjaman_id',
                $peminjaman->id
            )->exists();

            if ($sudahKembali) {

                DB::rollback();

                return redirect()
                    ->back()
                    ->with(
                        'error',
                        'Peminjaman ini sudah memiliki data pengembalian.'
                    );
            }

            // Simpan data pengembalian
            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_kembali' => now(),
                'kondisi_kembali' => $request->kondisi_kembali,
                'denda' => $request->denda ?? 0,
                'user_id' => auth()->id(),
            ]);

            // Ubah status peminjaman
            $peminjaman->update([
                'status' => 'dikembalikan'
            ]);

            // Kembalikan stok alat
            foreach ($peminjaman->detailPinjam as $detail) {

                $alat = Alat::findOrFail($detail->alat_id);

                $alat->stok += $detail->jumlah;

                $alat->save();
            }

            DB::commit();

            return redirect()
                ->back()
                ->with(
                    'success',
                    'Pengembalian berhasil dicatat dan stok alat dipulihkan.'
                );

        } catch (Exception $e) {

            DB::rollback();

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Terjadi kesalahan: ' . $e->getMessage()
                );
        }
    }


    // =========================================================
    // KELOLA LAPORAN
    // =========================================================

    public function cetakLaporan(Request $request)
    {
        $status = $request->input("status");
        $dari = $request->input("dari_tanggal");
        $sampai = $request->input("sampai_tanggal");

        $laporans = Peminjaman::with([
            "user",
            "detailPinjam.alat",
            "pengembalian"
        ])
        ->when($status, function ($query, $status) {
            $query->where("status", $status);
        })
        ->when($dari, function ($query, $dari) {
            $query->whereDate("tanggal_pinjam", ">=", $dari);
        })
        ->when($sampai, function ($query, $sampai) {
            $query->whereDate("tanggal_pinjam", "<=", $sampai);
        })
        ->latest()
        ->get();

        return view("petugas.laporan.cetak", compact(
            "laporans",
            "dari",
            "sampai",
            "status"
        ));
    }

    public function laporan(Request $request)
    {
        return $this->indexLaporan($request);
    }

    public function indexLaporan(Request $request)
    {
        $search = $request->input('search');

        $laporans = Peminjaman::with([
            'user',
            'detailPinjam.alat'
        ])
        ->when($search, function ($query, $search) {

            $query->where(function ($q) use ($search) {

                $q->whereHas('user', function ($user) use ($search) {
                    $user->where(
                        'name',
                        'like',
                        "%{$search}%"
                    );
                })

                ->orWhere(
                    'status',
                    'like',
                    "%{$search}%"
                );
            });

        })
        ->latest()
        ->get();

        return view(
            'petugas.laporan.index',
            compact('laporans', 'search')
        );
    }
}