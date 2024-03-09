<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DSChoTiepNhan; 
use Illuminate\Support\Facades\Session;

class TraCuuController extends Controller
{
    public function loginStudentProfile(){
        return view('Tra_cuu.login_student_profile');
    }

    public function studentProfile(Request $request){
        $CCCD = $request->input('CCCD');
        $student = DSChoTiepNhan::find($CCCD);
        return view('Tra_cuu.student_profile', compact('student'));
    }

    public function editStudentProfile(string $MaHoSo){
        
    }

    public function updateStudentProfile(Request $request, string $MaHoSo){

    }

    public function searchStudentProfile(){
        $search = request()->search_profile;
        $student = DSChoTiepNhan::where('MaHoSo', '=', $search)->get();
        Session::put('thongBaoTimKiem', 'Tìm kiếm thành công!');
        return view('Tra_cuu.search_student_profile', compact('student', 'search'));
    }
}
