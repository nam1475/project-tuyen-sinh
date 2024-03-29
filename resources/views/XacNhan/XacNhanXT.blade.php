@extends('layouts.app')
  
@section('title')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Trạng thái xác nhận xét tuyển thí sinh</h1>
        
        {{-- action để rỗng thì submit sẽ ở trang chính nó --}}
        <form action="">
            <div class="input-group">
              <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>   
                </button>
              </div>
            </div>
        </form>
    </div>
    <hr />
    {{-- @if(Session::has('thongbao'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('thongbao') }}
        </div>
    @endif --}}
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th class="align-middle text-center"><a href="?sort-by=MaCanBo&sort-type={{ $sortType }}" class="text-decoration-none">Mã cán bộ</a></th>
                <th class="align-middle text-center"><a href="?sort-by=MaHoSo&sort-type={{ $sortType }}" class="text-decoration-none">Mã hồ sơ</a></th>
                <th class="align-middle text-center"><a href="?sort-by=TrangThai&sort-type={{ $sortType }}" class="text-decoration-none">Trạng thái</a></th>
                <th class="align-middle text-center"><a href="?sort-by=NgayKichHoat&sort-type={{ $sortType }}" class="text-decoration-none">Ngày kích hoạt</a></th> 
                <th class="align-middle text-center"><a href="?sort-by=LyDo&sort-type={{ $sortType }}" class="text-decoration-none">Lý do</a></th> 
                {{-- <th class="align-middle text-center">Thao tác</th> --}}
            </tr>
        </thead>
        <tbody>
            @if($XacNhanXT->count() > 0)
                @foreach($XacNhanXT as $xt)
                    <tr>
                        <td class="align-middle text-center">{{ $xt->MaCanBo }}</td>
                        <td class="align-middle text-center">{{ $xt->MaHoSo }}</td>
                        <td class="align-middle text-center">
                            @if($xt->TrangThai == 1)
                                <div class="align-middle text-center"><i class="bx bxs-message-square-check" style="color:green; font-size:40px;"></i></div>
                            @else 
                                <div class="align-middle text-center"><i class="bx bxs-message-square-x" style="color:red; font-size:40px;"></i></div>
                            @endif
                        </td>
                        <td class="align-middle text-center">{{ $xt->NgayKichHoat }}</td>  
                        <td class="align-middle text-center">{{ $xt->LyDo }}</td>  

                        {{-- <td id="status">
                            @if($hs->TrangThai == 1)
                            <div class="align-middle text-center"><i class="bx bxs-message-square-check" style="color:green; font-size:40px;"></i></div>
                            @elseif ($hs->TrangThai == 2) 
                                <div class="align-middle text-center"><i class="bx bxs-message-square-x" style="color:red; font-size:40px;"></i></div>
                            @endif
                        </td> --}}
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">
                        Không tìm thấy thí sinh
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    {{ $XacNhanXT->links() }}
@endsection