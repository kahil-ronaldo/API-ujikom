docker exec -i laravel-api sh -c 'cat > resources/views/petugas/peminjaman/index.blade.php' <<'EOF'
@extends('layouts.app')

@section('title', 'Kelola Peminjaman - Panel Petugas')
@section('header-title', 'Manajemen Pengajuan Peminjaman')

@section('content')

{{-- Notifikasi sukses --}}
@if(session('success'))
    <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-lg shadow-sm text-sm">
        {{ session('success') }}
    </div>
@endif

{{-- Notifikasi error --}}
@if(session('error'))
    <div class="mb-4 bg-red-50 border border-red-200 text-red-800 p-4 rounded-lg shadow-sm text-sm">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">

    {{-- Header --}}
    <div class="p-5 border-b border-gray-200 bg-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">

        <div>
            <h3 class="text-lg font-bold text-gray-800">
                Daftar Pengajuan Peminjaman
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Kelola pengajuan peminjaman dari pengguna.
            </p>
        </div>

        {{-- Search --}}
        <form
            action="{{ route('petugas.peminjaman.index') }}"
            method="GET"
            class="flex w-full md:w-80"
        >
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama peminjam..."
                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >

            <button
                type="submit"
                class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 text-sm font-semibold rounded-r-lg transition"
            >
                Cari
            </button>

            @if(request('search'))
                <a
                    href="{{ route('petugas.peminjaman.index') }}"
                    class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-700 px-3 py-2 text-sm rounded-lg flex items-center transition"
                >
                    Reset
                </a>
            @endif
        </form>

    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto">

        <table class="w-full text-left border-collapse">

            <thead>
                <tr class="bg-gray-100 text-gray-600 text-sm uppercase tracking-wider">

                    <th class="py-3 px-4 border-b">
                        Peminjam
                    </th>

                    <th class="py-3 px-4 border-b">
                        Alat yang Dipinjam
                    </th>

                    <th class="py-3 px-4 border-b">
                        Tanggal Pinjam
                    </th>

                    <th class="py-3 px-4 border-b">
                        Rencana Kembali
                    </th>

                    <th class="py-3 px-4 border-b text-center">
                        Status
                    </th>

                    <th class="py-3 px-4 border-b text-center">
                        Aksi
                    </th>

                </tr>
            </thead>

            <tbody class="text-gray-700 text-sm">

                @forelse($peminjamans as $item)

                    <tr class="hover:bg-gray-50 transition">

                        {{-- Peminjam --}}
                        <td class="py-3 px-4 border-b">

                            <div class="font-semibold text-gray-900">
                                {{ $item->user->name ?? 'Anonim' }}
                            </div>

                            <div class="text-xs text-gray-500">
                                {{ $item->user->email ?? '-' }}
                            </div>

                        </td>

                        {{-- Daftar Alat --}}
                        <td class="py-3 px-4 border-b">

                            @if($item->detailPinjam && $item->detailPinjam->count())

                                <ul class="space-y-1">

                                    @foreach($item->detailPinjam as $detail)

                                        <li class="text-sm">
                                            <span class="font-medium">
                                                {{ $detail->alat->nama_alat ?? 'Alat Dihapus' }}
                                            </span>

                                            <span class="text-gray-500">
                                                ({{ $detail->jumlah }} unit)
                                            </span>
                                        </li>

                                    @endforeach

                                </ul>

                            @else

                                <span class="text-gray-400">
                                    Tidak ada detail alat
                                </span>

                            @endif

                        </td>

                        {{-- Tanggal Pinjam --}}
                        <td class="py-3 px-4 border-b">

                            {{ $item->tgl_pinjam
                                ? \Carbon\Carbon::parse($item->tgl_pinjam)->format('d/m/Y')
                                : '-'
                            }}

                        </td>

                        {{-- Tanggal Kembali --}}
                        <td class="py-3 px-4 border-b">

                            {{ $item->tgl_kembali_plan
                                ? \Carbon\Carbon::parse($item->tgl_kembali_plan)->format('d/m/Y')
                                : '-'
                            }}

                        </td>

                        {{-- Status --}}
                        <td class="py-3 px-4 border-b text-center">

                            <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu Persetujuan
                            </span>

                        </td>

                        {{-- Aksi --}}
                        <td class="py-3 px-4 border-b">

                            <div class="flex justify-center items-center gap-2">

                                {{-- Setujui --}}
                                <form
                                    action="{{ route('petugas.peminjaman.setujui', $item->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Setujui pengajuan peminjaman ini?')"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1.5 rounded text-xs font-semibold transition shadow-sm"
                                    >
                                        Setujui
                                    </button>

                                </form>

                                {{-- Tolak --}}
                                <form
                                    action="{{ route('petugas.peminjaman.tolak', $item->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menolak pengajuan peminjaman ini?')"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded text-xs font-semibold transition shadow-sm"
                                    >
                                        Tolak
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="py-8 text-center text-gray-500">

                            @if(request('search'))

                                Tidak ditemukan pengajuan dengan kata kunci
                                "{{ request('search') }}".

                            @else

                                Belum ada pengajuan peminjaman.

                            @endif

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
EOF