<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    // public $timestamps = false;

    public function getTable(){
        return $this->table;
    }

    public function dsChoTiepNhan($sortType, $columnName, Request $request){
        $DSChoTiepNhan = DSChoTiepNhan::paginate(5);
        
        /* Tìm kiếm thí sinh */
        if($search = $request->search){
            $searchList = DSChoTiepNhan::where('MaHoSo', '=', $search)
                                            ->orWhere('HoTen', 'like', '%' . $search . '%')
                                            ->orWhere('DiaChi', 'like', '%' . $search . '%')
                                            ->orWhere('TrinhDoVanHoa', 'like', '%' . $search . '%')
                                            ->paginate(5);
            return $searchList;
        }
        
        /* Sắp xếp thí sinh */
        if(!empty($sortType) && !empty($columnName)){
            if($columnName == 'HoTen' || $columnName == 'DiaChi'){
                $sortList =  DSChoTiepNhan::orderByRaw("SUBSTRING_INDEX($columnName, ' ', -1) $sortType")->paginate(5);
                return $sortList;
            }
            else{
                $sortList = DSChoTiepNhan::orderBy($columnName, $sortType)->paginate(5);
                return $sortList;
            }
        }

        return $DSChoTiepNhan;
    }
    
    // public function DKNguyenVong()
    // {
    //     return $this->belongsTo(_dang_ky_nguyen_vong::class);
    // }
}
