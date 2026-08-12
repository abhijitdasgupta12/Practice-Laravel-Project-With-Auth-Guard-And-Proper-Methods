<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebController;

Route::view('/', 'welcomepage')->name('welcomepage'); //Loads 'welcomepage.blade.php'

Route::name('user.')->group(function(){
    Route::get('/login', [WebController::class, 'login'])->name('login');
    Route::get('/signup', [WebController::class, 'signup'])->name('signup');
    Route::post('/postlogin', [WebController::class, 'postlogin'])->name('post.login');
    Route::post('/postsignup', [WebController::class, 'postsignup'])->name('post.signup');
    Route::get('/send-forgot-email', [WebController::class, 'sendforgotemail'])->name('password.sendemail'); //page that shows a email field and a button to send email
    Route::get('/change-password', [WebController::class, 'changepasswordpage'])->name('password.reset.page'); //Password reset page containing password and confirm password fields. For user.
    Route::post('/forgot', [WebController::class, 'forgotpassword'])->name('password.forgot'); // sends password reset link via email
    Route::post('/reset-user-password', [WebController::class, 'resetuserpassword'])->name('password.reset'); //resets password using laravel's auth

    // MIDDLEWARE FOR LOGGED IN USERS
    Route::middleware('auth:web')->group(function(){
        Route::get('/dashboard', [WebController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [WebController::class, 'logout'])->name('logout');
    });
});

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/controlpanel', [AuthController::class, 'index'])->name('login.page');
    Route::post('/login', [AuthController::class, 'adminLogin'])->name('login');
    Route::get('/change-password', [AuthController::class, 'changepasswordpage'])->name('password.reset.page'); //Password reset page containing password and confirm password fields. For admin.
    Route::get('/send-forgot-email', [AuthController::class, 'sendforgotemail'])->name('password.sendemail'); //page that shows a button to send email
    Route::post('/forgot', [AuthController::class, 'forgotpassword'])->name('password.forgot'); // sends password reset link via email
    Route::post('/reset-admin-password', [AuthController::class, 'resetadminpassword'])->name('password.reset'); //resets password using laravel's auth

    // Middleware protected routes for admin
    Route::middleware('auth:admin')->group(function (){
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

