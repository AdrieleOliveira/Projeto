<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('produto/cliente/{user}', 'App\Http\Controllers\ProductController@index');
Route::post('produto', 'App\Http\Controllers\ProductController@store');
Route::put('produto/{produto}', 'App\Http\Controllers\ProductController@update');
Route::get('produto/{produto}', 'App\Http\Controllers\ProductController@show');
Route::delete('produto/{produto}', 'App\Http\Controllers\ProductController@destroy');
