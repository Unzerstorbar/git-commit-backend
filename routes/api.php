<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use City\Presentation\Controller\CityController;
use Events\Infrastructure\Repository\EventRegistrySqlRepository;
use Events\Presentation\Controller\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Photo\Presentation\Controller\PhotoController;
use Venue\Presentation\Controller\VenueController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

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

Route::group(['prefix' => 'events'], function () {
    Route::get('registry', [EventController::class, 'getRegistry']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
