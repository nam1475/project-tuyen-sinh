@extends('layouts.app')
  
@section('title')
  
@section('contents')
<div class="card" style="margin:20px;">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h1>Hồ sơ thí sinh</h1>
        <a href="{{ route('student.DSChoTiepNhan') }}" class="btn btn-primary">Danh sách thí sinh</a>
    </div>
    <div class="card-body d-flex justify-content-between">
        <div class="card-body">
          <h4>Thông tin cá nhân</h4>
          <p class="card-title">Họ tên: {{ $student->HoTen }}</p>
          <p class="card-title">Email: {{ $student->Email }}</p>  
          <p class="card-text">Ngày sinh: {{ $student->NgaySinh }}</p>
          <p class="card-text">Giới tính: {{ $student->GioiTinh }}</p>
          <p class="card-text">Trình độ văn hóa: {{ $student->TrinhDoVanHoa }}</p>
          <p class="card-text">SĐT: {{ $student->SDT }}</p>
          <p class="card-text">Địa chỉ: {{ $student->DiaChi }}</p>
        </div>
        <div class="card-body">
          <h4>Ảnh minh chứng</h4>
          <p class="card-text">Học bạ bìa: <a href="{{ $student->HB_bia }}" target="_blank"> {{ $student->HB_bia }}</a></p>
          <p class="card-text">Học bạ điểm: <a href="{{ $student->HB_diem }}" target="_blank"> {{ $student->HB_diem }}</a></p>
          <p class="card-text">Bằng TN: <a href="{{ $student->bang_TN }}" target="_blank"> {{ $student->bang_TN }}</a></p>
          <p class="card-text">CN ưu tiên: <a href="{{ $student->CN_uu_tien }}" target="_blank"> {{ $student->CN_uu_tien }}</a></p>
        </div>
        <div class="card-body">
          <h4>Đky nguyện vọng</h4>
          <p class="card-text">Phương thức XT: {{ $student->PhuongThucXT }}</p>
          <p class="card-text">Nguyện vọng 1: {{ $student->NV1 }}</p>
          <p class="card-text">Nguyện vọng 2: {{ $student->NV2 }}</p>
          <p class="card-text">Khối TS: {{ $student->KhoiTS }}</p>
          <p class="card-text">Toán: {{ $student->Toán }}</p>
          <p class="card-text">Văn: {{ $student->Văn }}</p>
          <p class="card-text">Anh: {{ $student->Anh }}</p>
          <p class="card-text">Lý: {{ $student->Lý }}</p>
          <p class="card-text">Hóa: {{ $student->Hóa }}</p>
          <p class="card-text">Sinh: {{ $student->Sinh }}</p>
          <p class="card-text">Tổng điểm: {{ $student->TongDiem }}</p>
        </div>
      </hr>
    </div>
  </div>
@endsection