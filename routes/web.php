<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PuserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OtpController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PuserController::class, 'index'])->name('pusers.index');
Route::get('/pusers/create', [PuserController::class, 'create'])->name('pusers.create');
Route::post('/pusers/store', [PuserController::class, 'store'])->name('pusers.store');

// Route::get('/otp/send', [OtpController::class, 'sendOtpForm'])->name('otp.send');
Route::post('/otp/send', [OtpController::class, 'sendOtp'])->name('otp.send');
// Route::get('/otp/verify', [OtpController::class, 'verifyOtpForm'])->name('otp.verify');
Route::post('/otp/verify', [OtpController::class, 'verifyOtp'])->name('otp.verify');