<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DSXetTuyen extends Model
{
    use HasFactory;
    protected $table = 'ds_xet_tuyen';
    protected $primaryKey = 'MaHoSo';
    protected $fillable = [
        'MaHoSo',
        'PhuongThucXT',
        'NV1',
        'NV2',
        'KhoiTS',
        'Toán',
        'Văn',
        'Anh',
        'Lý',
        'Hóa',
        'Sinh',
        'TongDiem',
    ];

    public $timestamps = false;

    public function getTable(){
        return $this->table;
    }

    // public function students()
    // {
    //     return $this->hasOne(Student::class);
    // }
}
