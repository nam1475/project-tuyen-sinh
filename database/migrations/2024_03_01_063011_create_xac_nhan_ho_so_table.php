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
        Schema::create('xac_nhan_ho_so', function (Blueprint $table) {
            $table->integer('MaCanBo');
            $table->integer('MaHoSo')->primary();
            $table->integer('TrangThai')->nullable();
            // $table->dateTime('NgayKichHoat')->nullable();
            // $table->timestamp('NgayKichHoat')->useCurrent();
            $table->string('LyDo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xac_nhan_ho_so');
    }
};
