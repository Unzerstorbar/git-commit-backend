<?php

use Address\Presentation\Controller\CityController;
use Address\Presentation\Controller\DistrictController;
use Address\Presentation\Controller\RegionController;
use Address\Presentation\Controller\VenueController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use Event\Presentation\Controller\EventController;
use Event\Presentation\Controller\StatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orphanage\Presentation\Controller\OrphanageController;
use Orphanage\Presentation\Controller\PupilController;
use Profile\Presentation\Controller\ProfileController;
use Tag\Presentation\Controller\TagController;

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
    Route::get('list', [EventController::class, 'registry']);
    Route::get('status', [StatusController::class, 'registry']);
    Route::group(['prefix' => '{event}'], function() {
        Route::get('', [EventController::class, 'get']);
        Route::put('', [EventController::class, 'update']);
        Route::get('statusChange', [EventController::class, 'statusChange']);
    });
});

Route::group(['prefix' => 'address'], function () {
    Route::get('city', [CityController::class, 'registry']);
    Route::get('district', [DistrictController::class, 'registry']);
    Route::get('region', [RegionController::class, 'registry']);
    Route::get('venue', [VenueController::class, 'registry']);
});

Route::group(['prefix' => 'tag'], function () {
    Route::get('list', [TagController::class, 'registry']);
});

Route::group(['prefix' => 'profile'], function () {
    Route::get('registry', [ProfileController::class, 'registry']);
    Route::group(['prefix' => '{user}'], function() {
        Route::get('', [ProfileController::class, 'get']);
        Route::put('', [ProfileController::class, 'update']);
        Route::delete('', [ProfileController::class, 'destroy']);

        Route::delete('password/change', [ProfileController::class, 'destroy']);

        Route::get('/events', [ProfileController::class, 'events']);
        Route::get('/documents', [ProfileController::class, 'documents']);
    });
});

Route::group(['prefix' => 'orphanage'], function () {
    Route::get('registry', [OrphanageController::class, 'registry']);

    Route::post('', [OrphanageController::class, 'create']);
    Route::group(['prefix' => '{orphanage}'], function() {
        Route::get('', [OrphanageController::class, 'get']);
        Route::put('', [OrphanageController::class, 'update']);
        Route::delete('', [OrphanageController::class, 'destroy']);

        Route::group(['prefix' => 'pupil'], function() {
            Route::post('', [PupilController::class, 'create']);
        });
    });
});

Route::group(['prefix' => 'pupil'], function() {
    Route::group(['prefix' => '{pupil}'], function() {
        Route::delete('', [PupilController::class, 'destroy']);

        Route::group(['prefix' => 'password'], function() {
            Route::post('change', [PupilController::class, 'changePassword']);
        });
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
