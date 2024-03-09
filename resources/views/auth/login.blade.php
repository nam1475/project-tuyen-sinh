<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Đăng nhập Admin</title>
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
                    <h1 class="h4 text-gray-900 mb-4">Đăng nhập TK cán bộ</h1>
                  </div>
                  <form action="{{ route('login.action') }}" method="POST" class="user">
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
                            <span class="fas fa-envelope"></span>
                          </div>
                        </div>
                        <input name="email" type="email" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Nhập email">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-append">
                          <div class="input-group-text" style="border-radius: 18px 0px 0px 18px;">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                        <input name="password" type="password" class="form-control form-control-user" placeholder="Nhập mật khẩu">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        {{-- name="remember": Có sẵn trong laravel, khi click vào 'Remember' thì sẽ tự tạo remember_token trong 
                        cookies để duy trì phiên đăng nhập sau mỗi lần vào web --}}
                        <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-user">Đăng nhập</button>
                  </form>
                  <hr>
                  
                  <div class="text-center">
                    <a class="small" href="{{ route('register') }}">Tạo tài khoản cán bộ!</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="{{ route('forgotPassword') }}">Quên mật khẩu?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="{{ route('loginStudentProfile') }}">Đăng nhập tài khoản thí sinh!</a>
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