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
            $table->string('peresepan_maksimal')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formularium', function (Blueprint $table) {
            $table->string('peresepan_maksimal')->nullable(false)->change();
        });
    }
};