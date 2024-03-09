<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Cán bộ tuyển sinh</div>
    </a>
    
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <!-- Nav Item -->
    <li class="nav-item"> 
      <a class="nav-link" href="{{ route('student.DSChoTiepNhan') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span class="fs-6">Danh sách thí sinh chờ tiếp nhận</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link active" href="{{ route('student.DSXetTuyen') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span class="fs-6">DS xét tuyển thí sinh</span>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="{{ route('student.XacNhanHS') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span class="fs-6">Trạng thái xác nhận hồ sơ thí sinh</span>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="{{ route('student.XacNhanXT') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span class="fs-6">Trạng thái xác nhận xét tuyển thí sinh</span>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="{{ route('student.DSTrungTuyen') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span class="fs-6">Danh sách thí sinh trúng tuyển</span>
      </a>
    </li>

    {{-- <li class="nav-item">
      <a class="nav-link" href="{{ route('student.DSTrungTuyen') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span class="fs-6">Danh sách thí sinh trúng tuyển</span>
      </a>
    </li> --}}
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    
    
</ul>

{{-- <script>
  $(".sidebar ul li").on('click', function(){
    $(".sidebar ul li.active").removeClass('active');
    $(this).addClass('active');
  })
</script> --}}