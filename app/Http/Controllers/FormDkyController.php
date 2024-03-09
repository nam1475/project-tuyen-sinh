<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NganhHoc; 
use App\Models\DSChoTiepNhan; 

class FormDkyController extends Controller
{
    /* Thêm SV */
    public function create()
    {
        $nganhHoc = NganhHoc::all();
        return view('ThiSinh.create', compact('nganhHoc'));
    }

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
        
        DSChoTiepNhan::create([
            'MaHoSo' => $profileId,
            'HoTen' => $request->HoTen,
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
            'NV1' => $request->NV1,
            'NV2' => $request->NV2,
            'Diem' => $request->Diem
        ]);
        
        // $dk_nv = _dang_ky_nguyen_vong::create($request->all());
        // $ThiSinh = new Student($studentData);
        // $dk_nv->students()->save($ThiSinh);
        return redirect()->route('DangKy.create')->with('thongbao', 'Thêm sinh viên thành công!');
    }

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
}
