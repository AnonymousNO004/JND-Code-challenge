<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login']);
Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'check_login']);

Route::get('/register', [\App\Http\Controllers\Admin\AuthController::class, 'register']);
Route::post('/register', [\App\Http\Controllers\Admin\AuthController::class, 'store']);

Route::get('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout']);
Route::group(['middleware' => 'auth_admin'], function(){
    Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index']);
    Route::post('/lists', [\App\Http\Controllers\Admin\HomeController::class, 'lists']);
    Route::get('/show/{id}', [\App\Http\Controllers\Admin\HomeController::class, 'show']);
    Route::get('/delete/{id}', [\App\Http\Controllers\Admin\HomeController::class, 'destroy']);
    Route::patch('/update', [\App\Http\Controllers\Admin\HomeController::class, 'update']);
});
