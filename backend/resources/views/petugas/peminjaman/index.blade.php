<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Peminjaman - Panel Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased">

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col hidden md:flex">

        <div class="p-5 text-xl font-bold tracking-wider border-b border-gray-800">
            PANEL ADMIN
        </div>

        <nav class="flex-1 p-4 space-y-2">

            <a href="{{ route('petugas.peminjaman.index') }}"
               class="block px-4 py-3 rounded-lg bg-gray-800 text-white font-medium">
                Persetujuan Peminjaman
            </a>

            <a href="{{ route('petugas.pengembalian.index') }}"
               class="block px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white">
                Kelola Pengembalian
            </a>

            <a href="#"
               class="block px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white">
                Cetak Laporan
            </a>

        </nav>

        <div class="p-4 border-t border-gray-800 text-sm text-gray-400">
            Logged in as:
            <span class="text-white font-semibold">
                {{ auth()->user()->name }}
            </span>
        </div>

    </aside>


    <!-- MAIN -->
    <div class="flex-1 flex flex-col overflow-y-auto">

        <!-- HEADER -->
        <header class="bg-white shadow-sm h-20 flex items-center justify-between px-8">

            <div class="text-2xl font-semibold text-gray-800">
                Daftar Pengajuan Peminjaman Alat
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold px-5 py-3 rounded-lg">
                    Logout
                </button>
            </form>

        </header>


        <!-- CONTENT -->
        <main class="flex-1 p-8">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                <!-- CARD HEADER -->
                <div class="p-6 border-b border-gray-200 bg-gray-50">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <h2 class="text-xl font-bold text-gray-800">
                            Menunggu Verifikasi Persetujuan
                        </h2>

                        <!-- SEARCH -->
                        <form action="{{ route('petugas.peminjaman.index') }}" method="GET"
                              class="flex">

                            <input
                                type="text"
                                name="search"
                                value="{{ $search ?? '' }}"
                                placeholder="Cari nama peminjam..."
                                class="w-72 px-4 py-3 border border-gray-300 rounded-l-lg focus:outline-none"
                            >

                            <button type="submit"
                                class="px-6 py-3 bg-gray-800 hover:bg-gray-900 text-white font-semibold rounded-r-lg">
                                Cari
                            </button>

                        </form>

                    </div>

                </div>


                <!-- TABLE -->
                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>
                            <tr class="bg-gray-100 text-gray-600 text-sm uppercase tracking-wider">

                                <th class="py-4 px-5 text-left">
                                    PEMINJAM
                                </th>

                                <th class="py-4 px-5 text-left">
                                    TANGGAL PINJAM
                                </th>

                                <th class="py-4 px-5 text-left">
                                    RENCANA KEMBALI
                                </th>

                                <th class="py-4 px-5 text-left">
                                    DETAIL ALAT
                                </th>

                                <th class="py-4 px-5 text-center">
                                    AKSI
                                </th>

                            </tr>
                        </thead>

                        <tbody class="text-gray-700">

                        @forelse($peminjamans as $peminjaman)

                            <tr class="border-t border-gray-200 hover:bg-gray-50">

                                <!-- PEMINJAM -->
                                <td class="py-4 px-5 font-medium text-gray-800">
                                    {{ $peminjaman->user->name ?? '-' }}
                                </td>


                                <!-- TANGGAL PINJAM -->
                                <td class="py-4 px-5">
                                    {{ $peminjaman->tgl_pinjam
                                        ? \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('Y-m-d')
                                        : '-'
                                    }}
                                </td>


                                <!-- RENCANA KEMBALI -->
                                <td class="py-4 px-5">
                                    {{ $peminjaman->tgl_kembali_plan
                                        ? \Carbon\Carbon::parse($peminjaman->tgl_kembali_plan)->format('Y-m-d')
                                        : '-'
                                    }}
                                </td>


                                <!-- DETAIL ALAT -->
                                <td class="py-4 px-5">

                                    @forelse($peminjaman->detailPinjam as $detail)

                                        <div class="flex items-start gap-2 mb-1">

                                            <span>•</span>

                                            <span>
                                                <strong>
                                                    {{ $detail->alat->nama_alat ?? '-' }}
                                                </strong>

                                                (Jumlah: {{ $detail->jumlah }})
                                            </span>

                                        </div>

                                    @empty

                                        <span class="text-gray-400">
                                            Tidak ada alat
                                        </span>

                                    @endforelse

                                </td>


                                <!-- AKSI -->
                                <td class="py-4 px-5 text-center">

                                    <form
                                        action="{{ route('petugas.peminjaman.setujui', $peminjaman->id) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2 rounded-md"
                                        >
                                            Setujui
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5"
                                    class="py-8 px-5 text-center text-gray-500">
                                    Belum ada pengajuan peminjaman.
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </main>

    </div>

</div>

</body>
</html>
