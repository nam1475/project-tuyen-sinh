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
        Schema::create('ds_xet_tuyen', function (Blueprint $table) {
            $table->integer('MaHoSo')->primary();
            $table->string('PhuongThucXT')->nullable();
            $table->string('NV1')->nullable();
            $table->string('NV2')->nullable();
            $table->string('KhoiTS')->nullable();
            $table->float('Toán')->nullable();
            $table->float('Văn')->nullable();
            $table->float('Anh')->nullable();
            $table->float('Lý')->nullable();
            $table->float('Hóa')->nullable();
            $table->float('Sinh')->nullable();
            $table->float('TongDiem')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_xet_tuyen');
    }
};
