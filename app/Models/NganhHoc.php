<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NganhHoc extends Model
{
    use HasFactory;
    protected $table = 'nganh_hoc';
    protected $primaryKey = 'MaNganh';
    protected $fillable = [
        'MaNganh',
        'TenNganh'
    ];
    public $timestamps = false;

    public function getTenNganh(){
        return $this->TenNganh;
    }
}
