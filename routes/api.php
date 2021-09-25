<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Profile\Presentation\Controller\ProfileController;

Route::get('/test', function (Request $request) {
    return "Hello, world!";
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });
});

Route::group(['prefix' => 'profile'], function () {
    Route::group(['prefix' => '{user}'], function() {
        Route::get('', [ProfileController::class, 'get']);
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
