@extends('layouts.app')
  
@section('title')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Danh sách xét tuyển thí sinh</h1>
        
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
                <th class="align-middle text-center"><a href="?sort-by=MaHoSo&sort-type={{ $sortType }}" class="text-decoration-none">Mã hồ sơ</a></th>
                <th class="align-middle text-center"><a href="?sort-by=PhuongThucXT&sort-type={{ $sortType }}" class="text-decoration-none">Phương thức XT</a></th>
                <th class="align-middle text-center"><a href="?sort-by=NV1&sort-type={{ $sortType }}" class="text-decoration-none">NV1</a></th>
                <th class="align-middle text-center"><a href="?sort-by=NV2&sort-type={{ $sortType }}" class="text-decoration-none">NV2</a></th> 
                <th class="align-middle text-center"><a href="?sort-by=KhoiTS&sort-type={{ $sortType }}" class="text-decoration-none">Khối TS</a></th> 
                <th class="align-middle text-center"><a href="?sort-by=Toán&sort-type={{ $sortType }}" class="text-decoration-none">Toán</a></th> 
                <th class="align-middle text-center"><a href="?sort-by=Văn&sort-type={{ $sortType }}" class="text-decoration-none">Văn</a></th> 
                <th class="align-middle text-center"><a href="?sort-by=Anh&sort-type={{ $sortType }}" class="text-decoration-none">Anh</a></th> 
                <th class="align-middle text-center"><a href="?sort-by=Lý&sort-type={{ $sortType }}" class="text-decoration-none">Lý</a></th> 
                <th class="align-middle text-center"><a href="?sort-by=Hóa&sort-type={{ $sortType }}" class="text-decoration-none">Hóa</a></th> 
                <th class="align-middle text-center"><a href="?sort-by=Sinh&sort-type={{ $sortType }}" class="text-decoration-none">Sinh</a></th> 
                <th class="align-middle text-center"><a href="?sort-by=TongDiem&sort-type={{ $sortType }}" class="text-decoration-none">Tổng điểm</a></th> 
                <th class="align-middle text-center">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @if($DSXetTuyen->count() > 0)
                @foreach($DSXetTuyen as $xt)
                    <tr>
                        <td class="align-middle text-center">{{ $xt->MaHoSo }}</td>
                        <td class="align-middle text-center">{{ $xt->PhuongThucXT }}</td>
                        <td class="align-middle text-center">{{ $xt->NV1 }}</td>
                        <td class="align-middle text-center">{{ $xt->NV2 }}</td>
                        <td class="align-middle text-center">{{ $xt->KhoiTS }}</td>
                        <td class="align-middle text-center">{{ $xt->Toán }}</td>
                        <td class="align-middle text-center">{{ $xt->Văn }}</td>
                        <td class="align-middle text-center">{{ $xt->Anh }}</td>
                        <td class="align-middle text-center">{{ $xt->Lý }}</td>
                        <td class="align-middle text-center">{{ $xt->Hóa }}</td>
                        <td class="align-middle text-center">{{ $xt->Sinh }}</td>
                        <td class="align-middle text-center">{{ $xt->TongDiem }}</td>
                        <td class="align-middle text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                {{-- <a href="{{ route('student.sendEmailAccepted', $st->id) }}" class="btn btn-success">Tiếp nhận</a> --}}
                                {{-- <form action="{{ route('student.sendAmsAcceptedEmail', $xt->MaHoSo) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Trúng tuyển</button>   
                                </form> --}}

                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-id="{{ $xt->MaHoSo }}" data-bs-gpa="{{ $xt->TongDiem }}" 
                                        data-bs-nv1="{{ $xt->NV1 }}" data-bs-nv2="{{ $xt->NV2 }}" data-bs-target="#modalSendEmailAccepted">
                                    Trúng tuyển
                                </button>

                                <div class="modal fade" id="modalSendEmailAccepted" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Lý do thí sinh trúng tuyển</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('student.sendAmsAcceptedEmail') }}" method="POST">
                                                @csrf
                                                <div class="row mb-3">
                                                    <div class="col-lg-6">
                                                        <label for="studentId" class="col-form-label">ID sinh viên:</label>
                                                        <input name="student_id" class="form-control" id="studentId" readonly>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="studentGpa" class="col-form-label">Tổng điểm:</label>
                                                        <input name="student_gpa" class="form-control" id="studentGpa" readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="col-form-label">Trúng tuyển NV:</label> <br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="nvTrungTuyen" class="options" id="nv1">
                                                        <label class="form-check-label" for="">NV1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="nvTrungTuyen" class="options" id="nv2">
                                                      <label class="form-check-label" for="">NV2</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="modal-footer"> 
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary">Gửi email</button>
                                                    {{-- <button type="submit" class="btn btn-primary" onclick="">Gửi email123</button> --}}
                                                </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>


                                {{-- ds-bs-target: Nhảy đến một thẻ chỉ định khi click vào button hoặc 1 sự kiện nào đấy --}}
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-id="{{ $xt->MaHoSo }}" data-bs-target="#modalSendEmailDenied">
                                    Ko trúng tuyển
                                </button>
                                
                                {{-- Vào trong này sẽ mất vòng lặp, nên phải thông qua data-bs-id để truyền id tương ứng vào trong --}}
                                <div class="modal fade" id="modalSendEmailDenied" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Lý do thí sinh ko trúng tuyển</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('student.sendAmsDeniedEmail') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="studentId" class="col-form-label">ID sinh viên:</label>
                                                <input name="student_id" class="form-control" id="studentId" readonly>
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
                            </div>
                        </td>
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
    <script>
        const modal = document.getElementById('modalSendEmailDenied');
            if (modal) {
                /* show.bs.modal: Được kích hoạt để hiển thị 1 cửa sổ nhỏ trên màn hình khi click vào button */
                modal.addEventListener('show.bs.modal', event => {
                    /* event.relatedTarget: Trong TH này sẽ trả về ptu button 'Ko trúng tuyển' mà đã click trước đó */
                    const button = event.relatedTarget;
    
                    /* Lấy giá trị(id của thí sinh) trong thuộc tính data-bs-id: */
                    const studentId = button.getAttribute('data-bs-id');
    
                    /* Lấy ra thẻ chứa id #studentId */
                    const idInput = modal.querySelector('.modal-body #studentId');
                    
                    /* Gán giá trị của trường input #studentId = id của thí sinh */
                    idInput.value = studentId;
                });
            }

        const modal2 = document.getElementById('modalSendEmailAccepted');
        if(modal2){
            modal2.addEventListener('show.bs.modal', event => {
                const buttonAccept = event.relatedTarget;
                const studentId2 = buttonAccept.getAttribute('data-bs-id');
                const studentGpa = buttonAccept.getAttribute('data-bs-gpa');
                const idInput2 = modal2.querySelector('.modal-body #studentId');
                const gpaInput = modal2.querySelector('.modal-body #studentGpa');
                idInput2.value = studentId2;
                gpaInput.value = studentGpa;

                const nv1 = buttonAccept.getAttribute('data-bs-nv1');
                const nv2 = buttonAccept.getAttribute('data-bs-nv2');
                const nv1Input = modal2.querySelector('.modal-body #nv1');
                const nv2Input = modal2.querySelector('.modal-body #nv2');
                nv1Input.value = nv1;
                nv2Input.value = nv2;

                /* Lấy ra DS những input radio có tên nvTrungTuyen */
                var radios = document.getElementsByName('nvTrungTuyen'); 
                /* Lặp qua từng input radio */
                radios.forEach(function(radio) {
                    if (radio.checked){
                        var selectedValue = radio.value;
                        return selectedValue;
                    }
                });

                // for (var i = 0; i < radios.length(); i++) {
                //     if (radios[i].checked){
                //         radios[i] = radios[i].value 
                //     }
                // }

            })
        }
    </script>
    {{ $DSXetTuyen->links() }}
@endsection