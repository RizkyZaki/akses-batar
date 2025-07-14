<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('setting', function (Blueprint $table) {
      $table->id();
      $table->string('app_name');             // Nama aplikasi/instansi
      $table->string('headline_name');             // Nama aplikasi/instansi
      $table->string('desc_name');             // Nama aplikasi/instansi
      $table->string('logo')->nullable();     // Logo utama
      $table->string('email')->nullable();    // Email admin/kontak
      $table->string('phone')->nullable();    // No. telepon instansi
      $table->text('address')->nullable();    // Alamat instansi
      $table->text('footer_text')->nullable(); // Teks di footer
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('setting');
  }
};
