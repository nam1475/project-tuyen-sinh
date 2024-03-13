<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    // public $timestamps = false;

    public function getTable(){
        return $this->table;
    }

    /* DS xét tuyển */
    public function dsXetTuyen($sortType, $columnName, Request $request){
        $DSXetTuyen = DSXetTuyen::paginate(5);
        
        /* Tìm kiếm thí sinh */
        if($search = $request->search){
            $searchList = DSXetTuyen::where('MaHoSo', '=', $search)
                                    ->orWhere('PhuongThucXT', '=', $search)
                                    ->orWhere('KhoiTS', '=', $search)
                                    ->paginate(5);
            return $searchList;
        }
        
        /* Sắp xếp thí sinh */
        if(!empty($sortType) && !empty($columnName)){
            $sortList = DSXetTuyen::orderBy($columnName, $sortType)->paginate(5);
            return $sortList;
        }

        return $DSXetTuyen;
    }

    // public function students()
    // {
    //     return $this->hasOne(Student::class);
    // }
}
