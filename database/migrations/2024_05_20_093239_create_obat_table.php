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
        Schema::create('persediaan_rutin', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('nama_sediaan');
            $table->string('satuan');
            $table->integer('stok');
            $table->date('expired_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persediaan_rutin');
    }
};
