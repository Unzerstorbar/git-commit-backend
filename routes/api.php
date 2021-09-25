<?php

use Address\Presentation\Controller\CityController;
use Address\Presentation\Controller\DistrictController;
use Address\Presentation\Controller\RegionController;
use Address\Presentation\Controller\VenueController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use Event\Presentation\Controller\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orphanage\Presentation\Controller\OrphanageController;
use Orphanage\Presentation\Controller\PupilController;
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

Route::group(['prefix' => 'event'], function () {
    Route::get('registry', [EventController::class, 'registry']);
    Route::group(['prefix' => '{event}'], function() {
        Route::get('', [EventController::class, 'get']);
    });
});

Route::group(['prefix' => 'address'], function () {
    Route::get('city', [CityController::class, 'registry']);
    Route::get('district', [DistrictController::class, 'registry']);
    Route::get('region', [RegionController::class, 'registry']);
    Route::get('venue', [VenueController::class, 'registry']);
});

Route::group(['prefix' => 'profile'], function () {
    Route::get('registry', [ProfileController::class, 'registry']);
    Route::group(['prefix' => '{user}'], function() {
        Route::get('', [ProfileController::class, 'get']);
    });
});

Route::group(['prefix' => 'orphanage'], function () {
    Route::get('registry', [OrphanageController::class, 'registry']);
    Route::group(['prefix' => '{orphanage}'], function() {
        Route::get('', [OrphanageController::class, 'get']);

        Route::group(['prefix' => 'pupil'], function() {
            Route::post('', [PupilController::class, 'create']);
        });
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
