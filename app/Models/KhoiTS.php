<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhoiTS extends Model
{
    use HasFactory;
    protected $table = 'khoi_ts';
    protected $primaryKey = 'MaKhoi';
    protected $fillable = [
        'MaKhoi',
        'TenKhoi'
    ];
    public $timestamps = false;

    // public function getTenNganh(){
    //     return $this->TenNganh;
    // }
}
