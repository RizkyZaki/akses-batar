<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setting')->insert([
            'app_name' => 'Sistem Informasi Instansi A',
            'logo' => 'uploads/logo.png',
            'email' => 'admin@instansi-a.go.id',
            'phone' => '081234567890',
            'address' => 'Jl. Contoh No. 123, Jakarta',
            'footer_text' => '© 2025 Instansi A. All rights reserved.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
