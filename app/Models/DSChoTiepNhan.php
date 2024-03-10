<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DSChoTiepNhan extends Model
{
    /* - Model là nơi ánh xạ các bản ghi trong CSDL
    - Controller sẽ làm việc qua lại với Model */
    use HasFactory;
    protected $table = 'ds_cho_tiep_nhan';
    protected $primaryKey = 'MaHoSo';
    protected $fillable = [
        'MaHoSo',
        'HoTen', 
        'CCCD', 
        'Email', 
        'NgaySinh', 
        'GioiTinh', 
        'TrinhDoVanHoa',
        'SDT',
        'DiaChi',
        'HB_bia',
        'HB_diem',
        'bang_TN',
        'CN_uu_tien',
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
    
    // public function DKNguyenVong()
    // {
    //     return $this->belongsTo(_dang_ky_nguyen_vong::class);
    // }
}
