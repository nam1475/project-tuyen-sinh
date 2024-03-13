<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ThiSinhController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\FormDkyController;
use App\Http\Controllers\HoSoTSController;

/* Quản lý tuyển sinh */
    // Route::controller(FormDkyController::class)->prefix('home')->group(function () {
    //     Route::get('/dang-ky-xet-tuyen', 'create')->name('DangKy.create');
    //     Route::post('/luu-thi-sinh', 'store')->name('DangKy.store');
    // });

    Route::controller(HoSoTSController::class)->prefix('ho-so-ts')->group(function () {
        Route::get('/search-student-profile', 'searchStudentProfile')->name('searchStudentProfile');
        Route::get('/login-student-profile', 'loginStudentProfile')->name('loginStudentProfile');
        Route::post('/student-profile', 'studentProfile')->name('studentProfile');
        Route::get('/edit-student-profile/{MaHoSo}', 'editStudentProfile')->name('editStudentProfile');
        Route::put('/update-student-profile/{MaHoSo}', 'updateStudentProfile')->name('updateStudentProfile');
    });

    Route::controller(AuthAdminController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'registerSave')->name('register.save');
        
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginAction')->name('login.action');
        
        Route::get('/logout', 'logout')->middleware('auth')->name('logout');

        Route::get('/forgot-password', 'forgotPassword')->name('forgotPassword');
        Route::get('/change-password', 'changePassword')->name('changePassword');

    });
    
    /* - Được bảo vệ bởi middleware 'auth'. 
    - Middleware 'auth' được sử dụng để đảm bảo rằng chỉ người dùng đã xác thực 
    mới có thể truy cập vào các route trong nhóm này. */
    Route::middleware('auth')->group(function () {
        /* prefix(): Tất cả các route trong group mặc định sẽ có tiền tố là student/ */
        Route::controller(ThiSinhController::class)->prefix('thi-sinh')->group(function () {
            Route::get('/trung-tuyen', 'DSTrungTuyen')->name('student.DSTrungTuyen');
            Route::get('/cho-tiep-nhan', 'DSChoTiepNhan')->name('student.DSChoTiepNhan');
            Route::get('/ds-xet-tuyen', 'DSXetTuyen')->name('student.DSXetTuyen');
            // Route::get('/trung-tuyen', 'DSTrungTuyen')->name('student.DSTrungTuyen');
            Route::get('/xac-nhan-ho-so', 'XacNhanHS')->name('student.XacNhanHS');
            Route::get('/xac-nhan-xet-tuyen', 'XacNhanXT')->name('student.XacNhanXT');
            Route::get('create', 'create')->name('student.create');
            Route::post('store', 'store')->name('student.store');
            // Route::get('trung-tuyen/show/{MaHoSo}', 'show')->name('student.show');
            Route::get('cho-tiep-nhan/show/{MaHoSo}', 'show')->name('DSChoTiepNhan.show');
            Route::get('cho-tiep-nhan/edit/{MaHoSo}', 'edit')->name('DSChoTiepNhan.edit');
            Route::put('cho-tiep-nhan/update/{MaHoSo}', 'update')->name('DSChoTiepNhan.update');
            Route::delete('cho-tiep-nhan/destroy/{MaHoSo}', 'destroy')->name('DSChoTiepNhan.destroy');
            Route::post('/send-email-accepted/{MaHoSo}', 'sendEmailAccepted')->name('student.sendEmailAccepted');
            Route::post('/send-email-denied', 'sendEmailDenied')->name('student.sendEmailDenied');
            Route::post('/send-ams-email-accepted', 'sendAmsAcceptedEmail')->name('student.sendAmsAcceptedEmail');
            Route::post('/send-ams-email-denied', 'sendAmsDeniedEmail')->name('student.sendAmsDeniedEmail');
            // Route::get('/send-sms', 'sendSms')->name('student.sendSms');
        });
            
        Route::get('/profile', [AuthAdminController::class, 'profile'])->name('profile');
    });



    
