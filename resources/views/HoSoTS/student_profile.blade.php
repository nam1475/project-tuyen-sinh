<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Tra cứu mã hồ sơ</title>
  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
  <!-- Custom styles for this template-->
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
          <div class="col-lg-12 col-xl-12">
            <div class="card border-0 shadow-lg mt-5" style="height: 600px">
              <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                  {{-- <div class="col-lg-4 d-none d-lg-block"></div> --}}
                  <div class="col-lg-12">
                    <div class="p-5">
                      <div class="text-center">
                        <h4 class="text-black fw-bold fs-3 mb-4">Hồ sơ thí sinh</h4>
                      </div>
                        {{-- action để rỗng thì submit sẽ ở trang chính nó --}}
                        {{-- <form action="" class="mb-4">
                            <div class="row">
                                <div class="col-lg-4">
                                    <input type="text" name="search_profile" class="form-control bg-light rounded-pill" placeholder="Nhập mã hồ sơ">
                                </div>
                                
                                <div class="col-lg-4">
                                    <button class="btn btn-primary pl-100" type="submit" id="searchStudent">
                                        <i class="fas fa-search fa-sm"></i> Tra cứu
                                    </button>
                                </div>

                                <div class="col-lg-4">
                                  <a href="{{ route('loginStudentProfile') }}" class="btn btn-primary float-right">Đăng nhập</a>
                                </div>
                            </div>
                        </form> --}}
                            <table class="table table-hover table-responsive"  id="hiddenTable">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="align-middle text-center">STT</th>
                                        <th class="align-middle text-center">Mã hồ sơ</th>
                                        <th class="align-middle text-center">Họ tên</th> 
                                        <th class="align-middle text-center">CCCD</th> 
                                        <th class="align-middle text-center">Email</th>
                                        <th class="align-middle text-center">Ngày sinh</th>
                                        <th class="align-middle text-center">Giới tính</th>
                                        <th class="align-middle text-center">Trình độ văn hóa</th>
                                        <th class="align-middle text-center">SĐT</th>
                                        <th class="align-middle text-center">Địa chỉ</th>
                                        <th class="align-middle text-center">Thao tác</th>
                                        {{-- <th class="align-middle text-center">HB bìa</th>
                                        <th class="align-middle text-center">HB điểm</th>
                                        <th class="align-middle text-center">Bằng TN</th>
                                        <th class="align-middle text-center">CN ưu tiên</th> --}}
                                        {{-- <th class="align-middle text-center"> Trạng thái</th> --}}
                                    </tr>
                                </thead>
                        
                                <tbody>
                                    <tr>
                                        <td class="align-middle">{{ $student->STT }}</td>
                                        <td class="align-middle">{{ $student->MaHoSo }}</td>
                                        <td class="align-middle">{{ $student->HoTen }}</td>
                                        <td class="align-middle">{{ $student->CCCD }}</td>
                                        <td class="align-middle">{{ $student->Email }}</td>
                                        <td class="align-middle">{{ $student->NgaySinh }}</td>
                                        <td class="align-middle">{{ $student->GioiTinh }}</td>
                                        <td class="align-middle">{{ $student->TrinhDoVanHoa }}</td>  
                                        <td class="align-middle">{{ $student->SDT }}</td>  
                                        <td class="align-middle">{{ $student->DiaChi }}</td>
                                        {{-- <td class="align-middle"><a href="{{ $student->HB_bia }}" target="_blank">{{ $student->HB_bia }}</a></td>  
                                        <td class="align-middle"><a href="{{  $student->HB_diem  }}" target="_blank">{{  $student->HB_diem  }}</a></td>  
                                        <td class="align-middle"><a href="{{  $student->bang_TN  }}" target="_blank">{{  $student->bang_TN  }}</a></td>  
                                        <td class="align-middle"><a href="{{  $student->CN_uu_tien  }}" target="_blank">{{  $student->CN_uu_tien  }}</a></td>   --}}
                                        <td class="align-middle">
                                            <a href="{{ route('editStudentProfile', $student->CCCD) }}" type="button" class="btn btn-secondary">Sửa</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                      <hr>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
      <!-- Bootstrap core JavaScript-->
      <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
      <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- Core plugin JavaScript-->
      <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
      <!-- Custom scripts for all pages-->
      <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>

    </body>
</html>