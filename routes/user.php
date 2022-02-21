<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', [\App\Http\Controllers\User\AuthController::class, 'login']);
Route::post('/login', [\App\Http\Controllers\User\AuthController::class, 'check_login']);

Route::get('/register', [\App\Http\Controllers\User\AuthController::class, 'register']);
Route::post('/register', [\App\Http\Controllers\User\AuthController::class, 'store']);

Route::get('/logout', [\App\Http\Controllers\User\AuthController::class, 'logout']);
Route::group(['middleware' => 'auth_user'], function(){
    Route::get('/', [\App\Http\Controllers\User\HomeController::class, 'index']);
});
