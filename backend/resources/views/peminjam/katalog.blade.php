<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Alat - Peminjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: linear-gradient(135deg, #0f172a, #1e3a8a, #0f172a);
        min-height: 100vh;
        background-attachment: fixed;
    }
    .container {
        position: relative;
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
    }
    .table {
        margin-bottom: 0;
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
            <a class="navbar-brand" href="#">Panel Peminjam</a>
            <div class="d-flex">
                <a href="{{ route('peminjam.riwayat') }}" class="btn btn-outline-light btn-sm me-2">Riwayat Pinjam</a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm text-primary">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <h3 class="mb-3">Katalog Alat Tersedia</h3>

        <form action="{{ route('peminjam.peminjaman.ajukan') }}" method="POST">
            @csrf
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Rencana Tanggal Kembali</label>
                        <input type="date" name="tgl_kembali_plan" class="form-control" required>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="50">Pilih</th>
                                <th>Gambar</th>
                                <th>Nama Alat</th>
                                <th>Kategori</th>
                                <th>Stok Tersedia</th>
                                <th width="150">Jumlah Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alats as $index => $alat)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="alat_id[]" value="{{ $alat->id }}" class="form-check-input">
                                    </td>
                                    <td class="text-center">
                                        @if($alat->gambar)
                                            <img src="{{ asset($alat->gambar) }}" alt="{{ $alat->nama_alat }}" style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px;">
                                        @else
                                            <span class="text-muted">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td>{{ $alat->nama_alat }}</td>
                                    <td>{{ $alat->kategori->nama_kategori ?? '-' }}</td>
                                    <td>{{ $alat->stok }}</td>
                                    <td>
                                        <input type="number" name="jumlah[]" class="form-control form-control-sm" value="1" min="1" max="{{ $alat->stok }}">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada alat yang tersedia saat ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>