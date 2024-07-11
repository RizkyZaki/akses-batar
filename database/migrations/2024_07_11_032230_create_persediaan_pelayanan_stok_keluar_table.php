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
        Schema::create('persediaan_pelayanan_stok_keluar', function (Blueprint $table) {
            $table->id();
            $table->integer('persediaan_pelayanan_id');
            $table->integer('stok_keluar');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persediaan_pelayanan_stok_keluar');
    }
};
