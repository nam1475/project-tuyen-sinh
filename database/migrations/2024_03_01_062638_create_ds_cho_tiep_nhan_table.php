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
        Schema::create('ds_cho_tiep_nhan', function (Blueprint $table) {
            $table->increments('STT');
            $table->integer('MaHoSo')->unique();
            $table->string('HoTen')->nullable();
            $table->integer('CCCD')->nullable()->unique();
            $table->string('Email')->nullable();
            $table->string('NgaySinh')->nullable();
            $table->string('GioiTinh')->nullable();
            $table->string('TrinhDoVanHoa')->nullable();
            $table->string('SDT')->nullable();
            $table->string('DiaChi')->nullable();
            $table->string('HB_bia')->nullable();
            $table->string('HB_diem')->nullable();
            $table->string('bang_TN')->nullable();
            $table->string('CN_uu_tien')->nullable();
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
            $table->float('TongDiem')->nullable(); // Tạo function riêng
            // $table->timestamp('NgayTao')->useCurrent()->nullable();
            // $table->timestamp('NgaySua')->useCurrentOnUpdate()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_cho_tiep_nhan');
    }
};
