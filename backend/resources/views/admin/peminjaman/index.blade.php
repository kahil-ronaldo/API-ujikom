@extends('layouts.app')

@section('title', 'Kelola Peminjaman')
@section('header-title', 'Manajemen Peminjaman')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
        HERO HEADER
    ========================================================== --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-950 to-blue-900 px-6 py-7 text-white shadow-xl md:px-8">

        {{-- Background decoration --}}
        <div class="absolute -right-16 -top-20 h-72 w-72 rounded-full bg-white/10"></div>
        <div class="absolute -bottom-32 right-48 h-80 w-80 rounded-full bg-indigo-400/20"></div>
        <div class="absolute right-16 top-20 h-20 w-20 rounded-full bg-blue-300/10"></div>

        <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

            <div class="max-w-2xl">

                <div class="mb-4 flex items-center gap-3">

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/15 text-2xl shadow-inner backdrop-blur">
                        📋
                    </div>

                    <span class="rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-xs font-bold tracking-wide backdrop-blur">
                        PANEL ADMIN
                    </span>

                </div>

                <h1 class="text-3xl font-extrabold tracking-tight md:text-4xl">
                    Manajemen Peminjaman
                </h1>

                <p class="mt-3 text-sm leading-6 text-blue-100 md:text-base">
                    Kelola pengajuan, status peminjaman, dan penggunaan alat
                    dengan lebih mudah dan terorganisir.
                </p>

            </div>


            {{-- Total Data --}}
            <div class="min-w-[190px] rounded-2xl border border-white/10 bg-white/10 px-6 py-5 shadow-lg backdrop-blur">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-medium text-blue-100">
                            Total Data
                        </p>

                        <p class="mt-1 text-4xl font-extrabold">
                            {{ $peminjamans->total() }}
                        </p>

                        <p class="mt-1 text-xs text-blue-100">
                            Data peminjaman
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/10 text-xl">
                        📊
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        NOTIFICATION
    ========================================================== --}}
    @if(session('success'))

        <div class="flex items-start gap-4 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 shadow-sm">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-lg text-emerald-600">
                ✓
            </div>

            <div>
                <p class="font-bold text-emerald-800">
                    Berhasil
                </p>

                <p class="mt-1 text-sm text-emerald-700">
                    {{ session('success') }}
                </p>
            </div>

        </div>

    @endif


    @if(session('error'))

        <div class="flex items-start gap-4 rounded-2xl border border-red-200 bg-red-50 p-4 shadow-sm">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100 text-lg font-bold text-red-600">
                !
            </div>

            <div>
                <p class="font-bold text-red-800">
                    Terjadi Kesalahan
                </p>

                <p class="mt-1 text-sm text-red-700">
                    {{ session('error') }}
                </p>
            </div>

        </div>

    @endif


    {{-- =========================================================
        STATISTICS
    ========================================================== --}}
    @php
        $totalData = $peminjamans->total();
        $diajukan = $peminjamans->where('status', 'diajukan')->count();
        $dipinjam = $peminjamans->where('status', 'dipinjam')->count();
        $dikembalikan = $peminjamans->where('status', 'dikembalikan')->count();
        $telat = $peminjamans->where('status', 'telat')->count();
    @endphp


    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">


        {{-- TOTAL --}}
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-blue-50"></div>

            <div class="relative flex items-start justify-between">

                <div>

                    <p class="text-sm font-semibold text-slate-500">
                        Total Peminjaman
                    </p>

                    <p class="mt-2 text-3xl font-extrabold text-slate-800">
                        {{ $totalData }}
                    </p>

                    <p class="mt-3 text-xs text-slate-400">
                        Seluruh data peminjaman
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-xl transition duration-300 group-hover:scale-110">
                    📊
                </div>

            </div>

        </div>


        {{-- MENUNGGU --}}
        <div class="group relative overflow-hidden rounded-2xl border border-amber-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-amber-50"></div>

            <div class="relative flex items-start justify-between">

                <div>

                    <p class="text-sm font-semibold text-slate-500">
                        Menunggu
                    </p>

                    <p class="mt-2 text-3xl font-extrabold text-amber-600">
                        {{ $diajukan }}
                    </p>

                    <p class="mt-3 text-xs text-slate-400">
                        Menunggu persetujuan
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-xl transition duration-300 group-hover:scale-110">
                    ⏳
                </div>

            </div>

        </div>


        {{-- DIPINJAM --}}
        <div class="group relative overflow-hidden rounded-2xl border border-indigo-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-indigo-50"></div>

            <div class="relative flex items-start justify-between">

                <div>

                    <p class="text-sm font-semibold text-slate-500">
                        Sedang Dipinjam
                    </p>

                    <p class="mt-2 text-3xl font-extrabold text-indigo-600">
                        {{ $dipinjam }}
                    </p>

                    <p class="mt-3 text-xs text-slate-400">
                        Alat sedang digunakan
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-xl transition duration-300 group-hover:scale-110">
                    📦
                </div>

            </div>

        </div>


        {{-- DIKEMBALIKAN --}}
        <div class="group relative overflow-hidden rounded-2xl border border-emerald-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-emerald-50"></div>

            <div class="relative flex items-start justify-between">

                <div>

                    <p class="text-sm font-semibold text-slate-500">
                        Dikembalikan
                    </p>

                    <p class="mt-2 text-3xl font-extrabold text-emerald-600">
                        {{ $dikembalikan }}
                    </p>

                    <p class="mt-3 text-xs text-slate-400">
                        Peminjaman selesai
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-xl transition duration-300 group-hover:scale-110">
                    ✓
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        MAIN TABLE CARD
    ========================================================== --}}
    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


        {{-- TABLE HEADER --}}
        <div class="border-b border-slate-200 bg-slate-50/70 px-5 py-5 md:px-6">

            <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">

                <div>

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                            📋
                        </div>

                        <div>

                            <h2 class="text-xl font-bold text-slate-800">
                                Daftar Peminjaman
                            </h2>

                            <p class="mt-0.5 text-sm text-slate-500">
                                Kelola seluruh data peminjaman alat.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- SEARCH --}}
                <form
                    action="{{ route('admin.peminjaman.index') }}"
                    method="GET"
                    class="flex w-full max-w-xl"
                >

                    <div class="relative flex-1">

                        <svg
                            class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>

                        <input
                            type="text"
                            name="search"
                            value="{{ $search ?? request('search') }}"
                            placeholder="Cari nama peminjam..."
                            class="w-full rounded-l-xl border border-slate-300 bg-white py-3 pl-12 pr-4 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >

                    </div>


                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-r-xl bg-blue-600 px-6 py-3 text-sm font-bold text-white transition hover:bg-blue-700 hover:shadow-md"
                    >

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>

                        Cari

                    </button>

                </form>

            </div>

        </div>


        {{-- =====================================================
            TABLE
        ====================================================== --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1100px]">

                <thead>

                    <tr class="border-b border-slate-200 bg-white">

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Peminjam
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Alat
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Tanggal Pinjam
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
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

                    <tr class="group transition duration-200 hover:bg-slate-50">


                        {{-- =================================================
                            USER
                        ================================================== --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-sm font-bold text-white shadow-sm transition duration-300 group-hover:scale-105">

                                    {{ strtoupper(substr($peminjaman->user->name ?? 'U', 0, 2)) }}

                                </div>


                                <div class="min-w-0">

                                    <p class="truncate font-bold text-slate-800">
                                        {{ $peminjaman->user->name ?? '-' }}
                                    </p>

                                    <p class="mt-1 max-w-[190px] truncate text-xs text-slate-400">
                                        {{ $peminjaman->user->email ?? '-' }}
                                    </p>

                                </div>

                            </div>

                        </td>


                        {{-- =================================================
                            ALAT
                        ================================================== --}}
                        <td class="px-6 py-5">

                            <div class="space-y-3">

                                @forelse($peminjaman->detailPinjam as $detail)

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                            📦
                                        </div>

                                        <div class="min-w-0">

                                            <p class="max-w-[210px] truncate text-sm font-semibold text-slate-700">
                                                {{ $detail->alat->nama_alat ?? '-' }}
                                            </p>

                                            <span class="mt-1 inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-500">
                                                {{ $detail->jumlah }} unit
                                            </span>

                                        </div>

                                    </div>

                                @empty

                                    <span class="text-sm text-slate-400">
                                        Tidak ada alat
                                    </span>

                                @endforelse

                            </div>

                        </td>


                        {{-- =================================================
                            TANGGAL PINJAM
                        ================================================== --}}
                        <td class="px-6 py-5">

                            @if($peminjaman->tgl_pinjam)

                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                        📅
                                    </div>

                                    <div>

                                        <p class="font-semibold text-slate-700">
                                            {{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d M Y') }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('H:i') }} WIB
                                        </p>

                                    </div>

                                </div>

                            @else

                                <span class="text-sm text-slate-400">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- =================================================
                            RENCANA KEMBALI
                        ================================================== --}}
                        <td class="px-6 py-5">

                            @if($peminjaman->tgl_kembali_plan)

                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                                        🕐
                                    </div>

                                    <div>

                                        <p class="font-semibold text-slate-700">
                                            {{ \Carbon\Carbon::parse($peminjaman->tgl_kembali_plan)->format('d M Y') }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ \Carbon\Carbon::parse($peminjaman->tgl_kembali_plan)->format('H:i') }} WIB
                                        </p>

                                    </div>

                                </div>

                            @else

                                <span class="text-sm text-slate-400">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- =================================================
                            STATUS
                        ================================================== --}}
                        <td class="px-6 py-5 text-center">

                            @if($peminjaman->status === 'diajukan')

                                <span class="inline-flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-3.5 py-2 text-xs font-bold text-amber-700">

                                    <span class="h-2 w-2 rounded-full bg-amber-500"></span>

                                    Diajukan

                                </span>

                            @elseif($peminjaman->status === 'dipinjam')

                                <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3.5 py-2 text-xs font-bold text-blue-700">

                                    <span class="h-2 w-2 rounded-full bg-blue-500"></span>

                                    Dipinjam

                                </span>

                            @elseif($peminjaman->status === 'dikembalikan')

                                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3.5 py-2 text-xs font-bold text-emerald-700">

                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                                    Dikembalikan

                                </span>

                            @elseif($peminjaman->status === 'telat')

                                <span class="inline-flex items-center gap-2 rounded-full border border-red-200 bg-red-50 px-3.5 py-2 text-xs font-bold text-red-700">

                                    <span class="h-2 w-2 rounded-full bg-red-500"></span>

                                    Telat

                                </span>

                            @else

                                <span class="inline-flex rounded-full bg-slate-100 px-3.5 py-2 text-xs font-semibold text-slate-600">
                                    {{ ucfirst($peminjaman->status) }}
                                </span>

                            @endif

                        </td>


                        {{-- =================================================
                            ACTION
                        ================================================== --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-2">


                                {{-- UPDATE STATUS --}}
                                <form
                                    action="{{ route('admin.peminjaman.updateStatus', $peminjaman->id) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('PUT')

                                    <select
                                        name="status"
                                        onchange="this.form.submit()"
                                        title="Ubah status"
                                        class="cursor-pointer rounded-xl border border-slate-300 bg-white px-3 py-2 text-xs font-semibold text-slate-700 shadow-sm outline-none transition hover:border-blue-400 hover:bg-blue-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                    >

                                        <option value="diajukan" {{ $peminjaman->status === 'diajukan' ? 'selected' : '' }}>
                                            Diajukan
                                        </option>

                                        <option value="dipinjam" {{ $peminjaman->status === 'dipinjam' ? 'selected' : '' }}>
                                            Dipinjam
                                        </option>

                                        <option value="dikembalikan" {{ $peminjaman->status === 'dikembalikan' ? 'selected' : '' }}>
                                            Dikembalikan
                                        </option>

                                        <option value="telat" {{ $peminjaman->status === 'telat' ? 'selected' : '' }}>
                                            Telat
                                        </option>

                                    </select>

                                </form>


                                {{-- DELETE --}}
                                <form
                                    action="{{ route('admin.peminjaman.destroy', $peminjaman->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        title="Hapus data"
                                        class="flex h-9 w-9 items-center justify-center rounded-xl border border-red-200 bg-red-50 text-red-500 transition duration-200 hover:bg-red-500 hover:text-white hover:shadow-md"
                                    >

                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862A2 2 0 015.867 19.142L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"
                                            />
                                        </svg>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                @empty

                    {{-- EMPTY STATE --}}
                    <tr>

                        <td colspan="6" class="px-6 py-20 text-center">

                            <div class="mx-auto max-w-sm">

                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-3xl">
                                    📭
                                </div>

                                <h3 class="mt-5 font-bold text-slate-700">
                                    Data belum tersedia
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-400">
                                    Belum ada data peminjaman yang ditemukan.
                                </p>

                                @if(request('search'))

                                    <a
                                        href="{{ route('admin.peminjaman.index') }}"
                                        class="mt-5 inline-flex items-center rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
                                    >
                                        Reset Pencarian
                                    </a>

                                @endif

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        {{-- =========================================================
            FOOTER / PAGINATION
        ========================================================== --}}
        @if($peminjamans->total() > 0)

            <div class="flex flex-col gap-4 border-t border-slate-200 bg-slate-50/70 px-6 py-4 md:flex-row md:items-center md:justify-between">

                <p class="text-xs text-slate-500">

                    Menampilkan

                    <span class="font-bold text-slate-700">
                        {{ $peminjamans->firstItem() }}
                    </span>

                    -

                    <span class="font-bold text-slate-700">
                        {{ $peminjamans->lastItem() }}
                    </span>

                    dari

                    <span class="font-bold text-slate-700">
                        {{ $peminjamans->total() }}
                    </span>

                    data peminjaman

                </p>


                <div>
                    {{ $peminjamans->withQueryString()->links() }}
                </div>

            </div>

        @endif

    </div>

</div>

@endsection
