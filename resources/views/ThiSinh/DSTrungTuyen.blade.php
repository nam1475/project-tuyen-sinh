    @extends('layouts.app')
    
    @section('contents')
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="mb-0">Danh sách trúng tuyển</h1>
            {{-- action để rỗng thì submit sẽ ở trang chính nó --}}
            <form action="">
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-light border-1 small" placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>   
                    </button>
                    </div>
                </div>
            </form>

            <form action="">
                <button class="btn btn-primary dropdown-toggle" name="majorList" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Ngành học
                </button>
                <ul class="dropdown-menu">
                    @foreach ($DSNganhHoc as $nh)
                        <li><a class="dropdown-item" href="?filter-by={{ $nh->MaNganh }}">{{ $nh->TenNganh }}</a></li>
                    @endforeach
                </ul>
            </form>

            {{-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Lọc</button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel">Phân loại</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form action="">    
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" name="majorList" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Ngành học
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($DSNganhHoc as $nh)
                                    <li><a class="dropdown-item" href="?filter-by={{ $nh->MaNganh }}">{{ $nh->TenNganh }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </form>
                </div>
            </div> --}}
            
        </div>
        <hr/>
        {{-- @if(Session::has('thongbao'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('thongbao') }}
            </div>
        @endif --}}
        <table class="table table-hover table-responsive">
            <thead class="table-primary">
                <tr>
                    <th class="align-middle text-center"><a href="?sort-by=MaHoSo&sort-type={{ $sortType }}" class="text-decoration-none">Mã hồ sơ</a></th>
                    <th class="align-middle text-center"><a href="?sort-by=MaNganh&sort-type={{ $sortType }}" class="text-decoration-none">Mã ngành</a></th>
                    {{-- <th class="align-middle text-center"><a href="?sort-by=TenNganh&sort-type={{ $sortType }}" class="text-decoration-none">Tên ngành</a></th>  --}}
                    {{-- <th class="align-middle text-center">Thao tác</th> --}}
                </tr>
            </thead>
            <tbody>
                @if($DSTrungTuyen->count() > 0)
                    @foreach($DSTrungTuyen as $tt)
                        <tr>
                            <td class="align-middle">{{ $tt->MaHoSo }}</td>
                            <td class="align-middle">{{ $tt->MaNganh }}</td>
                            {{-- <td class="align-middle">{{ $tt->TenNganh }}</td>   --}}
                            {{-- <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('DSTrungTuyen.show', $tt->MaHoSo) }}"  type="button" class="btn btn-info">Info</a>
                                    <a href="{{ route('DSTrungTuyen.edit', $tt->MaHoSo)}}" type="button" class="btn btn-warning">Sửa</a>
                                    <form action="{{ route('DSTrungTuyen.destroy', $tt->MaHoSo) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Bạn có chắc muốn xóa SV này ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger m-0">Xóa</button>
                                    </form>
                                </div>
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
        {{ $DSTrungTuyen->links() }}
    @endsection