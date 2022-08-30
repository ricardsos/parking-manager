<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\StayController;
use App\Http\Controllers\Api\V1\VehicleController;


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
Route::post('/tokens/create', [AuthController::class, 'createToken']);



Route::prefix('v1')->middleware('auth:sanctum')->group(function() {
    Route::group(['prefix' => 'stay'], function () {
        Route::post('check-in', [StayController::class, 'checkIn']);
        Route::post('check-out', [StayController::class, 'checkOut']);
        Route::get('month-starts', [StayController::class, 'monthStarts']);
        Route::post('generate-resident-payment-report', [StayController::class, 'generateResidentPaymentReport']);
    });

    Route::group(['prefix' => 'vehicle'], function () {
        Route::post('/', [VehicleController::class, 'store']);
    });
});
