@extends('layouts.app')

@section('title', 'Dashboard Petugas')
@section('header-title', 'Dashboard Petugas')

@section('content')

<div class="space-y-6">

    <!-- JUDUL -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            Dashboard Petugas
        </h2>

        <p class="text-gray-500 mt-1">
            Selamat datang, {{ auth()->user()->name }}
        </p>
    </div>


    <!-- STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

        <!-- TOTAL -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">
                Total Peminjaman
            </p>

            <p class="text-3xl font-bold text-gray-800 mt-2">
                {{ $totalPeminjaman }}
            </p>
        </div>


        <!-- MENUNGGU -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">
                Menunggu Persetujuan
            </p>

            <p class="text-3xl font-bold text-yellow-600 mt-2">
                {{ $menunggu }}
            </p>
        </div>


        <!-- DIPINJAM -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">
                Sedang Dipinjam
            </p>

            <p class="text-3xl font-bold text-blue-600 mt-2">
                {{ $dipinjam }}
            </p>
        </div>


        <!-- DIKEMBALIKAN -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">
                Dikembalikan
            </p>

            <p class="text-3xl font-bold text-green-600 mt-2">
                {{ $dikembalikan }}
            </p>
        </div>


        <!-- TELAT -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">
                Terlambat
            </p>

            <p class="text-3xl font-bold text-red-600 mt-2">
                {{ $telat }}
            </p>
        </div>

    </div>


    <!-- PEMINJAMAN TERBARU -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

        <div class="p-5 border-b border-gray-200">
            <div class="flex items-center justify-between">

                <div>
                    <h3 class="text-lg font-bold text-gray-800">
                        Peminjaman Terbaru
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Daftar pengajuan peminjaman terbaru
                    </p>
                </div>

                <a href="{{ route('petugas.peminjaman.index') }}"
                   class="bg-gray-900 hover:bg-gray-800 text-white text-sm font-semibold px-4 py-2 rounded-lg">
                    Lihat Semua
                </a>

            </div>
        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr>
                        <th class="px-5 py-3 text-left font-semibold text-gray-600">
                            No
                        </th>

                        <th class="px-5 py-3 text-left font-semibold text-gray-600">
                            Peminjam
                        </th>

                        <th class="px-5 py-3 text-left font-semibold text-gray-600">
                            Alat
                        </th>

                        <th class="px-5 py-3 text-left font-semibold text-gray-600">
                            Tanggal Pinjam
                        </th>

                        <th class="px-5 py-3 text-left font-semibold text-gray-600">
                            Rencana Kembali
                        </th>

                        <th class="px-5 py-3 text-left font-semibold text-gray-600">
                            Status
                        </th>
                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($peminjamansTerbaru as $index => $peminjaman)

                        <tr class="hover:bg-gray-50">

                            <td class="px-5 py-4">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-5 py-4 font-medium text-gray-800">
                                {{ $peminjaman->user->name ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-gray-600">

                                @forelse($peminjaman->detailPinjam as $detail)
                                    <div>
                                        {{ $detail->alat->nama_alat ?? "-" }}
                                        <span class="text-gray-400">
                                            ({{ $detail->jumlah ?? 0 }})
                                        </span>
                                    </div>
                                @empty
                                    -
                                @endforelse

                            </td>

                            <td class="px-5 py-4 text-gray-600">
                                {{ $peminjaman->tgl_pinjam ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-gray-600">
                                {{ $peminjaman->tgl_kembali_plan ?? '-' }}
                            </td>

                            <td class="px-5 py-4">

                                @if($peminjaman->status === 'diajukan')

                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                        Diajukan
                                    </span>

                                @elseif($peminjaman->status === 'dipinjam')

                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                        Dipinjam
                                    </span>

                                @elseif($peminjaman->status === 'dikembalikan')

                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                        Dikembalikan
                                    </span>

                                @elseif($peminjaman->status === 'telat')

                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                        Telat
                                    </span>

                                @else

                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">
                                        {{ ucfirst($peminjaman->status ?? '-') }}
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="px-5 py-10 text-center text-gray-500">

                                Belum ada data peminjaman.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
