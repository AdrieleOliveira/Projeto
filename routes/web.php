<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});

Route::resource('produto', \App\Http\Controllers\ProductController::class)->middleware('auth');
Route::get('produto', '\App\Http\Controllers\ProductController@showPage')->name('produto-inicial')->middleware('auth');
