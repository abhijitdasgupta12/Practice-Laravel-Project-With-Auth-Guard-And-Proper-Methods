<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', [AuthController::class, 'index'])->name('adminloginpage');

Route::get('/login', function () { return view('userlogin'); })->name('login');

Route::prefix('admin')->name('admin.')->group(function(){
    Route::post('/login', [AuthController::class, 'adminLogin'])->name('login');

    // Middleware protected routes for admin
    Route::middleware('auth:admin')->group(function (){
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

