<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    /* DS trúng tuyển */
    public function dsTrungTuyen($sortType, $columnName, Request $request){
        $DSTrungTuyen = DSTrungTuyen::paginate(5);
        
        /* Tìm kiếm thí sinh */
        if($search = $request->search){
            $searchList = DSTrungTuyen::where('MaHoSo', '=', $search)->paginate(5);
            return $searchList;
        }
        
        /* Sắp xếp thí sinh */
        if(!empty($sortType) && !empty($columnName)){
            $sortList = DSTrungTuyen::orderBy($columnName, $sortType)->paginate(5);
            return $sortList;
        }

        /* Lọc DS theo ngành */
        $maNganh = $request->input('filter-by');
        if(!empty($maNganh)){
            $filterList = DSTrungTuyen::where('MaNganh', '=', $maNganh)->paginate(5);
            return $filterList;
        }

        return $DSTrungTuyen;
    }

}
