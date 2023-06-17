<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Notification\FetchNotificationListController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::post('/login', LoginController::class)->name('login');
  });

Route::middleware('auth:admin')->group(function () {
  // お知らせ
  Route::prefix('/notification')->name('notification.')->group(function () {
      Route::get('/', FetchNotificationListController::class)->name('index');
  });

  // 認証
  Route::post('/logout', LogoutController::class)->name('logout');
});
