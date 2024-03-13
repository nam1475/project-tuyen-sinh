@extends('layouts.app')
  
@section('title')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Hồ sơ thí sinh</h1>
        {{-- action để rỗng thì submit sẽ ở trang chính nó --}}
        <form action="">
            <div class="input-group">
              <input type="text" id="searchInput" name="search" class="form-control bg-light border-1 small" placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" id="searchStudent">
                  <i class="fas fa-search fa-sm"></i>      
                </button>
              </div>    
            </div>
        </form>
        <a href="{{ route('student.create') }}" class="btn btn-primary">Thêm thí sinh</a>
    </div>
    <hr/>
    @if(Session::has('thongBaoTiepNhan'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('thongBaoTiepNhan') }}
        </div>
    @elseif (Session::has('thongBaoTuChoi'))
        <div class="alert alert-warning" role="alert">
            {{ Session::get('thongBaoTuChoi') }}
        </div>
    @elseif(Session::has('thongbao'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('thongbao') }}
        </div>
    @endif
    <table class="table table-hover"  id="hiddenTable">
        <thead class="table-primary">
            <tr>
                <th class="align-middle text-center"><a href="?sort-by=STT&sort-type={{ $sortType }}" class="text-decoration-none">STT</a></th>
                <th class="align-middle text-center"><a href="?sort-by=MaHoSo&sort-type={{ $sortType }}" class="text-decoration-none">Mã hồ sơ</a></th>
                <th class="align-middle text-center"><a href="?sort-by=HoTen&sort-type={{ $sortType }}" class="text-decoration-none">Họ tên</a></th> 
                <th class="align-middle text-center"><a href="?sort-by=CCCD&sort-type={{ $sortType }}" class="text-decoration-none">CCCD</a></th> 
                <th class="align-middle text-center"><a href="?sort-by=Email&sort-type={{ $sortType }}" class="text-decoration-none">Email</a></th>
                <th class="align-middle text-center"><a href="?sort-by=NgaySinh&sort-type={{ $sortType }}" class="text-decoration-none">Ngày sinh</a></th>
                <th class="align-middle text-center"><a href="?sort-by=GioiTinh&sort-type={{ $sortType }}" class="text-decoration-none">Giới tính</a></th>
                <th class="align-middle text-center"><a href="?sort-by=TrinhDoVanHoa&sort-type={{ $sortType }}" class="text-decoration-none">Trình độ văn hóa</a></th>
                <th class="align-middle text-center"><a href="?sort-by=SDT&sort-type={{ $sortType }}" class="text-decoration-none">SĐT</a></th>
                <th class="align-middle text-center"><a href="?sort-by=DiaChi&sort-type={{ $sortType }}" class="text-decoration-none">Địa chỉ</a></th>
                {{-- <th class="align-middle text-center"><a href="?sort-by=HB_bia&sort-type={{ $sortType }}" class="text-decoration-none">HB bìa</a></th>
                <th class="align-middle text-center"><a href="?sort-by=HB_diem&sort-type={{ $sortType }}" class="text-decoration-none">HB điểm</a></th>
                <th class="align-middle text-center"><a href="?sort-by=bang_TN&sort-type={{ $sortType }}" class="text-decoration-none">Bằng TN</a></th>
                <th class="align-middle text-center"><a href="?sort-by=CN_uu_tien&sort-type={{ $sortType }}" class="text-decoration-none">CN ưu tiên</a></th> --}}
                <th class="align-middle text-center">Thao tác</th>
                {{-- <th class="align-middle text-center"><a href="?sort-by=TrangThai&sort-type={{ $sortType }}" class="text-decoration-none">Trạng thái</a></th> --}}
            </tr>
        </thead>

        <tbody>
            @if($student->count() > 0)
                @foreach($student as $st)
                    <tr>
                        {{-- $st->id: Truy cập đến thuộc tính id (Trong model) tương ứng với cột 
                            trong CSDL --}}
                        <td class="align-middle">{{ $st->STT }}</td>
                        <td class="align-middle">{{ $st->MaHoSo }}</td>
                        <td class="align-middle">{{ $st->HoTen }}</td>
                        <td class="align-middle">{{ $st->CCCD }}</td>
                        <td class="align-middle">{{ $st->Email }}</td>
                        <td class="align-middle">{{ $st->NgaySinh }}</td>
                        <td class="align-middle">{{ $st->GioiTinh }}</td>
                        <td class="align-middle">{{ $st->TrinhDoVanHoa }}</td>  
                        <td class="align-middle">{{ $st->SDT }}</td>  
                        <td class="align-middle">{{ $st->DiaChi }}</td>
                        {{-- <td class="align-middle"><a href="{{ $st->HB_bia }}" target="_blank">{{ $st->HB_bia }}</a></td>  
                        <td class="align-middle"><a href="{{  $st->HB_diem  }}" target="_blank">{{  $st->HB_diem  }}</a></td>  
                        <td class="align-middle"><a href="{{  $st->bang_TN  }}" target="_blank">{{  $st->bang_TN  }}</a></td>  
                        <td class="align-middle"><a href="{{  $st->CN_uu_tien  }}" target="_blank">{{  $st->CN_uu_tien  }}</a></td>   --}}
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                {{-- <a href="{{ route('student.sendEmailAccepted', $st->id) }}" class="btn btn-success">Tiếp nhận</a> --}}
                                <form action="{{ route('student.sendEmailAccepted', $st->MaHoSo) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Tiếp nhận</button>   
                                </form>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-id="{{ $st->MaHoSo }}" data-bs-target="#modalSendEmail" data-bs-user-email="{{ $st->Email }}">Ko tiếp nhận</button>
                                {{-- ds-bs-target: Nhảy đến một thẻ chỉ định khi click vào button hoặc 1 sự kiện nào đấy --}}
                                
                                {{-- Vào trong này sẽ mất vòng lặp --}}
                                <div class="modal fade" id="modalSendEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Lý do ko tiếp nhận thí sinh</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('student.sendEmailDenied') }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="studentId" class="col-form-label">ID sinh viên:</label>
                                                        <input name="student_id" class="form-control" id="studentId" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-email" class="col-form-label">Email nhận:</label>
                                                        <input type="text" class="form-control" id="recipient-email" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Lý do:</label>
                                                        <textarea class="form-control" name="messageDenied" id="message-text"></textarea>
                                                    </div>

                                                    <div class="modal-footer"> 
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary">Gửi email</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('DSChoTiepNhan.show', $st->MaHoSo) }}"  type="button" class="btn btn-info">Info</a>
                                <a href="{{ route('DSChoTiepNhan.edit', $st->MaHoSo)}}" type="button" class="btn btn-secondary">Sửa</a>
                                {{-- <form action="{{ route('DSChoTiepNhan.destroy', $st->MaHoSo) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Bạn có chắc muốn xóa SV này ?')">
                                    @csrf
                                    @method('DELETE')   
                                    <button class="btn btn-danger m-0">Xóa</button>
                                </form> --}}
                            </div>
                        </td>
                        {{-- <td id="status">
                            @if($st->TrangThai == 1)
                            <div class="align-middle text-center"><i class="bx bxs-message-square-check" style="color:green; font-size:40px;"></i></div>
                            @elseif ($st->TrangThai == 2) 
                                <div class="align-middle text-center"><i class="bx bxs-message-square-x" style="color:red; font-size:40px;"></i></div>
                            @endif
                        </td> --}}
                    </tr>
                @endforeach
            @else
                <tr id="notFound">
                    <td class="text-center" colspan="5">
                        Không tìm thấy thí sinh
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    <script>
        /* Hiện cửa số nhỏ để nhập lý do ko tiếp nhận và gửi email cho thí sinh đó: */
            const modal = document.getElementById('modalSendEmail');
            if (modal) {
                /* show.bs.modal: Được kích hoạt để hiển thị 1 cửa sổ nhỏ trên màn hình khi click vào button */
                modal.addEventListener('show.bs.modal', event => {
                    /* event.relatedTarget: Trong TH này sẽ trả về ptu button 'Ko tiếp nhận' mà đã click trước đó */
                    const button = event.relatedTarget;
    
                    /* Lấy giá trị(email của thí sinh) trong thuộc tính data-bs-user-email: */
                    const recipient = button.getAttribute('data-bs-user-email');
                    const studentId = button.getAttribute('data-bs-id');
    
                    /* Lấy ra thẻ chứa id #recipient-email */
                    const recipientInput = modal.querySelector('.modal-body #recipient-email');
                    const idInput = modal.querySelector('.modal-body #studentId');
                    
                    /* Gán giá trị của trường input #recipient-email = email của thí sinh */
                    recipientInput.value = recipient;
                    idInput.value = studentId;
                });
            }

    </script>
    
    {{ $student->links() }}
@endsection