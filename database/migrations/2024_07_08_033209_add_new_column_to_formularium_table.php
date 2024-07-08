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
        Schema::table('formularium', function (Blueprint $table) {
            $table->string('nama_sediaan')->default('')->after('sub_kelas_terapi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formularium', function (Blueprint $table) {
            $table->dropColumn('nama_sediaan');
        });
    }
};