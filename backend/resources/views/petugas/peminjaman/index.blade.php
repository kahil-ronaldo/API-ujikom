<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Peminjaman - Panel Petugas</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>

* {
    box-sizing: border-box;
}

html, body {
    margin: 0;
    min-height: 100%;
}

body {
    font-family: Inter, ui-sans-serif, system-ui, -apple-system,
        BlinkMacSystemFont, "Segoe UI", sans-serif;
    background: #f3f4f6;
    color: #1e293b;
}

/* SIDEBAR */

.sidebar {
    background: #0f172a !important;
    color: #cbd5e1;
    border-right: 1px solid #1e293b;
    box-shadow: none !important;
}

.sidebar a {
    color: #aebbd0;
    transition: .2s ease;
}

.sidebar a:hover {
    color: white;
    background: #1e293b;
}

.sidebar a.bg-blue-600,
.sidebar a.bg-blue-500 {
    background: #1e293b !important;
    color: white !important;
    box-shadow: none !important;
}

/* HEADER */

header {
    height: 66px !important;
    background: white !important;
    border-bottom: 1px solid #e5e7eb !important;
    box-shadow: none !important;
}

header h2 {
    font-size: 28px !important;
    font-weight: 800 !important;
    color: #1e293b !important;
}

/* MAIN */

main {
    background: #f3f4f6 !important;
}

.p-8,
.lg\:p-8 {
    padding: 32px !important;
}

/* HERO */

.hero-card {
    position: relative;
    min-height: 181px;

    display: flex;
    align-items: center;

    padding: 32px 38px !important;

    overflow: hidden;

    border-radius: 20px !important;

    background:
        radial-gradient(
            circle at 88% 20%,
            rgba(59,130,246,.20),
            transparent 22%
        ),
        radial-gradient(
            circle at 75% 110%,
            rgba(16,185,129,.18),
            transparent 20%
        ),
        #111a31 !important;

    box-shadow:
        0 8px 18px rgba(15,23,42,.13) !important;

    border: none !important;
}

.hero-card::before {
    content: "";
    position: absolute;

    width: 220px;
    height: 220px;

    right: -55px;
    top: -120px;

    border-radius: 50%;

    background: rgba(59,130,246,.12);
}

.hero-card::after {
    content: "";

    position: absolute;

    width: 190px;
    height: 190px;

    right: 170px;
    bottom: -135px;

    border-radius: 50%;

    background: rgba(16,185,129,.12);
}

.hero-card h1 {
    position: relative;
    z-index: 10;

    font-size: 40px !important;
    line-height: 1.1;

    font-weight: 800 !important;

    letter-spacing: -.025em;
}

.hero-card p {
    position: relative;
    z-index: 10;

    color: #94a3b8 !important;
    font-size: 15px !important;
}

/* STATISTIC */

.stat-card {
    min-height: 166px;

    padding: 28px !important;

    border-radius: 20px !important;

    background: white !important;

    border: 1px solid #e5e7eb !important;

    box-shadow:
        0 2px 5px rgba(15,23,42,.05) !important;

    transition: .2s ease;
}

.stat-card:hover {
    transform: translateY(-3px);

    box-shadow:
        0 12px 25px rgba(15,23,42,.08) !important;
}

.stat-card p {
    font-size: 16px !important;
    color: #64748b !important;
}

.stat-card h3 {
    margin-top: 12px !important;

    font-size: 40px !important;
    line-height: 1;

    font-weight: 800 !important;
}

/* TABLE CARD */

.overflow-hidden.rounded-3xl.border.bg-white {
    border-radius: 20px !important;

    background: white !important;

    border: 1px solid #e5e7eb !important;

    box-shadow:
        0 2px 6px rgba(15,23,42,.05) !important;
}

/* SEARCH */

.search-box {
    width: 100% !important;
    max-width: none !important;

    display: flex;

    background: #f8fafc;

    border: 1px solid #e2e8f0;

    border-radius: 15px;

    overflow: hidden;
}

.search-box input {
    background: #f8fafc !important;

    border: none !important;

    outline: none !important;

    font-size: 16px !important;

    padding-top: 15px !important;
    padding-bottom: 15px !important;
}

.search-box input:focus {
    background: white !important;
    box-shadow: none !important;
}

.search-box button {
    min-width: 110px;

    margin: 5px;

    border-radius: 12px !important;

    background: #1e293b !important;

    box-shadow: none !important;

    font-size: 15px;
}

.search-box button:hover {
    background: #0f172a !important;
}

/* TABLE */

table {
    border-collapse: collapse;
}

thead tr {
    background: white !important;

    border-bottom: 1px solid #e5e7eb !important;
}

thead th {
    padding-top: 20px !important;
    padding-bottom: 20px !important;

    color: #64748b !important;

    font-size: 12px !important;

    letter-spacing: .06em !important;
}

tbody tr {
    background: white;

    transition: .2s ease;
}

tbody tr:hover {
    background: #f8fafc !important;
}

tbody td {
    padding-top: 20px !important;
    padding-bottom: 20px !important;

    border-bottom: 1px solid #f1f5f9 !important;
}

/* AVATAR */

tbody td .rounded-full {
    background: #e2e8f0 !important;
    color: #475569 !important;
    box-shadow: none !important;
}

/* SCROLLBAR */

::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 999px;
}

::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* RESPONSIVE */

@media (max-width: 1024px) {

    .hero-card h1 {
        font-size: 32px !important;
    }

    .p-8,
    .lg\:p-8 {
        padding: 24px !important;
    }
}

@media (max-width: 768px) {

    .hero-card {
        min-height: 160px;
        padding: 25px !important;
    }

    .hero-card h1 {
        font-size: 26px !important;
    }

    .stat-card {
        min-height: 135px;
    }

    header h2 {
        font-size: 22px !important;
    }
}

</style>
</head>

<body class="bg-slate-100 text-slate-800">

<div class="flex min-h-screen">

    {{-- ========================================================= --}}
    {{-- SIDEBAR --}}
    {{-- ========================================================= --}}

    <aside class="sidebar fixed left-0 top-0 z-40 h-screen w-72 bg-[#0f172a] text-white shadow-xl">

        {{-- LOGO --}}
        <div class="flex h-24 items-center border-b border-slate-700 px-7">

            <div class="mr-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 shadow-lg shadow-blue-600/30">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-7 w-7"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4m5-5h6"/>
                </svg>
            </div>

            <div>
                <h1 class="text-xl font-bold tracking-wide">
                    PANEL PETUGAS
                </h1>

                <p class="text-xs text-slate-400">
                    Sistem Peminjaman Alat
                </p>
            </div>

        </div>


        {{-- MENU --}}
        <div class="px-4 py-6">

            <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
                Menu Utama
            </p>

            {{-- Dashboard --}}
            <a href="{{ route('petugas.dashboard') }}"
               class="mb-2 flex items-center gap-4 rounded-xl px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 12l9-9 9 9M5 10v10h14V10"/>
                </svg>

                Dashboard
            </a>


            {{-- Peminjaman --}}
            <a href="{{ route('petugas.peminjaman.index') }}"
               class="mb-2 flex items-center gap-4 rounded-xl bg-blue-600 px-4 py-3 font-semibold text-white shadow-lg shadow-blue-600/20">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5h6"/>
                </svg>

                Kelola Peminjaman
            </a>


            {{-- Pengembalian --}}
            <a href="{{ route('petugas.pengembalian.index') }}"
               class="mb-2 flex items-center gap-4 rounded-xl px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 14l-4-4m0 0l4-4m-4 4h11a4 4 0 014 4v1"/>
                </svg>

                Kelola Pengembalian
            </a>


            {{-- Laporan --}}
            <a href="{{ route('petugas.laporan.index') }}"
               class="mb-2 flex items-center gap-4 rounded-xl px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 17v-2m3 2v-6m3 6V9m3 10H6a2 2 0 01-2-2V7a2 2 0 012-2h5l2 2h5a2 2 0 012 2v8a2 2 0 01-2 2z"/>
                </svg>

                Laporan
            </a>

        </div>


        {{-- USER --}}
        <div class="absolute bottom-0 left-0 right-0 border-t border-slate-700 bg-[#0b1220] p-5">

            <div class="mb-4 flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-blue-600 font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="min-w-0">

                    <p class="truncate font-semibold">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-slate-400">
                        {{ ucfirst(auth()->user()->role) }}
                    </p>

                </div>

            </div>


            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit"
                        class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-slate-400 transition hover:bg-red-500/10 hover:text-red-400">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/>
                    </svg>

                    Logout

                </button>

            </form>

        </div>

    </aside>



    {{-- ========================================================= --}}
    {{-- MAIN --}}
    {{-- ========================================================= --}}

    <main class="ml-72 flex-1">


        {{-- TOPBAR --}}
        <header class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-slate-200 bg-white/90 px-8 shadow-sm backdrop-blur">

            <div>
                <p class="text-sm text-slate-400">
                    Panel Petugas
                </p>

                <h2 class="text-xl font-bold text-slate-800">
                    Manajemen Peminjaman
                </h2>
            </div>


            <div class="flex items-center gap-4">

                <div class="hidden text-right sm:block">

                    <p class="text-sm font-semibold">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-slate-400">
                        Petugas
                    </p>

                </div>


                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-600">

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </div>

            </div>

        </header>



        {{-- CONTENT --}}
        <div class="p-6 lg:p-8">


            {{-- HERO --}}
            <div class="relative mb-7 overflow-hidden hero-card rounded-3xl p-8 text-white shadow-xl">

                <div class="relative z-10">

                    <div class="mb-3 flex items-center gap-3">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-7 w-7"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5l2 2h5a2 2 0 012 2v12a2 2 0 01-2 2z"/>
                            </svg>

                        </div>

                        <div>

                            <h1 class="text-2xl font-bold">
                                Pengajuan Peminjaman
                            </h1>

                            <p class="text-sm text-blue-100">
                                Kelola dan verifikasi pengajuan alat dari pengguna.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Decoration --}}
                <div class="absolute -right-10 -top-16 h-64 w-64 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-20 right-24 h-48 w-48 rounded-full bg-white/10"></div>

            </div>



            {{-- STATISTIC --}}
            <div class="mb-7 grid grid-cols-1 gap-5 md:grid-cols-3">

                {{-- Total --}}
                <div class="stat-card p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Total Pengajuan
                            </p>

                            <h3 class="mt-1 text-3xl font-bold text-slate-800">
                                {{ $peminjamans->count() }}
                            </h3>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-6 w-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0"/>
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Menunggu --}}
                <div class="stat-card p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Menunggu Persetujuan
                            </p>

                            <h3 class="mt-1 text-3xl font-bold text-yellow-600">
                                {{ $peminjamans->where('status', 'diajukan')->count() }}
                            </h3>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-100 text-yellow-600">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-6 w-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Status --}}
                <div class="stat-card p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Status Sistem
                            </p>

                            <h3 class="mt-1 text-xl font-bold text-green-600">
                                Sistem Aktif
                            </h3>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100 text-green-600">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-6 w-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>

                        </div>

                    </div>

                </div>

            </div>



            {{-- TABLE CARD --}}
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


                {{-- HEADER TABLE --}}
                <div class="flex flex-col gap-5 border-b border-slate-200 p-6 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <h2 class="text-xl font-bold text-slate-800">
                            Daftar Pengajuan
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Pengajuan yang membutuhkan verifikasi petugas.
                        </p>

                    </div>


                    {{-- SEARCH --}}
                    <form action="{{ route('petugas.peminjaman.index') }}"
                          method="GET"
                          class="search-box flex w-full max-w-md">

                        <div class="relative flex-1">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M21 21l-4.35-4.35m2.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari nama peminjam..."
                                class="w-full rounded-l-2xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-700 outline-none transition duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"
                            >

                        </div>

                        <button
                            type="submit"
                            class="rounded-r-2xl bg-blue-600 px-7 font-semibold text-white shadow-lg shadow-blue-600/20 transition duration-200 hover:bg-blue-700 hover:shadow-blue-600/30 active:scale-95">

                            Cari

                        </button>

                    </form>

                </div>



                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="w-full min-w-[1000px]">

                        <thead>

                            <tr class="border-b border-slate-200 bg-slate-50/80 text-left">

                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Peminjam
                                </th>

                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Alat yang Dipinjam
                                </th>

                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Tanggal Pinjam
                                </th>

                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Rencana Kembali
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                        @forelse($peminjamans as $peminjaman)

                            <tr class="table-row">


                                {{-- PEMINJAM --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-600">

                                            {{ strtoupper(substr($peminjaman->user->name ?? 'U', 0, 2)) }}

                                        </div>


                                        <div>

                                            <p class="font-semibold text-slate-800">

                                                {{ $peminjaman->user->name ?? '-' }}

                                            </p>

                                            <p class="text-xs text-slate-400">

                                                {{ $peminjaman->user->email ?? '-' }}

                                            </p>

                                        </div>

                                    </div>

                                </td>



                                {{-- ALAT --}}
                                <td class="px-6 py-5">

                                    @foreach($peminjaman->detailPinjam as $detail)

                                        <div class="mb-2 last:mb-0">

                                            <p class="font-semibold text-slate-700">

                                                {{ $detail->alat->nama_alat ?? $detail->alat->nama ?? '-' }}

                                            </p>

                                            <p class="text-xs text-slate-400">

                                                {{ $detail->jumlah ?? 1 }} unit

                                            </p>

                                        </div>

                                    @endforeach

                                </td>



                                {{-- TANGGAL PINJAM --}}
                                <td class="px-6 py-5">

                                    <p class="font-medium text-slate-700">

                                        {{ $peminjaman->tanggal_pinjam
                                            ? \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y')
                                            : '-' }}

                                    </p>

                                    @if($peminjaman->tanggal_pinjam)

                                        <p class="text-xs text-slate-400">

                                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('H:i') }}
                                            WIB

                                        </p>

                                    @endif

                                </td>



                                {{-- RENCANA KEMBALI --}}
                                <td class="px-6 py-5">

                                    <p class="font-medium text-slate-700">

                                        {{ $peminjaman->tanggal_kembali
                                            ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y')
                                            : '-' }}

                                    </p>

                                    @if($peminjaman->tanggal_kembali)

                                        <p class="text-xs text-slate-400">

                                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('H:i') }}
                                            WIB

                                        </p>

                                    @endif

                                </td>



                                {{-- STATUS --}}
                                <td class="px-6 py-5 text-center">

                                    @if($peminjaman->status === 'diajukan')

                                        <span class="inline-flex items-center gap-2 rounded-full bg-yellow-100 px-4 py-2 text-xs font-semibold text-yellow-700">

                                            <span class="h-2 w-2 rounded-full bg-yellow-500"></span>

                                            Menunggu Persetujuan

                                        </span>

                                    @elseif($peminjaman->status === 'dipinjam')

                                        <span class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-4 py-2 text-xs font-semibold text-blue-700">

                                            <span class="h-2 w-2 rounded-full bg-blue-500"></span>

                                            Sedang Dipinjam

                                        </span>

                                    @elseif($peminjaman->status === 'dikembalikan')

                                        <span class="inline-flex items-center gap-2 rounded-full bg-green-100 px-4 py-2 text-xs font-semibold text-green-700">

                                            <span class="h-2 w-2 rounded-full bg-green-500"></span>

                                            Dikembalikan

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-xs font-semibold text-slate-600">

                                            {{ ucfirst($peminjaman->status) }}

                                        </span>

                                    @endif

                                </td>



                                {{-- AKSI --}}
                                <td class="px-6 py-5">

                                    @if($peminjaman->status === 'diajukan')

                                        <div class="flex items-center justify-center gap-2">


                                            {{-- SETUJUI --}}
                                            <form action="{{ route('petugas.peminjaman.setujui', $peminjaman->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menyetujui peminjaman ini?')">

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-2 rounded-xl bg-emerald-500 px-4 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-emerald-600 hover:shadow-md">

                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="h-4 w-4"
                                                         fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M5 13l4 4L19 7"/>
                                                    </svg>

                                                    Setujui

                                                </button>

                                            </form>


                                            {{-- TOLAK --}}
                                            <form action="{{ route('petugas.peminjaman.tolak', $peminjaman->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menolak peminjaman ini?')">

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-2 rounded-xl bg-red-500 px-4 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-red-600 hover:shadow-md">

                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="h-4 w-4"
                                                         fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>

                                                    Tolak

                                                </button>

                                            </form>

                                        </div>

                                    @else

                                        <div class="text-center">

                                            <span class="text-xs font-medium text-slate-400">
                                                Tidak ada aksi
                                            </span>

                                        </div>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="px-6 py-16 text-center">

                                    <div class="mx-auto flex max-w-sm flex-col items-center">

                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="h-8 w-8 text-slate-400"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5l2 2h5a2 2 0 012 2v12a2 2 0 01-2 2z"/>
                                            </svg>

                                        </div>

                                        <h3 class="font-semibold text-slate-700">
                                            Belum ada pengajuan
                                        </h3>

                                        <p class="mt-1 text-sm text-slate-400">
                                            Tidak ada pengajuan peminjaman yang ditemukan.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>



                {{-- PAGINATION --}}
                {{-- Pagination tidak digunakan karena $peminjamans berupa Collection --}}

            </div>

        </div>

    </main>

</div>

</body>
</html>