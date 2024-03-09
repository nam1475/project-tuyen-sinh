<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XacNhanXT extends Model
{
    use HasFactory;
    protected $table = 'xac_nhan_xet_tuyen';
    protected $primaryKey = 'MaHoSo';
    protected $fillable = [
        'MaCanBo',
        'MaHoSo',
        'TrangThai',
        'NgayKichHoat',
        'LyDo'
    ];
    public $timestamps = false;
}
