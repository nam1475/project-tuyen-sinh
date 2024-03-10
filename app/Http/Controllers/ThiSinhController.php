<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DSChoTiepNhan;
use App\Models\DSXetTuyen;
use App\Models\XacNhanHS;
use App\Models\XacNhanXT;
use App\Models\DSTrungTuyen;
use App\Models\NganhHoc; 
use App\Models\KhoiTS; 
use App\Http\Requests\ValidationRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailAccepted;
use App\Mail\EmailDenied;
use App\Mail\AdmissionAcceptedEmail;
use App\Mail\AdmissionDeniedEmail;
use Illuminate\Contracts\Session\Session;
use Twilio\Rest\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use function Laravel\Prompts\search;

class ThiSinhController extends Controller
{   
    public function XacNhanHS(){
        $XacNhanHS = XacNhanHS::paginate(5);
        return view('XacNhan.XacNhanHS', compact('XacNhanHS'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function XacNhanXT(){
        $XacNhanXT = XacNhanXT::paginate(5);
        return view('XacNhan.XacNhanXT', compact('XacNhanXT'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function DSTrungTuyen(Request $request)
    {
        $DSTrungTuyen = DSTrungTuyen::paginate(5); // Trả về một đối tượng Paginator
        $tt = new DSTrungTuyen();
        $tableName = $tt->getTable();
        
        /* Tìm kiếm thí sinh */
        if($search = request()->search){
            $DSTrungTuyen = $this->searchStudent($tableName, $search);
        }
        
        /* Sắp xếp thí sinh */
        $sortType = request()->input('sort-type');
        $columnName = request()->input('sort-by');
        if(!empty($sortType) && !empty($columnName)){
            $DSTrungTuyen = $this->sortStudent($tableName, $sortType, $columnName);
        }

        if($sortType == 'asc'){
            $sortType = 'desc';
        }
        else{
            $sortType = 'asc';
        }

        /* Lọc DS theo ngành */
        $nganh = $request->input('filter-by');
        if(!empty($nganh)){
            $DSTrungTuyen = DSTrungTuyen::where('MaNganh', '=', $nganh)->paginate(5);
            // return $DSTrungTuyen;
        }
        $DSNganhHoc = NganhHoc::all();

        return view('ThiSinh.DSTrungTuyen', compact('DSTrungTuyen', 'sortType', 'DSNganhHoc'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function DSChoTiepNhan(Request $request)
    {
        $student = DSChoTiepNhan::paginate(5);
        $st = new DSChoTiepNhan();
        $tableName = $st->getTable();

        /* Tìm kiếm thí sinh */
        if($search = request()->search){
            $student = $this->searchStudent($tableName, $search);
        }

        /* Sắp xếp thí sinh */
        $sortType = request()->input('sort-type');
        $columnName = request()->input('sort-by');
        if(!empty($sortType) && !empty($columnName)){
            $student = $this->sortStudent($tableName, $sortType, $columnName);
        }

        if($sortType == 'asc'){
            $sortType = 'desc';
        }
        else{
            $sortType = 'asc';
        }


        return view('ThiSinh.DSChoTiepNhan', compact('student', 'sortType'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    public function DSXetTuyen()
    {
        $DSXetTuyen = DSXetTuyen::paginate(5);
        $xt = new DSXetTuyen();
        $tableName = $xt->getTable();

        if($search = request()->search){
            $DSXetTuyen = $this->searchStudent($tableName, $search);
        }

        /* Sắp xếp thí sinh */
        $sortType = request()->input('sort-type');
        $columnName = request()->input('sort-by');
        if(!empty($sortType) && !empty($columnName)){
            $DSXetTuyen = $this->sortStudent($tableName, $sortType, $columnName);
        }

        if($sortType == 'asc'){
            $sortType = 'desc';
        }
        else{
            $sortType = 'asc';
        }

        return view('ThiSinh.DSXetTuyen', compact('DSXetTuyen', 'sortType'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    public function sortStudent($tableName, $sortType, $columnName){
        /* $request->input('sortType'): Trong TH này sẽ trả về gtri của sort-type trên thanh url */
        /* Mặc định ban đầu sort-type = asc */
        if(empty($sortType)){
            $sortType = 'asc';  
        }
        else{
            if($tableName == 'ds_cho_tiep_nhan'){
                /* Sắp xếp cột theo tên cuối: 
                - SUBSTRING_INDEX($columnName, ' ', -1): Lấy phần tên cuối */
                if($columnName == 'HoTen' || $columnName == 'DiaChi'){
                    $sortList =  DSChoTiepNhan::orderByRaw("SUBSTRING_INDEX($columnName, ' ', -1) $sortType")->paginate(5);
                    return $sortList;
                }

                /* Sắp xếp cột theo tên đầu: */
                else{
                    $sortList =  DSChoTiepNhan::orderBy($columnName, $sortType)->paginate(5);
                    return $sortList;
                }
            }
            
            /* Sắp xếp cột theo tên đầu: */
            else{
                if($tableName == 'ds_xet_tuyen'){
                    $sortList =  DSXetTuyen::orderBy($columnName, $sortType)->paginate(5);
                    return $sortList;
                }
                if($tableName == 'ds_trung_tuyen'){
                    $sortList =  DSTrungTuyen::orderBy($columnName, $sortType)->paginate(5);
                    return $sortList;
                }
            }
        }
    }

    public function searchStudent($tableName, $search){
        if($tableName == 'ds_cho_tiep_nhan'){
            $searchList = DSChoTiepNhan::where('MaHoSo', '=', $search)
                                ->orWhere('HoTen', 'like', '%' . $search . '%')
                                ->orWhere('DiaChi', 'like', '%' . $search . '%')
                                ->orWhere('TrinhDoVanHoa', 'like', '%' . $search . '%')
                                ->paginate(5);
            return $searchList;
        }
        else if($tableName == 'ds_xet_tuyen'){
            $searchList = DSXetTuyen::where('MaHoSo', '=', $search)
                                ->paginate(5);
            return $searchList;
        }
        else{
            $searchList = DSTrungTuyen::where('MaHoSo', '=', $search)
                                ->paginate(5);
            return $searchList;
        }
    }

    public function totalGPA($request){
        $totalGPA = $request->Toán + $request->Văn + $request->Anh + $request->Lý 
                    + $request->Hóa + $request->Sinh;
        return $totalGPA;
    }

    /* Tạo mã hồ sơ: aabbcccc trong đó aa là 2 số cuối năm tuyển sinh, bb là mã ngành, cccc là số thứ tự hồ sơ */
    public function profileId($request, $thiSinh = null){
        $student = DSChoTiepNhan::all();
        $year = date('y'); /* 2 số cuối năm hiện tại */
        $majorId = $request->input('NV1') . $request->input('NV2');
        $serial = 0;

        /* Nếu ko có thí sinh nào: */
        if($student->isEmpty()){
            $serial = str_pad("1", 4, '0', STR_PAD_LEFT);
        }
        else{
            foreach($student as $st){
                /* Kiểm tra xem nguyện vọng có được thí sinh sửa đổi ko, nếu sửa rồi thì cập nhật 
                lại mã hồ sơ */
                if($thiSinh != null){
                    if($thiSinh->NV1 != $request->input('NV1') || $thiSinh->NV2 != $request->input('NV1')){
                        $serial = str_pad($thiSinh->STT, 4, '0', STR_PAD_LEFT);
                        $profileId = $year . $majorId .  $serial;
                        return $profileId;
                    }
                }
                else{
                    ++$st->STT;
                    $serial = str_pad($st->STT, 4, '0', STR_PAD_LEFT); /* Nếu $serialList ko đủ 4 số thì chèn thêm số 0 vào bên trái */
                }
            }
        }
        $profileId = $year . $majorId . $serial;
        return $profileId;
    }

    /* Thêm SV */
    public function create()
    {
        $nganhHoc = NganhHoc::all();
        $khoiTS = KhoiTS::all();
        return view('ThiSinh.create', compact('nganhHoc', 'khoiTS'));
    }

    /* Lưu trữ vào database */
    public function store(Request $request)
    {
        /* - $request->HB_bia:  là cách để truy cập đến(lấy) giá trị của 
        trường HB_bia từ HTTP Request.
        - $this: Dùng để truy cập đến các thuộc tính hoặc phương thức trong chính controller đó.
        */
        // $generated_HB_bia = $this->uploadFile($request->HB_bia, 'images_HB_bia', public_path('ThiSinh/images_HB_bia/'));
        // $generated_HB_diem = $this->uploadFile($request->HB_diem, 'images_HB_diem', public_path('ThiSinh/images_HB_diem/'));
        // $generated_bang_TN = $this->uploadFile($request->bang_TN, 'images_bang_TN', public_path('ThiSinh/images_bang_TN/'));
        // $generated_CN_uu_tien = $this->uploadFile($request->CN_uu_tien, 'images_CN_uu_tien', public_path('ThiSinh/images_CN_uu_tien/'));
        
        $profileId = $this->profileId($request);
        $totalGPA = $this->totalGPA($request);
        
        DSChoTiepNhan::create([
            'MaHoSo' => $profileId,
            'HoTen' => $request->HoTen,
            'CCCD' => $request->CCCD,
            'Email' => $request->Email,
            'NgaySinh' => $request->NgaySinh,
            'GioiTinh' => $request->GioiTinh,
            'TrinhDoVanHoa' => $request->TrinhDoVanHoa,
            'SDT' => $request->SDT,
            'DiaChi' => $request->DiaChi,
            // 'TrangThai' => $request->TrangThai,
            // 'HB_bia' => $generated_HB_bia,
            // 'HB_diem' => $generated_HB_diem,
            // 'bang_TN' => $generated_bang_TN,
            // 'CN_uu_tien' => $generated_CN_uu_tien
            'PhuongThucXT' => $request->PhuongThucXT,
            'NV1' => $request->NV1,
            'NV2' => $request->NV2,
            'KhoiTS' => $request->KhoiTS,
            'Toán' => $request->Toán,
            'Văn' => $request->Văn,
            'Anh' => $request->Anh,
            'Lý' => $request->Lý,
            'Hóa' => $request->Hóa,
            'Sinh' => $request->Sinh,
            'TongDiem' => $totalGPA,
        ]);
        
        return redirect()->route('student.DSChoTiepNhan')->with('thongbao', 'Thêm sinh viên thành công!');
    }

    
    // public function uploadFile($file, $prefix, $uploadPath)
    // { 
    //     $generatedFileName = $prefix . '/' . time() . '-' . $file->getClientOriginalName();
    //     $file->move($uploadPath, $generatedFileName);
    //     return $generatedFileName;
    // }

    /* Hiện thông tin SV */
    public function show(string $MaHoSo)
    {
        // $student = DSTrungTuyen::findOrFail($MaHoSo);
        $student = DSChoTiepNhan::findOrFail($MaHoSo);
        return view('ThiSinh.show', compact('student'));
    }

    /* Sửa thông tin SV */
    public function edit(string $MaHoSo)
    {
        $student = DSChoTiepNhan::find($MaHoSo);
        $nganhHoc = NganhHoc::all();
        $khoiTS = KhoiTS::all();
        return view('ThiSinh.edit', compact('student', 'nganhHoc', 'khoiTS'));
    }

    /* Cập nhật thông tin SV */
    public function update(Request $request, string $MaHoSo)
    {
        $student = DSChoTiepNhan::find($MaHoSo);
        $input = $request->all();
        $student->update($input);
        $student->update([
            'MaHoSo' => $this->profileId($request, $student)
        ]);

        $XacNhanHS = XacNhanHS::find($MaHoSo);
        $XacNhanHS->update([
            'MaHoSo' => $this->profileId($request, $student),
        ]);

        $XetTuyen = DSXetTuyen::find($MaHoSo);
        $XetTuyen->update([
            'MaHoSo' => $this->profileId($request, $student),
            'NV1' => $request->input('NV1'),
            'NV2' => $request->input('NV2'),
            'Diem' => $request->input('Diem')
        ]);

        return redirect()->route('student.DSChoTiepNhan')->with('thongbao', 'Cập nhật sinh viên thành công!');
    }

    /* Xóa SV */
    public function destroy(string $MaHoSo)
    {
        $student = DSChoTiepNhan::find($MaHoSo);
        $student->delete();
        return redirect()->route('student.DSChoTiepNhan', $student->MaHoSo)->with('thongbao', 'Xóa sinh viên thành công!');
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
            'NgayKichHoat' => Carbon::now()->toDateTimeString()
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
        
        return redirect()->route('student.DSXetTuyen')->with('thongBaoTiepNhan', 'Gửi email tiếp nhận thành công!');
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
        
        // $student->delete();
        return redirect()->route('student.DSChoTiepNhan')->with('thongBaoTuChoi', 'Gửi email ko tiếp nhận thành công!');
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
            'NgayKichHoat' => Carbon::now()->toDateTimeString()
        ]);
        
        return redirect()->route('student.DSTrungTuyen')->with('thongBaoTiepNhan', 'Gửi email tiếp nhận thành công!');
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

        return redirect()->route('student.DSXetTuyen')->with('thongBaoTuChoi', 'Gửi email ko tiếp nhận thành công!');
    }


    /* public function sendSms()
    {
        $sid = getenv("TWILIO_SID");
        $token = getenv("TWILIO_TOKEN");
        $senderNumber = getenv("TWILIO_PHONE");
        $twilio = new Client($sid, $token);
        $message = $twilio->messages->create("+84825314969", [
            "body" => "Bạn đã đăng ký xét tuyển thành công",
            "from" => $senderNumber
        ]);
        dd('Send success');
    } */

}
