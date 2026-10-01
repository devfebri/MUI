<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Menggunakan updateOrCreate agar idempotent — aman dijalankan berkali-kali.
     */
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Operator user
        User::updateOrCreate(
            ['email' => 'operator@operator.com'],
            [
                'name' => 'Operator',
                'username' => 'operator',
                'password' => Hash::make('password'),
                'role' => 'operator',
                'email_verified_at' => now(),
            ]
        );

        // Kategori Berita Default
        $defaultKategori = [
            'Berita Utama',
            'Fatwa',
            'Bimbingan',
            'Halal',
            'Khutbah',
            'Opini',
            'Nasional',
            'Internasional',
            'Ekonomi',
            'Teknologi',
            'Sosial',
            'Kabar Daerah',
        ];

        foreach ($defaultKategori as $i => $nama) {
            Kategori::updateOrCreate(
                ['nama' => $nama],
                [
                    'slug' => Str::slug($nama),
                    'warna' => '#007f5f',
                    'aktif' => true,
                    'urutan' => $i + 1,
                ]
            );
        }
    }
}
