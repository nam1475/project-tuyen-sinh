<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DSChoTiepNhan;
use App\Models\DSXetTuyen;
use App\Mail\EmailAccepted;
use App\Mail\EmailDenied;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;


class XacNhanHS extends Model
{
    use HasFactory;
    protected $table = 'xac_nhan_ho_so';
    protected $primaryKey = 'MaHoSo';
    protected $fillable = [
        'MaCanBo',
        'MaHoSo',
        'TrangThai',
        // 'NgayKichHoat',
        'LyDo'
    ];
    // public $timestamps = false;

    /* DS xác nhận HS */
    public function dsXacNhanHS($sortType, $columnName, Request $request){
        $XacNhanHS = XacNhanHS::paginate(5);
        
        /* Tìm kiếm thí sinh */
        if($search = $request->search){
            $XacNhanHS = XacNhanHS::where('MaHoSo', '=', $search)
                                    ->orWhere('NgayKichHoat', '=', $search)
                                    ->orWhere('LyDo', '=', $search)
                                    ->paginate(5);
            return $XacNhanHS;
        }
        
        /* Sắp xếp thí sinh */
        if(!empty($sortType) && !empty($columnName)){
            $XacNhanHS = XacNhanHS::orderBy($columnName, $sortType)->paginate(5);
            return $XacNhanHS;
        }

        return $XacNhanHS;
    }

    /* Gửi email đc tiếp nhận hồ sơ */
    public function sendEmailAccepted(string $MaHoSo)
    {
        $student = DSChoTiepNhan::findOrFail($MaHoSo);
        $mailData = [
            'title' => 'Bạn đã được tiếp nhận đăng ký xét tuyển',
            'name' => $student->HoTen
        ];
        Mail::to($student->Email)->send(new EmailAccepted($mailData));

        /* Update trạng thái = 1 -> Đã tiếp nhận */
        XacNhanHS::create([
            'MaCanBo' => auth()->user()->id,    
            'MaHoSo' => $student->MaHoSo,
            'TrangThai' => 1,
            // 'NgayKichHoat' => Carbon::now()->toDateTimeString()
        ]);

        DSXetTuyen::create([
            'MaHoSo' => $student->MaHoSo,
            'PhuongThucXT' => $student->PhuongThucXT,
            'NV1' => $student->NV1,     
            'NV2' => $student->NV2, 
            'KhoiTS' => $student->KhoiTS,
            'Toán' => $student->Toán,
            'Văn' => $student->Văn,
            'Anh' => $student->Anh,
            'Lý' => $student->Lý,
            'Hóa' => $student->Hóa,
            'Sinh' => $student->Sinh,
            'TongDiem' => $student->TongDiem,
        ]);         
    }

    /* Gửi email ko đc tiếp nhận hồ sơ */
    public function sendEmailDenied(Request $request)
    {
        $studentId = $request->input('student_id');
        $student = DSChoTiepNhan::find($studentId);
        $mailData = [
            'title' => 'Bạn không được tiếp nhận đăng ký xét tuyển',
            'body' => $request->input('messageDenied'),
            'name' => $student->HoTen
        ];
        Mail::to($student->Email)->send(new EmailDenied($mailData));

        /* Update trạng thái = 0 -> Ko tiếp nhận */
        XacNhanHS::create([
            'MaCanBo' => auth()->user()->id,
            'MaHoSo' => $student->MaHoSo,
            'TrangThai' => 0,
            'NgayKichHoat' => Carbon::now()->toDateTimeString(),
            'LyDo' => $request->input('messageDenied')
        ]);        
    }



}
