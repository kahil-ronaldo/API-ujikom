<?php

namespace Database\Seeders;

use App\Models\Peminjaman;
use Illuminate\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
{
    $peminjaman = [
        [
            'user_id' => 3,
            'tanggal_pinjam' => '2026-06-01',
            'tanggal_kembali_plan' => '2026-06-04',
            'status' => 'dikembalikan',
        ],
        [
            'user_id' => 4,
            'tanggal_pinjam' => '2026-06-02',
            'tanggal_kembali_plan' => '2026-06-05',
            'status' => 'dikembalikan',
        ],
        [
            'user_id' => 3,
            'tanggal_pinjam' => '2026-06-03',
            'tanggal_kembali_plan' => '2026-06-06',
            'status' => 'telat',
        ],
        [
            'user_id' => 3,
            'tanggal_pinjam' => '2026-06-08',
            'tanggal_kembali_plan' => '2026-06-11',
            'status' => 'dipinjam',
        ],
        [
            'user_id' => 4,
            'tanggal_pinjam' => '2026-06-09',
            'tanggal_kembali_plan' => '2026-06-12',
            'status' => 'diajukan',
        ],
    ];

    foreach ($peminjaman as $pinjam) {
        Peminjaman::create($pinjam);
    }
}
};