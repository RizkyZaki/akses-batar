<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('users')->insert([
      'name' => "Super Admin",
      'email' => 'developer@dev.com',
      'password' => Hash::make('Integrated17@'),
      'role' => UserRole::Pharmacy_Management,
      'created_at' => now()
    ]);
  }
}