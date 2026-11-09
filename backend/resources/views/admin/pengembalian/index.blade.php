@extends('layouts.app')

@section('title', 'Kelola Pengembalian - Panel Admin')
@section('header-title', 'Manajemen Pengembalian Alat')

@section('content')

{{-- =========================
    HEADER
========================= --}}
<div class="mb-8">
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-900 via-slate-800 to-blue-900 px-6 py-7 shadow-lg">
        <div class="absolute -right-10 -top-16 h-48 w-48 rounded-full bg-blue-500/10"></div>
        <div class="absolute -bottom-20 right-32 h-40 w-40 rounded-full bg-indigo-500/10"></div>

        <div class="relative">
            <div class="mb-2 flex items-center gap-2 text-blue-300">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.017-.127-2.004-.364-2.951z"/>
                </svg>
                <span class="text-sm font-semibold uppercase tracking-wider">
                    Panel Admin
                </span>
            </div>

            <h1 class="text-3xl font-bold text-white md:text-4xl">
                Manajemen Pengembalian
            </h1>

            <p class="mt-2 max-w-2xl text-sm text-slate-300">
                Kelola data pengembalian alat, kondisi barang, serta informasi denda
                dengan lebih mudah dan terorganisir.
            </p>
        </div>
    </div>
</div>


{{-- =========================
    STATISTIK
========================= --}}
<div class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-3">

    {{-- Total --}}
    <div class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">
                    Total Pengembalian
                </p>
                <p class="mt-2 text-3xl font-bold text-slate-800">
                    {{ $pengembalians->total() }}
                </p>
                <p class="mt-1 text-xs text-slate-400">
                    Seluruh data tercatat
                </p>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition group-hover:bg-blue-100">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Halaman --}}
    <div class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">
                    Data Ditampilkan
                </p>
                <p class="mt-2 text-3xl font-bold text-slate-800">
                    {{ $pengembalians->count() }}
                </p>
                <p class="mt-1 text-xs text-slate-400">
                    Pada halaman ini
                </p>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition group-hover:bg-emerald-100">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Status --}}
    <div class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">
                    Status Data
                </p>
                <p class="mt-2 text-3xl font-bold text-slate-800">
                    Aktif
                </p>
                <p class="mt-1 text-xs text-slate-400">
                    Sistem pengembalian
                </p>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-violet-600 transition group-hover:bg-violet-100">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
        </div>
    </div>

</div>


{{-- =========================
    ALERT
========================= --}}
@if(session('success'))
    <div class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 shadow-sm">
        <svg class="mt-0.5 h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div>
            <p class="font-semibold">Berhasil</p>
            <p class="text-sm">{{ session('success') }}</p>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800 shadow-sm">
        <svg class="mt-0.5 h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div>
            <p class="font-semibold">Terjadi Kesalahan</p>
            <p class="text-sm">{{ session('error') }}</p>
        </div>
    </div>
@endif


{{-- =========================
    MAIN CARD
========================= --}}
<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

    {{-- Toolbar --}}
    <div class="border-b border-slate-200 bg-slate-50/80 px-5 py-5 md:px-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <div>
                <h2 class="text-lg font-bold text-slate-800">
                    Daftar Pengembalian
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Data alat yang telah dikembalikan oleh peminjam.
                </p>
            </div>

            {{-- Search --}}
            <form action="{{ route('admin.pengembalian.index') }}"
                  method="GET"
                  class="flex w-full flex-col gap-2 sm:flex-row lg:w-auto">

                <div class="relative">
                    <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama peminjam..."
                        class="w-full rounded-xl border border-slate-300 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 sm:w-64"
                    >
                </div>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-800 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-900 hover:shadow-md">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </button>

                @if(request('search'))
                    <a
                        href="{{ route('admin.pengembalian.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 ring-1 ring-slate-300 transition hover:bg-slate-100">
                        Reset
                    </a>
                @endif
            </form>

        </div>
    </div>


    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full min-w-[900px] text-left">

            <thead>
                <tr class="border-b border-slate-200 bg-white">
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                        Peminjam
                    </th>

                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                        Alat
                    </th>

                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                        Tanggal Kembali
                    </th>

                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                        Kondisi
                    </th>

                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                        Denda
                    </th>

                    <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($pengembalians as $pengembalian)

                    <tr class="group transition duration-200 hover:bg-slate-50">

                        {{-- Peminjam --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-sm font-bold text-white shadow-sm">
                                    {{ strtoupper(substr($pengembalian->peminjaman->user->name ?? 'U', 0, 1)) }}
                                </div>

                                <div>
                                    <p class="font-semibold text-slate-800">
                                        {{ $pengembalian->peminjaman->user->name ?? 'User Dihapus' }}
                                    </p>

                                    <p class="mt-0.5 text-xs text-slate-400">
                                        Peminjam alat
                                    </p>
                                </div>

                            </div>
                        </td>


                        {{-- Alat --}}
                        <td class="px-6 py-5">
                            <div class="space-y-2">

                                @foreach($pengembalian->peminjaman->detailPinjam as $detail)

                                    <div class="flex items-center gap-2">

                                        <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                                            </svg>
                                        </div>

                                        <div>
                                            <p class="text-sm font-semibold text-slate-700">
                                                {{ $detail->alat->nama_alat ?? 'Alat Dihapus' }}
                                            </p>

                                            <p class="text-xs text-slate-400">
                                                {{ $detail->jumlah }} pcs
                                            </p>
                                        </div>

                                    </div>

                                @endforeach

                            </div>
                        </td>


                        {{-- Tanggal --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">

                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ \Carbon\Carbon::parse($pengembalian->tgl_kembali)->format('d M Y') }}
                                    </p>

                                    <p class="text-xs text-slate-400">
                                        Tanggal pengembalian
                                    </p>
                                </div>

                            </div>
                        </td>


                        {{-- Kondisi --}}
                        <td class="px-6 py-5">

                            @if(strtolower($pengembalian->kondisi_kembali) == 'bagus')

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    Bagus
                                </span>

                            @else

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-700 ring-1 ring-amber-200">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    {{ $pengembalian->kondisi_kembali }}
                                </span>

                            @endif

                        </td>


                        {{-- Denda --}}
                        <td class="px-6 py-5">

                            @if($pengembalian->denda > 0)

                                <p class="text-sm font-bold text-red-600">
                                    Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                                </p>

                                <p class="mt-0.5 text-xs text-red-400">
                                    Dikenakan denda
                                </p>

                            @else

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Tidak ada denda
                                </span>

                            @endif

                        </td>


                        {{-- Aksi --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-2">

                                <a
                                    href="{{ route('admin.pengembalian.edit', $pengembalian->id) }}"
                                    title="Edit data"
                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-600 ring-1 ring-amber-200 transition hover:bg-amber-500 hover:text-white hover:shadow-md">

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 8.5-8.5z"/>
                                    </svg>

                                </a>


                                <form
                                    action="{{ route('admin.pengembalian.destroy', $pengembalian->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data pengembalian ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        title="Hapus data"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-600 ring-1 ring-red-200 transition hover:bg-red-500 hover:text-white hover:shadow-md">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"/>
                                        </svg>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">

                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                                </svg>
                            </div>

                            <h3 class="mt-4 text-base font-bold text-slate-700">
                                Belum Ada Data Pengembalian
                            </h3>

                            <p class="mt-1 text-sm text-slate-400">
                                Data pengembalian akan muncul di sini.
                            </p>

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>
    </div>


    {{-- Pagination --}}
    @if($pengembalians->total() > 0)

        <div class="flex flex-col gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

            <p class="text-xs text-slate-500">
                Menampilkan
                <span class="font-semibold text-slate-700">
                    {{ $pengembalians->firstItem() }}
                </span>
                -
                <span class="font-semibold text-slate-700">
                    {{ $pengembalians->lastItem() }}
                </span>
                dari
                <span class="font-semibold text-slate-700">
                    {{ $pengembalians->total() }}
                </span>
                data
            </p>

            <div>
                {{ $pengembalians->withQueryString()->links() }}
            </div>

        </div>

    @endif

</div>

@endsection
