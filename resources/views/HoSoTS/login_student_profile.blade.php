<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Đăng nhập TK thí sinh</title>
  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <!-- Custom styles for this template-->
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-5 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              {{-- <div class="col-lg-4 d-none d-lg-block"></div> --}}
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Đăng nhập TK thí sinh</h1>
                  </div>
                  <form action="{{ route('studentProfile') }}" method="POST" class="user">
                    @csrf
                    {{-- Kiểm tra xem có bất kì lỗi nào xảy ra ko --}}
                    @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                      </div>
                    @endif
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-append">
                          <div class="input-group-text" style="border-radius: 18px 0px 0px 18px;">
                            <span class="fas fa-user"></span>
                          </div>
                        </div>
                        <input name="CCCD" type="text" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Nhập CCCD">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-append">
                          <div class="input-group-text" style="border-radius: 18px 0px 0px 18px;">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                        <input name="password" type="password" class="form-control form-control-user" placeholder="Nhập mật khẩu (Ngày sinh)">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input name="remember" type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-user">Đăng nhập</button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="{{ route('searchStudentProfile') }}">Tra cứu mã hồ sơ!</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="{{ route('login') }}">Đăng nhập tài khoản cán bộ!</a>
                  </div>
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