@extends('layouts.app')
  
@section('title')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Sửa hồ sơ thí sinh</h1>
        <a href="{{ route('student.DSChoTiepNhan') }}" class="btn btn-primary">Danh sách thí sinh</a>
    </div>
    <hr />
    <form action="{{ route('DSChoTiepNhan.update', $student->MaHoSo) }}" method="POST">
        @csrf
        @method('PUT')
        <h4 class="mt-4">Thông tin cá nhân</h4>
        <div class="row mb-3 justify-content-around">
            <div class="col-lg-4">
                <strong>Họ tên</strong>
                <input type="text" name="HoTen" value="{{ $student->HoTen }}" class="form-control" placeholder="Họ tên">
            </div>
            <div class="col-lg-4">
                <strong>Ngày sinh</strong>
                <input type="date" name="NgaySinh" value="{{ $student->NgaySinh }}" class="form-control">
            </div>
            <div class="col-lg-4">
                <strong>Giới tính</strong>
                <select name="GioiTinh" class="form-select">
                    <option selected></option>
                    <option value="Nam" {{ $student->GioiTinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                    <option value="Nữ" {{ $student->GioiTinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                </select>
            </div>
        </div>
        <div class="row mb-3 justify-content-around">
            <div class="col-lg-4">
                <strong>Trình độ văn hóa</strong>
                <select name="TrinhDoVanHoa" class="form-select">
                    <option selected></option>
                    <option value="THCS" {{ $student->TrinhDoVanHoa == 'THCS' ? 'selected' : '' }}>THCS</option>
                    <option value="THPT" {{ $student->TrinhDoVanHoa == 'THPT' ? 'selected' : '' }}>THPT</option>
                </select>
            </div>
            <div class="col-lg-4">
                <strong>SĐT</strong>
                <input type="text" name="SDT" value="{{ $student->SDT }}" class="form-control" placeholder="SĐT">
            </div>
            <div class="col-lg-4">
                <strong>Địa chỉ</strong>
                <input type="text" name="DiaChi" value="{{ $student->DiaChi }}" class="form-control" placeholder="Địa chỉ">
            </div>
        </div>
        <div class="row mb-3 ">
            <div class="col-lg-4">
                <strong>Email</strong>
                <input type="email" name="Email" value="{{ $student->Email }}" class="form-control" placeholder="Email">
            </div>
            <div class="col-lg-4">
                <strong>CCCD</strong>
                <input type="text" name="CCCD" value="{{ $student->CCCD }}" class="form-control" placeholder="CCCD">
            </div>
        </div>

        <h4 class="mt-5">Ảnh minh chứng</h4>
        <div class="row mb-3 justify-content-around">
            <div class="col-lg-4">
                <strong>Ảnh học bạ điểm</strong>
                <input type="file" name="HB_diem" value="{{ $student->HB_diem }}" class="form-control">
            </div>
            <div class="col-lg-4">
                <strong>Ảnh bằng TN</strong>
                <input type="file" name="bang_TN" value="{{ $student->bang_TN }}" class="form-control">
            </div>
            <div class="col-lg-4">
                <strong>Ảnh chứng nhận ưu tiên(Nếu có)</strong>
                <input type="file" name="CN_uu_tien" value="{{ $student->CN_uu_tien }}" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-4">
                <strong>Ảnh học bạ bìa</strong>
                <input type="file" name="HB_bia" value="{{ $student->HB_bia }}" class="form-control">
            </div>
        </div>
        
        <h4 class="mt-5">Đăng ký nguyện vọng</h4>
        <div class="row mb-3 justify-content-around">
            <div class="col-lg-4">
                <strong>Phương thức xét tuyển</strong>
                <select name="PhuongThucXT" class="form-select">
                    <option value="" selected></option>
                    <option value="THPTQG" {{ $student->PhuongThucXT == "THPTQG" ? 'selected' : '' }}>Xét điểm thi THPTQG</option>
                    <option value="HocBa" {{ $student->PhuongThucXT == "HocBa" ? 'selected' : '' }}>Xét điểm học tập THPT(Học bạ)</option>
                </select>
            </div>

            <div class="col-lg-4">
                <strong>Nguyện vọng 1</strong>
                <select name="NV1" class="form-select">
                    <option value="" selected></option>
                    @foreach ($nganhHoc as $nh)
                        @if($nh->MaNganh == $student->NV1)
                            <option value="{{ $nh->MaNganh }}" selected>{{ $nh->TenNganh }}</option>
                        @else
                            <option value="{{ $nh->MaNganh }}">{{ $nh->TenNganh }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4">
                <strong>Nguyện vọng 2</strong>
                <select name="NV2" class="form-select">
                    <option value="" selected></option>
                    @foreach ($nganhHoc as $nh)
                        @if($nh->MaNganh == $student->NV2)
                            <option value="{{ $nh->MaNganh }}" selected>{{ $nh->TenNganh }}</option>
                        @else
                            <option value="{{ $nh->MaNganh }}">{{ $nh->TenNganh }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-4">
                <strong>Khối tuyển sinh</strong>
                <select name="KhoiTS" class="form-select">
                    <option value="" selected></option>
                    @foreach ($khoiTS as $kts)
                        @if($kts->TenKhoi == $student->KhoiTS)
                            <option value="{{ $kts->TenKhoi }}" selected>{{ $kts->TenKhoi }}</option>
                        @else
                            <option value="{{ $kts->TenKhoi }}">{{ $kts->TenKhoi }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

        </div>
 
        <div class="text-center">
            <button type="submit" class="btn btn-success">Lưu</button>
        </div>
    </form>
@endsection