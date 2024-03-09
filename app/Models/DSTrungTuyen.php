<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DSTrungTuyen extends Model
{
    use HasFactory;
    protected $table = 'ds_trung_tuyen';
    protected $primaryKey = 'MaHoSo';
    protected $fillable = [
        'MaHoSo',
        'MaNganh',
        'TenNganh',
    ];

    public $timestamps = false;

    public function getTable(){
        return $this->table;
    }

}
