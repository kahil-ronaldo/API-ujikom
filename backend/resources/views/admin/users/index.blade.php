@extends('layouts.app')

@section('title', 'Kelola User - Panel Admin')

@section('content')

@php
    $totalUser = method_exists($users, 'total')
        ? $users->total()
        : $users->count();

    $adminCount = $users->where('role', 'admin')->count();
    $petugasCount = $users->where('role', 'petugas')->count();
    $peminjamCount = $users->where('role', 'peminjam')->count();
@endphp

<div class="min-h-screen bg-slate-100">

    {{-- ================= HEADER ================= --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <p class="text-sm font-medium text-blue-600">
                PANEL ADMIN
            </p>

            <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-800">
                Manajemen Pengguna
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Kelola akun dan hak akses pengguna sistem.
            </p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"


    {{-- ================= HERO ================= --}}
    <div class="relative mb-7 overflow-hidden rounded-3xl
                bg-gradient-to-r from-slate-900 via-blue-950 to-blue-900
                px-8 py-9 text-white shadow-xl">

        {{-- Background decoration --}}
        <div class="absolute -right-16 -top-24 h-64 w-64
                    rounded-full bg-blue-700/30"></div>

        <div class="absolute right-48 -bottom-32 h-72 w-72
                    rounded-full bg-blue-700/20"></div>

        <div class="absolute right-0 bottom-0 h-40 w-40
                    rounded-full bg-blue-800/20"></div>

        <div class="relative z-10">

            <div class="mb-5 flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-blue-400/15 text-blue-300">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 4.354a4 4 0 110
                                 5.292M15 21H3v-1a6 6
                                 0 0112 0v1zm0 0h6v-1
                                 a6 6 0 00-9-5.197
                                 M13 7a4 4 0 11-8 0
                                 4 4 0 018 0z"/>
                    </svg>

                </div>

                <span class="text-lg font-semibold tracking-wide
                             text-blue-300">
                    PANEL ADMIN
                </span>

            </div>

            <h2 class="text-4xl font-bold tracking-tight md:text-5xl">
                Manajemen Pengguna
            </h2>

            <p class="mt-4 max-w-3xl text-lg leading-relaxed text-slate-300">
                Kelola akun pengguna, role, serta hak akses sistem
                dengan lebih mudah dan terorganisir.
            </p>

        </div>
    </div>


    {{-- ================= STATISTIK ================= --}}
    <div class="mb-7 grid grid-cols-1 gap-5 md:grid-cols-3">

        {{-- TOTAL --}}
        <div class="relative overflow-hidden rounded-2xl
                    border border-slate-200 bg-white p-6 shadow-sm
                    transition hover:-translate-y-1 hover:shadow-lg">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-semibold text-slate-500">
                        Total Pengguna
                    </p>

                    <h3 class="mt-2 text-4xl font-bold text-slate-800">
                        {{ $totalUser }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-400">
                        Seluruh pengguna sistem
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-blue-100 text-blue-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M17 20h5v-2a3 3
                                 0 00-5.356-1.857
                                 M17 20H7m10 0v-2c0-.656
                                 -.126-1.283-.356-1.857
                                 M7 20H2v-2a3 3 0
                                 015.356-1.857M7 20v-2
                                 c0-.656.126-1.283.356-1.857
                                 m0 0a5.002 5.002 0
                                 019.288 0M15 7a3 3 0
                                 11-6 0 3 3 0 016 0zm6
                                 3a2 2 0 11-4 0 2 2
                                 0 014 0zM7 10a2 2
                                 0 11-4 0 2 2 0 014 0z"/>
                    </svg>

                </div>

            </div>
        </div>


        {{-- ADMIN --}}
        <div class="relative overflow-hidden rounded-2xl
                    border border-purple-100 bg-white p-6 shadow-sm
                    transition hover:-translate-y-1 hover:shadow-lg">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-semibold text-slate-500">
                        Administrator
                    </p>

                    <h3 class="mt-2 text-4xl font-bold text-purple-600">
                        {{ $adminCount }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-400">
                        Pengelola sistem
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-purple-100 text-purple-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 15v2m-6 4h12a2 2
                                 0 002-2v-6a2 2 0
                                 00-2-2H6a2 2 0
                                 00-2 2v6a2 2 0
                                 002 2zm10-10V7a4
                                 4 0 00-8 0v2h8z"/>
                    </svg>

                </div>

            </div>
        </div>


        {{-- PEMINJAM --}}
        <div class="relative overflow-hidden rounded-2xl
                    border border-emerald-100 bg-white p-6 shadow-sm
                    transition hover:-translate-y-1 hover:shadow-lg">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-semibold text-slate-500">
                        Peminjam
                    </p>

                    <h3 class="mt-2 text-4xl font-bold text-emerald-600">
                        {{ $peminjamCount }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-400">
                        Pengguna peminjam alat
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-emerald-100 text-emerald-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16 7a4 4 0
                                 11-8 0 4 4 0
                                 018 0zM12 14a7
                                 7 0 00-7 7h14
                                 a7 7 0 00-7-7z"/>
                    </svg>

                </div>

            </div>
        </div>

    </div>


    {{-- ================= DATA USER ================= --}}
    <div class="overflow-hidden rounded-3xl border
                border-slate-200 bg-white shadow-sm">

        {{-- HEADER TABLE --}}
        <div class="border-b border-slate-200 bg-slate-50/70 px-6 py-6">

            <div class="flex flex-col gap-5
                        lg:flex-row lg:items-center lg:justify-between">

                <div>

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center
                                    rounded-xl bg-blue-100 text-blue-600">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M17 20h5v-2a3 3
                                         0 00-5.356-1.857
                                         M17 20H7m10 0v-2c0-.656
                                         -.126-1.283-.356-1.857
                                         M7 20H2v-2a3 3 0
                                         015.356-1.857M7 20v-2
                                         c0-.656.126-1.283.356-1.857
                                         m0 0a5.002 5.002 0
                                         019.288 0M15 7a3 3
                                         0 11-6 0 3 3 0 016 0z"/>
                            </svg>

                        </div>

                        <div>

                            <h3 class="text-xl font-bold text-slate-800">
                                Daftar Pengguna
                            </h3>

                            <p class="text-sm text-slate-500">
                                Kelola akun dan hak akses pengguna.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- SEARCH + TAMBAH --}}
                <div class="flex flex-col gap-3 sm:flex-row">

                    <form method="GET"
                          action="{{ route('admin.user.index') }}"
                          class="flex">

                        <div class="relative">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="pointer-events-none absolute left-4
                                        top-1/2 h-5 w-5 -translate-y-1/2
                                        text-slate-400"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M21 21l-4.35-4.35m2.35-5.65a8
                                         8 0 11-16 0 8 8 0 0116 0z"/>
                            </svg>

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari nama / email / role..."
                                   class="w-full rounded-l-xl border
                                          border-slate-200 bg-white
                                          py-3 pl-11 pr-4 text-sm
                                          text-slate-700 outline-none
                                          transition focus:border-blue-500
                                          focus:ring-2 focus:ring-blue-100
                                          sm:w-72">

                        </div>

                        <button type="submit"
                                class="rounded-r-xl bg-slate-900 px-5
                                       text-sm font-semibold text-white
                                       transition hover:bg-blue-700">

                            Cari

                        </button>

                    </form>


                    <a href="{{ route('admin.user.create') }}"
                       class="inline-flex items-center justify-center gap-2
                              rounded-xl bg-blue-600 px-5 py-3
                              text-sm font-semibold text-white shadow-sm
                              transition hover:bg-blue-700 hover:shadow-md">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 4v16m8-8H4"/>
                        </svg>

                        Tambah User

                    </a>

                </div>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50">

                        <th class="px-6 py-4 text-left text-xs
                                   font-bold uppercase tracking-wider
                                   text-slate-500">
                            Pengguna
                        </th>

                        <th class="px-6 py-4 text-left text-xs
                                   font-bold uppercase tracking-wider
                                   text-slate-500">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left text-xs
                                   font-bold uppercase tracking-wider
                                   text-slate-500">
                            Role / Hak Akses
                        </th>

                        <th class="px-6 py-4 text-left text-xs
                                   font-bold uppercase tracking-wider
                                   text-slate-500">
                            No. HP
                        </th>

                        <th class="px-6 py-4 text-right text-xs
                                   font-bold uppercase tracking-wider
                                   text-slate-500">
                            Aksi
                        </th>

                    </tr>
                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($users as $user)

                        @php
                            $initial = strtoupper(substr($user->name, 0, 1));

                            $roleClass = match($user->role) {
                                'admin' => 'bg-purple-100 text-purple-700 ring-purple-200',
                                'petugas' => 'bg-blue-100 text-blue-700 ring-blue-200',
                                default => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
                            };
                        @endphp

                        <tr class="group transition hover:bg-blue-50/40">

                            {{-- USER --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-4">

                                    <div class="flex h-11 w-11 shrink-0
                                                items-center justify-center
                                                rounded-full bg-gradient-to-br
                                                from-blue-500 to-blue-700
                                                text-sm font-bold text-white
                                                shadow-sm">

                                        {{ $initial }}

                                    </div>

                                    <div>

                                        <p class="font-semibold text-slate-800">
                                            {{ $user->name }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-400">
                                            ID #{{ $user->id }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- EMAIL --}}
                            <td class="px-6 py-5">

                                <span class="text-sm text-slate-600">
                                    {{ $user->email }}
                                </span>

                            </td>


                            {{-- ROLE --}}
                            <td class="px-6 py-5">

                                <span class="inline-flex items-center
                                             rounded-full px-3 py-1.5
                                             text-xs font-semibold ring-1
                                             {{ $roleClass }}">

                                    <span class="mr-2 h-1.5 w-1.5
                                                 rounded-full bg-current">
                                    </span>

                                    {{ ucfirst($user->role) }}

                                </span>

                            </td>


                            {{-- PHONE --}}
                            <td class="px-6 py-5">

                                <span class="text-sm text-slate-600">
                                    {{ $user->no_hp ?? '-' }}
                                </span>

                            </td>


                            {{-- ACTION --}}
                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">

                                    <a href="{{ route('admin.user.edit', $user->id) }}"
                                       class="inline-flex items-center gap-2
                                              rounded-xl border border-amber-200
                                              bg-amber-50 px-4 py-2.5
                                              text-xs font-semibold
                                              text-amber-700 transition
                                              hover:bg-amber-100">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-4 w-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M11 5H6a2 2 0
                                                     00-2 2v11a2
                                                     2 0 002 2h11a2
                                                     2 0 002-2v-5
                                                     M18.5 2.5a2.121
                                                     2.121 0 013 3L12
                                                     15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>

                                        Edit

                                    </a>


                                    <form method="POST"
                                          action="{{ route('admin.user.destroy', $user->id) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="inline-flex items-center gap-2
                                                       rounded-xl border
                                                       border-red-200 bg-red-50
                                                       px-4 py-2.5 text-xs
                                                       font-semibold text-red-600
                                                       transition hover:bg-red-100">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="h-4 w-4"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor"
                                                 stroke-width="2">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M19 7l-.867
                                                         12.142A2 2 0
                                                         0116.138 21H7.862
                                                         a2 2 0 01-1.995
                                                         -1.858L5 7m5
                                                         4v6m4-6v6m1-10V4
                                                         a1 1 0 00-1-1h-4a1
                                                         1 0 00-1 1v3M4 7h16"/>
                                            </svg>

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="px-6 py-16 text-center">

                                <div class="mx-auto flex h-16 w-16
                                            items-center justify-center
                                            rounded-2xl bg-slate-100
                                            text-slate-400">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-8 w-8"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         stroke-width="2">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M12 4.354a4 4 0
                                                 110 5.292M15 21H3v-1a6
                                                 6 0 0112 0v1zm0 0h6v-1
                                                 a6 6 0 00-9-5.197"/>
                                    </svg>

                                </div>

                                <h3 class="mt-4 text-lg font-bold text-slate-700">
                                    Tidak ada pengguna
                                </h3>

                                <p class="mt-1 text-sm text-slate-400">
                                    Data pengguna belum tersedia.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- FOOTER --}}
        <div class="border-t border-slate-200 bg-slate-50/60
                    px-6 py-4">

            <div class="flex flex-col gap-3
                        sm:flex-row sm:items-center
                        sm:justify-between">

                <p class="text-sm text-slate-500">

                    Menampilkan

                    <span class="font-semibold text-slate-700">
                        {{ $users->count() }}
                    </span>

                    data pengguna

                </p>

                @if(method_exists($users, 'links'))
                    <div>
                        {{ $users->links() }}
                    </div>
                @endif

            </div>

        </div>

    </div>

</div>

@endsection
