@extends('layouts.app')

@section('title', 'Laporan Peminjaman - Panel Petugas')
@section('header-title', 'Laporan Peminjaman & Pengembalian Alat')

@section('content')

@php
    $totalData = $laporans->count();

    $totalDikembalikan = $laporans->filter(function ($item) {
        return in_array($item->status, ['dikembalikan', 'selesai']);
    })->count();

    $totalDipinjam = $laporans->where('status', 'dipinjam')->count();

    $totalDenda = $laporans->sum(function ($item) {
        return (float) ($item->pengembalian->denda ?? 0);
    });
@endphp


{{-- HERO --}}
<div class="mb-6 overflow-hidden rounded-2xl bg-gradient-to-r from-slate-900 via-blue-900 to-blue-700 shadow-lg">
    <div class="relative px-7 py-7">

        <div class="absolute -right-12 -top-20 h-56 w-56 rounded-full bg-white/10"></div>
        <div class="absolute -bottom-24 right-40 h-48 w-48 rounded-full bg-blue-400/10"></div>

        <div class="relative flex flex-col gap-5 md:flex-row md:items-center md:justify-between">

            <div class="flex items-center gap-4">

                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-3xl shadow-inner">
                    📊
                </div>

                <div>
                    <p class="mb-1 text-xs font-bold uppercase tracking-[0.2em] text-blue-200">
                        Panel Petugas
                    </p>

                    <h1 class="text-2xl font-bold text-white md:text-3xl">
                        Laporan Peminjaman & Pengembalian
                    </h1>

                    <p class="mt-1 text-sm text-blue-100">
                        Kelola, pantau, dan cetak rekap transaksi alat.
                    </p>
                </div>

            </div>

            <div class="hidden rounded-2xl bg-white/10 px-6 py-4 text-center md:block">
                <p class="text-xs font-medium text-blue-200">
                    DATA TERFILTER
                </p>

                <p class="mt-1 text-3xl font-bold text-white">
                    {{ $totalData }}
                </p>

                <p class="text-xs text-blue-200">
                    transaksi
                </p>
            </div>

        </div>
    </div>
</div>


{{-- STATISTIK --}}
<div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

    <div class="group rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm font-medium text-gray-500">
                    Total Laporan
                </p>

                <p class="mt-2 text-3xl font-bold text-gray-800">
                    {{ $totalData }}
                </p>

                <p class="mt-1 text-xs text-gray-400">
                    Data sesuai filter
                </p>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-xl transition group-hover:scale-110">
                📋
            </div>

        </div>
    </div>


    <div class="group rounded-2xl border border-blue-100 bg-blue-50/50 p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm font-medium text-blue-700">
                    Sedang Dipinjam
                </p>

                <p class="mt-2 text-3xl font-bold text-blue-700">
                    {{ $totalDipinjam }}
                </p>

                <p class="mt-1 text-xs text-blue-500">
                    Alat masih digunakan
                </p>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-xl transition group-hover:scale-110">
                🔄
            </div>

        </div>
    </div>


    <div class="group rounded-2xl border border-emerald-100 bg-emerald-50/50 p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm font-medium text-emerald-700">
                    Dikembalikan
                </p>

                <p class="mt-2 text-3xl font-bold text-emerald-700">
                    {{ $totalDikembalikan }}
                </p>

                <p class="mt-1 text-xs text-emerald-600">
                    Transaksi selesai kembali
                </p>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-xl transition group-hover:scale-110">
                ✓
            </div>

        </div>
    </div>


    <div class="group rounded-2xl border border-red-100 bg-red-50/50 p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm font-medium text-red-700">
                    Total Denda
                </p>

                <p class="mt-2 text-xl font-bold text-red-600">
                    Rp {{ number_format($totalDenda, 0, ',', '.') }}
                </p>

                <p class="mt-1 text-xs text-red-500">
                    Dari data laporan
                </p>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-100 text-xl transition group-hover:scale-110">
                💰
            </div>

        </div>
    </div>

</div>


{{-- FILTER --}}
<div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

    <div class="border-b border-gray-200 px-6 py-5">

        <div class="flex items-center gap-3">

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-xl">
                🔎
            </div>

            <div>
                <h2 class="text-lg font-bold text-gray-800">
                    Filter Laporan
                </h2>

                <p class="text-sm text-gray-500">
                    Pilih status dan periode untuk menampilkan data.
                </p>
            </div>

        </div>

    </div>


    <form
        action="{{ route('petugas.laporan.index') }}"
        method="GET"
        class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2 xl:grid-cols-4"
    >

        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Status Peminjaman
            </label>

            <div class="relative">

                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    ≡
                </span>

                <select
                    name="status"
                    class="h-12 w-full appearance-none rounded-xl border border-gray-200 bg-gray-50 pl-11 pr-10 text-sm font-medium text-gray-700 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100"
                >
                    <option value="">
                        Semua Status
                    </option>

                    <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>
                        Diajukan
                    </option>

                    <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>
                        Dipinjam
                    </option>

                    <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>
                        Dikembalikan
                    </option>

                    <option value="telat" {{ request('status') == 'telat' ? 'selected' : '' }}>
                        Telat
                    </option>

                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>
                </select>

            </div>
        </div>


        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Dari Tanggal
            </label>

            <div class="relative">

                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    📅
                </span>

                <input
                    type="date"
                    name="dari_tanggal"
                    value="{{ request('dari_tanggal') }}"
                    class="h-12 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 pl-11 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100"
                >

            </div>
        </div>


        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Sampai Tanggal
            </label>

            <div class="relative">

                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    📅
                </span>

                <input
                    type="date"
                    name="sampai_tanggal"
                    value="{{ request('sampai_tanggal') }}"
                    class="h-12 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 pl-11 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100"
                >

            </div>
        </div>


        <div class="flex items-end gap-3">

            <button
                type="submit"
                class="h-12 flex-1 rounded-xl bg-slate-800 px-5 text-sm font-bold text-white shadow-sm transition hover:bg-slate-900 hover:shadow-md"
            >
                🔎 Filter
            </button>

            <a
                href="{{ route('petugas.laporan.index') }}"
                class="flex h-12 items-center justify-center rounded-xl bg-gray-100 px-5 text-sm font-semibold text-gray-600 transition hover:bg-gray-200"
            >
                Reset
            </a>

        </div>

    </form>

</div>


{{-- HASIL LAPORAN --}}
<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

    <div class="flex flex-col gap-4 border-b border-gray-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

        <div class="flex items-center gap-3">

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-xl">
                📊
            </div>

            <div>

                <h2 class="text-lg font-bold text-gray-800">
                    Hasil Rekap Laporan
                </h2>

                <p class="text-sm text-gray-500">
                    Data peminjaman dan pengembalian alat.
                </p>

            </div>

        </div>


        <a
            href="{{ route('petugas.laporan.cetak', request()->all()) }}"
            target="_blank"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-700 hover:shadow-md"
        >
            🖨️
            Cetak / Print Laporan
        </a>

    </div>


    <div class="overflow-x-auto">

        <table class="w-full min-w-[1050px]">

            <thead>

                <tr class="border-b border-gray-200 bg-slate-50">

                    <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                        No
                    </th>

                    <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                        Peminjam
                    </th>

                    <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                        Tgl Pinjam
                    </th>

                    <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                        Rencana Kembali
                    </th>

                    <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                        Status
                    </th>

                    <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                        Detail Alat
                    </th>

                    <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                        Denda
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-100">

                @forelse($laporans as $index => $item)

                    <tr class="group transition hover:bg-slate-50">

                        {{-- NOMOR --}}
                        <td class="px-5 py-5">

                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-xs font-bold text-gray-500">
                                {{ $index + 1 }}
                            </div>

                        </td>


                        {{-- PEMINJAM --}}
                        <td class="px-5 py-5">

                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white shadow-sm">

                                    {{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}

                                </div>

                                <div>

                                    <p class="font-bold text-gray-800">
                                        {{ $item->user->name ?? '-' }}
                                    </p>

                                    @if(isset($item->user->email))

                                        <p class="mt-0.5 text-xs text-gray-400">
                                            {{ $item->user->email }}
                                        </p>

                                    @endif

                                </div>

                            </div>

                        </td>


                        {{-- TANGGAL PINJAM --}}
                        <td class="px-5 py-5">

                            <div class="flex items-center gap-2">

                                <span class="text-blue-500">
                                    📅
                                </span>

                                <div>

                                    <p class="text-sm font-semibold text-gray-700">
                                        {{ $item->tgl_pinjam ? \Carbon\Carbon::parse($item->tgl_pinjam)->translatedFormat('d F Y') : '-' }}
                                    </p>

                                    @if($item->tgl_pinjam)

                                        <p class="text-xs text-gray-400">
                                            {{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('H:i') }}
                                        </p>

                                    @endif

                                </div>

                            </div>

                        </td>


                        {{-- RENCANA KEMBALI --}}
                        <td class="px-5 py-5">

                            <div class="flex items-center gap-2">

                                <span class="text-orange-500">
                                    📅
                                </span>

                                <div>

                                    <p class="text-sm font-semibold text-gray-700">
                                        {{ $item->tgl_kembali_plan ? \Carbon\Carbon::parse($item->tgl_kembali_plan)->translatedFormat('d F Y') : '-' }}
                                    </p>

                                    @if($item->tgl_kembali_plan)

                                        <p class="text-xs text-gray-400">
                                            {{ \Carbon\Carbon::parse($item->tgl_kembali_plan)->format('H:i') }}
                                        </p>

                                    @endif

                                </div>

                            </div>

                        </td>


                        {{-- STATUS --}}
                        <td class="px-5 py-5">

                            @if($item->status === 'dikembalikan' || $item->status === 'selesai')

                                <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-2 text-xs font-bold text-emerald-700 ring-1 ring-inset ring-emerald-200">
                                    ✓
                                    Dikembalikan
                                </span>

                            @elseif($item->status === 'dipinjam')

                                <span class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-2 text-xs font-bold text-blue-700 ring-1 ring-inset ring-blue-200">
                                    🔄
                                    Dipinjam
                                </span>

                            @elseif($item->status === 'telat')

                                <span class="inline-flex items-center gap-2 rounded-full bg-red-50 px-3 py-2 text-xs font-bold text-red-700 ring-1 ring-inset ring-red-200">
                                    !
                                    Telat
                                </span>

                            @elseif($item->status === 'diajukan')

                                <span class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-3 py-2 text-xs font-bold text-amber-700 ring-1 ring-inset ring-amber-200">
                                    ⏳
                                    Diajukan
                                </span>

                            @else

                                <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-2 text-xs font-bold text-gray-600">
                                    {{ ucfirst($item->status) }}
                                </span>

                            @endif

                        </td>


                        {{-- DETAIL ALAT --}}
                        <td class="px-5 py-5">

                            @if($item->detailPinjam && $item->detailPinjam->count())

                                <div class="space-y-2">

                                    @foreach($item->detailPinjam as $detail)

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-sm">
                                                🛠️
                                            </div>

                                            <div>

                                                <p class="text-sm font-semibold text-gray-700">
                                                    {{ $detail->alat->nama_alat ?? '-' }}
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
                                    Detail alat tidak tersedia
                                </span>

                            @endif

                        </td>


                        {{-- DENDA --}}
                        <td class="px-5 py-5">

                            @if((float) ($item->pengembalian->denda ?? 0) > 0)

                                <div>
                                    <p class="font-bold text-red-600">
                                        Rp {{ number_format($item->pengembalian->denda, 0, ',', '.') }}
                                    </p>

                                    <p class="mt-0.5 text-xs text-red-400">
                                        Ada denda
                                    </p>
                                </div>

                            @else

                                <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-2 text-xs font-semibold text-gray-500">
                                    Rp 0
                                </span>

                            @endif

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td colspan="7" class="px-6 py-20">

                            <div class="mx-auto max-w-md text-center">

                                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 text-3xl">
                                    📊
                                </div>

                                <h3 class="mt-5 text-lg font-bold text-gray-700">
                                    Tidak Ada Data
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-gray-500">
                                    Tidak ada data laporan yang sesuai dengan filter yang dipilih.
                                </p>

                                <a
                                    href="{{ route('petugas.laporan.index') }}"
                                    class="mt-5 inline-flex rounded-xl bg-slate-800 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-900"
                                >
                                    Tampilkan Semua
                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- FOOTER --}}
    @if($totalData > 0)

        <div class="flex flex-col gap-2 border-t border-gray-200 bg-gray-50 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

            <p class="text-xs text-gray-500">
                Menampilkan
                <span class="font-bold text-gray-700">
                    {{ $totalData }}
                </span>
                data laporan
            </p>

            <p class="text-xs text-gray-400">
                Data berdasarkan filter yang dipilih
            </p>

        </div>

    @endif

</div>

@endsection
