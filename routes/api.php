<?php

use App\Http\Controllers\Auth\ChangeEmailController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ChangeUserNameController;
use App\Http\Controllers\Auth\GetAuthUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UpdateEmailController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Desk\GetDeskListController;
use App\Http\Controllers\Image\GeneratePreSignedUrlController;
use App\Http\Controllers\Image\UploadImageController;
use App\Http\Controllers\Profile\GetAuthUserProfileController;
use App\Http\Controllers\Profile\UpdateAuthUserProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class)->name('login');
Route::post('/register', RegisterController::class)->name('register');
Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->name('verification.verify');
Route::post('forgot-password', PasswordResetLinkController::class)->name('password.email');
Route::post('reset-password', NewPasswordController::class)->name('password.reset');
Route::post('/logout', LogoutController::class)->name('logout');

Route::middleware('auth:sanctum')->name('api.')->group(function () {
    // users
    Route::prefix('/user')->name('user.')->group(function () {
        Route::get('/', GetAuthUserController::class)->name('auth');
        Route::put('/change/name', ChangeUserNameController::class)->name('change.name');
        Route::put('/change/email', ChangeEmailController::class)->name('change.email');
        Route::get('/update/email/{token}', UpdateEmailController::class)->name('email.update');
        Route::put('/change/password', ChangePasswordController::class)->name('change.password');
    });
    // profiles
    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('/', GetAuthUserProfileController::class)->name('index');
        Route::prefix('{profile_id}')->group(function () {
          Route::post('/presigned-url', GeneratePreSignedUrlController::class)->name('upload');
          Route::post('/upload', UploadImageController::class)->name('store');
          Route::put('/update', UpdateAuthUserProfileController::class)->name('update');
        });
    });
    // desks
    Route::prefix('/desk')->name('desk.')->group(function () {
        Route::get('/', GetDeskListController::class)->name('index');
    });
});
