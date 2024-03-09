<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XacNhanHS extends Model
{
    use HasFactory;
    protected $table = 'xac_nhan_ho_so';
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
