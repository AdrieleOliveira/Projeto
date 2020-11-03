<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::resource('produto', ProductController::class);
Route::middleware('auth:api')->get('produto/{user}', 'App\Http\Controllers\ProductController@index');
Route::middleware('auth:api')->post('produto', 'App\Http\Controllers\ProductController@store');
Route::middleware('auth:api')->put('produto/{produto}', 'App\Http\Controllers\ProductController@update');
Route::middleware('auth:api')->get('produto/{produto}', 'App\Http\Controllers\ProductController@show');
Route::middleware('auth:api')->delete('produto/{produto}', 'App\Http\Controllers\ProductController@destroy');
