@extends('layouts.app')

@section('title', 'Pemantauan Pengembalian - Panel Petugas')
@section('header-title', 'Pemantauan Pengembalian Alat')

@section('content')

{{-- =========================================================
     NOTIFIKASI
========================================================= --}}

@if(session('success'))
    <div class="mb-5 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 shadow-sm">
        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-lg text-emerald-600">
            ✓
        </div>

        <div>
            <p class="font-bold text-emerald-800">
                Berhasil
            </p>

            <p class="text-sm text-emerald-700">
                {{ session('success') }}
            </p>
        </div>
    </div>
@endif


@if(session('error'))
    <div class="mb-5 flex items-center gap-3 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 shadow-sm">
        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-100 text-lg text-red-600">
            !
        </div>

        <div>
            <p class="font-bold text-red-800">
                Terjadi Kesalahan
            </p>

            <p class="text-sm text-red-700">
                {{ session('error') }}
            </p>
        </div>
    </div>
@endif


{{-- =========================================================
     HEADER HERO
========================================================= --}}

<div class="mb-6 overflow-hidden rounded-2xl bg-slate-900 shadow-lg">

    <div class="relative px-7 py-7">

        {{-- Dekorasi --}}
        <div class="absolute -right-10 -top-16 h-48 w-48 rounded-full bg-blue-500/10"></div>
        <div class="absolute -bottom-20 right-32 h-40 w-40 rounded-full bg-emerald-400/10"></div>

        <div class="relative flex flex-col gap-5 md:flex-row md:items-center md:justify-between">

            <div class="flex items-center gap-4">

                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-white/10 text-3xl shadow-inner">
                    🔄
                </div>

                <div>

                    <p class="mb-1 text-xs font-bold uppercase tracking-[0.2em] text-slate-400">
                        Panel Petugas
                    </p>

                    <h1 class="text-2xl font-bold text-white md:text-3xl">
                        Pemantauan Pengembalian
                    </h1>

                    <p class="mt-1 text-sm text-slate-400">
                        Pantau riwayat pengembalian alat dari pengguna.
                    </p>

                </div>

            </div>

            <div class="hidden md:flex h-20 w-20 items-center justify-center rounded-2xl bg-white/5 text-4xl">
                📋
            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     SEARCH
========================================================= --}}

<div class="mb-6 rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">

    <form
        action="{{ route('petugas.pengembalian.index') }}"
        method="GET"
        class="flex flex-col gap-3 sm:flex-row"
    >

        <div class="relative flex-1">

            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-lg text-gray-400">
                🔍
            </span>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama peminjam..."
                class="h-12 w-full rounded-xl border border-gray-200 bg-gray-50 pl-11 pr-4 text-sm text-gray-700 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-2 focus:ring-slate-100"
            >

        </div>

        <button
            type="submit"
            class="h-12 rounded-xl bg-slate-800 px-7 text-sm font-bold text-white shadow-sm transition hover:bg-slate-900 hover:shadow-md"
        >
            🔍 Cari
        </button>

        @if(request('search'))

            <a
                href="{{ route('petugas.pengembalian.index') }}"
                class="flex h-12 items-center justify-center rounded-xl bg-gray-100 px-6 text-sm font-semibold text-gray-600 transition hover:bg-gray-200"
            >
                Reset
            </a>

        @endif

    </form>

</div>


{{-- =========================================================
     STATISTIK
========================================================= --}}

@php
    $totalPengembalian = $pengembalians->count();

    $kondisiBaik = $pengembalians->filter(function ($item) {
        return strtolower($item->kondisi_kembali ?? '') === 'baik';
    })->count();

    $denganDenda = $pengembalians->filter(function ($item) {
        return (float) ($item->denda ?? 0) > 0;
    })->count();
@endphp


<div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">

    {{-- Total --}}
    <div class="group rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Total Pengembalian
                </p>

                <p class="mt-2 text-3xl font-bold text-gray-800">
                    {{ $totalPengembalian }}
                </p>

                <p class="mt-1 text-xs text-gray-400">
                    Seluruh riwayat pengembalian
                </p>

            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-xl transition group-hover:scale-110">
                📦
            </div>

        </div>

    </div>


    {{-- Kondisi Baik --}}
    <div class="group rounded-2xl border border-emerald-100 bg-emerald-50/50 p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-emerald-700">
                    Kondisi Baik
                </p>

                <p class="mt-2 text-3xl font-bold text-emerald-700">
                    {{ $kondisiBaik }}
                </p>

                <p class="mt-1 text-xs text-emerald-600">
                    Alat kembali dengan baik
                </p>

            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-xl transition group-hover:scale-110">
                ✓
            </div>

        </div>

    </div>


    {{-- Denda --}}
    <div class="group rounded-2xl border border-red-100 bg-red-50/50 p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-red-700">
                    Memiliki Denda
                </p>

                <p class="mt-2 text-3xl font-bold text-red-600">
                    {{ $denganDenda }}
                </p>

                <p class="mt-1 text-xs text-red-500">
                    Pengembalian dengan denda
                </p>

            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-100 text-xl transition group-hover:scale-110">
                💰
            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     TABEL PENGEMBALIAN
========================================================= --}}

<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

    {{-- Header tabel --}}
    <div class="flex flex-col gap-2 border-b border-gray-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

        <div class="flex items-center gap-3">

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-100 text-xl">
                📋
            </div>

            <div>

                <h2 class="text-lg font-bold text-gray-800">
                    Riwayat Pengembalian
                </h2>

                <p class="text-sm text-gray-500">
                    Data alat yang telah dikembalikan pengguna.
                </p>

            </div>

        </div>

        <div class="rounded-full bg-slate-100 px-4 py-2 text-xs font-semibold text-slate-600">
            {{ $totalPengembalian }} Data
        </div>

    </div>


    {{-- Table --}}
    <div class="overflow-x-auto">

        <table class="w-full min-w-[950px]">

            <thead>

                <tr class="border-b border-gray-200 bg-slate-50 text-left">

                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">
                        Peminjam
                    </th>

                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">
                        Detail Alat
                    </th>

                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">
                        Tanggal Kembali
                    </th>

                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">
                        Kondisi
                    </th>

                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">
                        Denda
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-100">

                @forelse($pengembalians as $item)

                    <tr class="group transition hover:bg-slate-50">

                        {{-- PEMINJAM --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-slate-800 text-sm font-bold text-white shadow-sm">

                                    {{ strtoupper(substr($item->peminjaman->user->name ?? 'U', 0, 1)) }}

                                </div>

                                <div>

                                    <p class="font-bold text-gray-800">
                                        {{ $item->peminjaman->user->name ?? 'User Dihapus' }}
                                    </p>

                                    @if(isset($item->peminjaman->user->email))

                                        <p class="mt-0.5 text-xs text-gray-400">
                                            {{ $item->peminjaman->user->email }}
                                        </p>

                                    @else

                                        <p class="mt-0.5 text-xs text-gray-400">
                                            Data pengguna tidak tersedia
                                        </p>

                                    @endif

                                </div>

                            </div>

                        </td>


                        {{-- DETAIL ALAT --}}
                        <td class="px-6 py-5">

                            @if(
                                isset($item->peminjaman) &&
                                isset($item->peminjaman->detailPinjam) &&
                                $item->peminjaman->detailPinjam->count()
                            )

                                <div class="space-y-2">

                                    @foreach($item->peminjaman->detailPinjam as $detail)

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-sm">
                                                🛠️
                                            </div>

                                            <div>

                                                <p class="text-sm font-semibold text-gray-700">
                                                    {{ $detail->alat->nama_alat ?? 'Alat Dihapus' }}
                                                </p>

                                                <p class="text-xs text-gray-400">
                                                    Jumlah:
                                                    <span class="font-semibold text-gray-500">
                                                        {{ $detail->jumlah }}
                                                    </span>
                                                    unit
                                                </p>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            @else

                                <span class="text-sm italic text-gray-400">
                                    Detail alat tidak ditemukan
                                </span>

                            @endif

                        </td>


                        {{-- TANGGAL --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-sm">
                                    📅
                                </div>

                                <div>

                                    <p class="text-sm font-semibold text-gray-700">
                                        {{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d F Y') }}
                                    </p>

                                    <p class="text-xs text-gray-400">
                                        {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('H:i') }} WIB
                                    </p>

                                </div>

                            </div>

                        </td>


                        {{-- KONDISI --}}
                        <td class="px-6 py-5">

                            @if(strtolower($item->kondisi_kembali ?? '') === 'baik')

                                <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-2 text-xs font-bold text-emerald-700 ring-1 ring-inset ring-emerald-200">

                                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-100">
                                        ✓
                                    </span>

                                    {{ ucfirst($item->kondisi_kembali) }}

                                </span>

                            @else

                                <span class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-3 py-2 text-xs font-bold text-amber-700 ring-1 ring-inset ring-amber-200">

                                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-amber-100">
                                        !
                                    </span>

                                    {{ ucfirst($item->kondisi_kembali ?? 'Tidak diketahui') }}

                                </span>

                            @endif

                        </td>


                        {{-- DENDA --}}
                        <td class="px-6 py-5">

                            @if((float) ($item->denda ?? 0) > 0)

                                <div>

                                    <p class="font-bold text-red-600">
                                        Rp {{ number_format($item->denda, 0, ',', '.') }}
                                    </p>

                                    <p class="mt-0.5 text-xs text-red-400">
                                        Denda pengembalian
                                    </p>

                                </div>

                            @else

                                <span class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-3 py-2 text-xs font-semibold text-gray-500">

                                    ✓
                                    Tidak ada denda

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    {{-- EMPTY STATE --}}
                    <tr>

                        <td colspan="5" class="px-6 py-20">

                            <div class="mx-auto max-w-md text-center">

                                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 text-3xl">
                                    📦
                                </div>

                                @if(request('search'))

                                    <h3 class="mt-5 text-lg font-bold text-gray-700">
                                        Data Tidak Ditemukan
                                    </h3>

                                    <p class="mt-2 text-sm leading-6 text-gray-500">
                                        Tidak ada riwayat pengembalian untuk peminjam
                                        <span class="font-semibold text-gray-700">
                                            "{{ request('search') }}"
                                        </span>.
                                    </p>

                                    <a
                                        href="{{ route('petugas.pengembalian.index') }}"
                                        class="mt-5 inline-flex rounded-xl bg-slate-800 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-900"
                                    >
                                        Tampilkan Semua
                                    </a>

                                @else

                                    <h3 class="mt-5 text-lg font-bold text-gray-700">
                                        Belum Ada Pengembalian
                                    </h3>

                                    <p class="mt-2 text-sm leading-6 text-gray-500">
                                        Saat ini belum ada riwayat alat yang dikembalikan oleh pengguna.
                                    </p>

                                @endif

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- FOOTER --}}
    @if($totalPengembalian > 0)

        <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">

            <p class="text-xs text-gray-500">
                Menampilkan
                <span class="font-semibold text-gray-700">
                    {{ $totalPengembalian }}
                </span>
                data pengembalian
            </p>

        </div>

    @endif

</div>

@endsection
