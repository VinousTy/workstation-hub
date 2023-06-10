<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LogoutController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::post('/login', LoginController::class)->name('login');
  });

Route::middleware('auth:admin')->group(function () {
  Route::post('/logout', LogoutController::class)->name('logout');
});
