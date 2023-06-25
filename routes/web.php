<?php

use Illuminate\Support\Facades\Route;

/**
 * /api以外のパスでアクセスした場合にはwelcome.phpを返す
 * フロント側でルーティングを行いたいための設定
 * CASE:admin/notificationの場合はwelcome.phpが返ってくる
 * /apiから始まる場合、Laravelのルーティングファイルにアクセスを行う
 */
Route::get('/{any}', function () {
  return view('welcome');
})->where('any', '^(?!api).*$');
