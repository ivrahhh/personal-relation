<?php

use App\Http\Controllers\Authentication\ForgotPasswordController;
use App\Http\Controllers\Authentication\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class,'create'])->name('login');
    Route::post('login', [LoginController::class,'store'])->name('authenticate');
    Route::get('forgot-password', [ForgotPasswordController::class,'create'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class,'store'])->name('password.email');

    Route::get('reset-password/{token}')->name('password.reset');
});