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
        Schema::create('formularium', function (Blueprint $table) {
            $table->id();
            $table->integer('id_obat');
            $table->string('kelas_terapi');
            $table->string('sub_kelas_terapi');
            $table->string('peresepan_maksimal');
            $table->text('keterangan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formularium');
    }
};
