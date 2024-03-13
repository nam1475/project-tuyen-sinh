<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DSChoTiepNhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Mail\AdmissionAcceptedEmail;
use App\Mail\AdmissionDeniedEmail;

class XacNhanXT extends Model
{
    use HasFactory;
    protected $table = 'xac_nhan_xet_tuyen';
    protected $primaryKey = 'MaHoSo';
    protected $fillable = [
        'MaCanBo',
        'MaHoSo',
        'TrangThai',
        // 'NgayKichHoat',
        'LyDo'
    ];
    // public $timestamps = false;

    /* DS xác nhận XT */
    public function dsXacNhanXT($sortType, $columnName, Request $request){
        $xacNhanXT = XacNhanXT::paginate(5);
        
        /* Tìm kiếm thí sinh */
        if($search = $request->search){
            $xacNhanXT = XacNhanXT::where('MaHoSo', '=', $search)
                                    ->orWhere('NgayKichHoat', '=', $search)
                                    ->orWhere('LyDo', '=', $search)
                                    ->paginate(5);
            return $xacNhanXT;
        }
        
        /* Sắp xếp thí sinh */
        if(!empty($sortType) && !empty($columnName)){
            $xacNhanXT = XacNhanXT::orderBy($columnName, $sortType)->paginate(5);
            return $xacNhanXT;
        }

        return $xacNhanXT;
    }

    /* Gửi email trúng tuyển */
    public function sendAmsAcceptedEmail(Request $request){
        $studentId = $request->input('student_id');
        $nvTrungTuyen = $request->input('nvTrungTuyen');
        $student = DSChoTiepNhan::findOrFail($studentId);
        $mailData = [
            'title' => 'Chúc mừng bạn đã trúng tuyển!',
            'name' => $student->HoTen
        ];
        Mail::to($student->Email)->send(new AdmissionAcceptedEmail($mailData));

        DSTrungTuyen::create([
            'MaHoSo' => $studentId,
            'MaNganh' => $nvTrungTuyen,     
            // 'TenNganh' => $student->TenNganh,
        ]);

        XacNhanXT::create([
            'MaCanBo' => auth()->user()->id,    
            'MaHoSo' => $student->MaHoSo,
            'TrangThai' => 1,
            // 'NgayKichHoat' => Carbon::now()->toDateTimeString()
        ]);
        
    }

    /* Gửi email ko trúng tuyển */
    public function sendAmsDeniedEmail(Request $request)
    {
        $studentId = $request->input('student_id');
        $student = DSChoTiepNhan::find($studentId);
        $mailData = [
            'title' => 'Bạn không trúng tuyển!',
            'body' => $request->input('messageDenied'),
            'name' => $student->HoTen
        ];
        Mail::to($student->Email)->send(new AdmissionDeniedEmail($mailData));

        XacNhanXT::create([
            'MaCanBo' => auth()->user()->id,    
            'MaHoSo' => $student->MaHoSo,
            'TrangThai' => 0,
            'NgayKichHoat' => Carbon::now()->toDateTimeString(),
            'LyDo' => $request->input('messageDenied')
        ]);

    }








}
