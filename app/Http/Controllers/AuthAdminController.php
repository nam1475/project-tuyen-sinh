<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\LoginRequest;
use App\Models\NganhHoc; 
use App\Models\DSChoTiepNhan; 
use Illuminate\Support\Facades\Session;

class AuthAdminController extends Controller
{   

    public function register()
    {
        return view('auth_admin.register');
    }
  
    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();
  
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'Admin'  
        ]);

        return redirect()->route('login');
    }
  
    public function login()
    {
        return view('auth_admin.login');
    }
  
    public function loginAction(Request $request, LoginRequest $loginRequest)
    {
        /* Đây là một Validator Laravel, được sử dụng để kiểm tra dữ liệu 
        đầu vào từ request HTTP. Trong trường hợp này, chúng ta đang yêu 
        cầu email và mật khẩu là bắt buộc và email phải có định dạng hợp lệ. */        
        $loginRequest->validated();

        // $data = $request->all();
        // echo "<pre>"; print_r($data); die; 
            
        /* Auth::attempt()
        - Là một phương thức của Laravel Authentication
        - Kiểm tra email và mkhau người dùng nhập có đúng ko 
        - Nếu đúng -> trả về true
        - Nếu sai -> trả về false
        */
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            /* Nếu thông tin xác thực không hợp lệ, một ngoại lệ ValidationException 
            sẽ được ném với thông điệp lỗi tương ứng. Trong trường hợp này, thông điệp 
            lỗi được hiển thị là 'Email hoặc mật khẩu không đúng'. */
            throw ValidationException::withMessages([
                '' => trans('Kiểm tra lại email hoặc mật khẩu')
                // 'password' => trans('Mật khẩu ko chính xác')
            ]);
        }
        
        /* Làm mới session ID sau khi người dùng đăng nhập thành công, giúp ngăn chặn 
        các cuộc tấn công session fixation. */
        $request->session()->regenerate();  
  
        return redirect()->route('student.DSChoTiepNhan');
    }
  
    public function logout(Request $request)
    {
        /* Auth::guard('web')->logout(): 
        - Là cách để đăng xuất người dùng khỏi ứng dụng. 
        - Phương thức logout() được gọi trên guard web, đảm bảo rằng người dùng được đăng 
        xuất khỏi phiên đăng nhập trên route web.php */
        Auth::guard('web')->logout();

        /* - Sau khi đăng xuất, dòng này được sử dụng để vô hiệu hóa phiên của người dùng. 
        - Điều này làm cho tất cả các dữ liệu trong phiên hiện tại của người dùng trở thành 
        không hợp lệ. */
        $request->session()->invalidate();
        
        return redirect()->route('login');
    }

    public function forgotPassword(){
        return view('auth_admin.forgotPassword');
    }
 
    public function profile()
    {
        return view('admin_profile.profile');
    }
}
