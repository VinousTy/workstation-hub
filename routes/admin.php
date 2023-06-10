<?php

use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->name('admin.')->group(function () {
    Route::post('/login', LoginController::class)->name('login');
});
