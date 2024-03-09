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
        Schema::create('ds_trung_tuyen', function (Blueprint $table) {
            $table->integer('MaHoSo')->primary();
            $table->integer('MaNganh')->nullable();
            $table->string('TenNganh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_trung_tuyen');
    }
};
