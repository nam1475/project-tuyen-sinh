@extends('layouts.app')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Thêm thí sinh</h1>
        <a href="{{ route('student.DSChoTiepNhan') }}" class="btn btn-primary">Danh sách thí sinh</a>
    </div>
    <hr/>
    <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4 class="mt-4">Thông tin cá nhân</h4>
        <div class="row mb-3 justify-content-around">
            <div class="col-lg-4">
                <strong>Họ tên</strong>
                <input type="text" name="HoTen" class="form-control" placeholder="Họ tên">
            </div>
            <div class="col-lg-4">
                <strong>Ngày sinh</strong>
                <input type="date" name="NgaySinh" class="form-control">
            </div>
            <div class="col-lg-4">
                <strong>Giới tính</strong>
                <select name="GioiTinh" class="form-select">
                    <option selected></option>
                    <option value="Nam" >Nam</option>
                    <option value="Nữ" >Nữ</option>
                </select>
            </div>
        </div>
        <div class="row mb-3 justify-content-around">
            <div class="col-lg-4">
                <strong>Trình độ văn hóa</strong>
                <select name="TrinhDoVanHoa" class="form-select">
                    <option selected></option>
                    <option value="THCS">THCS</option>
                    <option value="THPT">THPT</option>
                </select>
            </div>
            <div class="col-lg-4">
                <strong>SĐT</strong>
                <input type="text" name="SDT" class="form-control" placeholder="SĐT">
            </div>
            <div class="col-lg-4">
                <strong>Địa chỉ</strong>
                <input type="text" name="DiaChi" class="form-control" placeholder="Địa chỉ">
            </div>
        </div>
        <div class="row mb-3 ">
            <div class="col-lg-4">
                <strong>Email</strong>
                <input type="email" name="Email" class="form-control" placeholder="Email">
            </div>
            <div class="col-lg-4">
                <strong>CCCD</strong>
                <input type="text" name="CCCD" class="form-control" placeholder="CCCD">
            </div>
        </div>

        <h4 class="mt-5">Ảnh minh chứng</h4>
        <div class="row mb-3 justify-content-around">
            <div class="col-lg-4">
                <strong>Ảnh học bạ điểm</strong>
                <input type="file" name="HB_diem" class="form-control">
            </div>
            <div class="col-lg-4">
                <strong>Ảnh bằng TN</strong>
                <input type="file" name="bang_TN" class="form-control">
            </div>
            <div class="col-lg-4">
                <strong>Ảnh chứng nhận ưu tiên(Nếu có)</strong>
                <input type="file" name="CN_uu_tien" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-4">
                <strong>Ảnh học bạ bìa</strong>
                <input type="file" name="HB_bia" class="form-control">
            </div>
        </div>
        
        <h4 class="mt-5">Đăng ký nguyện vọng</h4>
        <div class="row mb-3 justify-content-around">
            <div class="col-lg-4">
                <strong>Phương thức XT</strong>
                <select name="PhuongThucXT" class="form-select">
                    <option value="" selected></option>
                    <option value="THPTQG">Xét điểm thi THPTQG</option>
                    <option value="HocBa">Xét điểm học tập THPT(Học bạ)</option>
                </select>
            </div>
            <div class="col-lg-4">
                <strong>Nguyện vọng 1</strong>
                <select name="NV1" class="form-select">
                    <option value="" selected></option>
                    @foreach ($nganhHoc as $nh)
                        <option value="{{ $nh->MaNganh }}">{{ $nh->TenNganh }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4">
                <strong>Nguyện vọng 2</strong>
                <select name="NV2" class="form-select">
                    <option value="" selected></option>
                    @foreach ($nganhHoc as $nh)
                        <option value="{{ $nh->MaNganh }}">{{ $nh->TenNganh }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-4">
                <strong>Khối tuyển sinh</strong>
                <select name="KhoiTS" class="form-select" id="handle-select">
                    <option value="" selected></option>
                    @foreach ($khoiTS as $kts)
                        <option value="{{ $kts->TenKhoi }}">{{ $kts->TenKhoi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4 d-none" id="hidden-table">
                <table class="table table-hover table-responsive">
                    <thead class="table-primary">
                        <tr>
                            <th class="align-middle text-center">Môn</th>
                            <th class="align-middle text-center">Điểm thi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="align-middle table-secondary"></td>
                            <td class="align-middle"></td>
                        </tr>
                        <tr>
                            <td class="align-middle table-secondary"></td>
                            <td class="align-middle"></td>
                        </tr>
                        <tr>
                            <td class="align-middle table-secondary"></td>
                            <td class="align-middle"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
 
        <div class="text-center">
            <button type="submit" class="btn btn-success">Lưu</button>
        </div>
    </form>

    <script>
        // var optionElement = document.querySelector(".handle");
        var selectElement = document.getElementById("handle-select");
        var tableElement = document.getElementById("hidden-table");
        selectElement.addEventListener('change', function(e) {
            /* e.target.value: Trả về giá trị của trường select */
            if (e.target.value != "") {    
                // var selectedOption = selectElement.value;
                var tableData = tableElement.getElementsByTagName("tbody")[0].getElementsByTagName("td");
                // var table = tableElement.getElementsByTagName("tbody")[0];

                // Change data based on selected option
                var option = e.target.value;
                var words = option.split('-');
                var j = 0;
                var k = 0;
                for (var i = 0; i < tableData.length; ++i) {
                    /* 0 2 4 = 0 1 2 */
                    if (i % 2 == 0) {
                        // if(i == 0){
                        //     tableData[i].innerHTML = words[i];
                        // }
                        // else{
                        //     for(var j = 0; j < words.length; ++j) {
                        //         if(i == 2 && j == 1){
                        //             tableData[i].innerHTML = words[j];
                        //         }
                        //         else if(i == 4 && j == 2){
                        //             tableData[i].innerHTML = words[j];
                        //         }
                        //     }
                        // }
                        tableData[i].innerHTML = words[j++];
                        console.log(tableData[i]);
                    } 
                    else {
                        /* 1 3 5 = 0 1 2 */
                        tableData[i].innerHTML = `<input type="text" name="${words[k++]}" class="form-control">`;
                        console.log(tableData[i]);
                    }
                }
                 
                // for (var i = 0; i < tableData.length; i++) {
                //     // var row = tableData.insertRow();
                //     var cell1 = tableData.insertCell(i);
                //     var cell2 = tableData.insertCell(i+1);
                //     cell1.innerHTML = 123;
                //     cell2.innerHTML = "Data for ";  
                // }
                tableElement.classList.remove("d-none");
            } else {
                tableElement.classList.add("d-none");
            }
            
        });
    </script>
@endsection