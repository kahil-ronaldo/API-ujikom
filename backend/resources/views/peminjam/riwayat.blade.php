<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: linear-gradient(135deg, #0f172a, #1e3a8a, #0f172a);
        min-height: 100vh;
        background-attachment: fixed;
    }
    h3 {
        color: white;
        font-weight: 700;
        text-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }
    .card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25) !important;
        overflow: hidden;
    }
    .card-header {
        background: #f1f5f9;
    }
    .table {
        background: white;
    }
    .table thead th {
        background: #e2e8f0;
        color: #1e293b;
    }
    .table tbody tr {
        transition: 0.2s;
    }
    .table tbody tr:hover {
        background: #f8fafc;
    }
    .table img {
        transition: transform 0.2s;
    }
    .table img:hover {
        transform: scale(1.12);
    }
    .navbar {
        box-shadow: 0 4px 15px rgba(0,0,0,0.25);
    }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('peminjam.katalog') }}">Panel Peminjam</a>
        <div class="d-flex">
            <a href="{{ route('peminjam.katalog') }}" class="btn btn-outline-light btn-sm me-2">Katalog Alat</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-light btn-sm text-primary">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container">
    <h3 class="mb-4">Riwayat Peminjaman</h3>

    @forelse($peminjamans as $peminjaman)
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Peminjaman #{{ $peminjaman->id }}</strong>
                <span class="badge bg-primary">{{ ucfirst($peminjaman->status) }}</span>
            </div>

            <div class="card-body">
                <p><strong>Tanggal Pengajuan:</strong> {{ $peminjaman->created_at->format('d-m-Y H:i') }}</p>
                <p><strong>Rencana Pengembalian:</strong> {{ $peminjaman->tgl_kembali_plan ?? '-' }}</p>

                <h6 class="mt-3">Alat yang Dipinjam:</h6>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Alat</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjaman->detailPinjam as $detail)
                            <tr>
                                <td class="text-center">
                                    @if($detail->alat && $detail->alat->gambar)
                                        <img src="{{ asset($detail->alat->gambar) }}"
                                             alt="{{ $detail->alat->nama_alat }}"
                                             style="width:80px;height:60px;object-fit:cover;border-radius:8px;">
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td>{{ $detail->alat->nama_alat ?? '-' }}</td>
                                <td>{{ $detail->jumlah }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada detail alat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada riwayat peminjaman.</div>
    @endforelse
</div>

</body>
</html>
