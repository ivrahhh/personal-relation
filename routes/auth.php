<?php

use App\Http\Controllers\Authentication\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class,'create'])->name('login');
    Route::post('login', [LoginController::class,'store'])->name('authenticate');
});