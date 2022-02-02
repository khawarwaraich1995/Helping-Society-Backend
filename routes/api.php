<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header("Access-Control-Max-Age", "3600");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Access-Control-Allow-Credentials", "true");

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\AuthController as ClientAuthController;
use App\Http\Controllers\Api\Client\ComplaintController;

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

//API auth routes Client

Route::group(['prefix' => 'v1/client', 'middleware' => ['ApiHeaderVerify']], function () {
    Route::post('/register', [ClientAuthController::class, 'register']);
    Route::post('/login', [ClientAuthController::class, 'login']);

    //Protecting Routes
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('/profile-update', [ClientAuthController::class, 'profileUpdate']);
        Route::post('/register-complaint', [ComplaintController::class, 'store_complaint']);
        Route::post('/save-food', [ComplaintController::class, 'save_food']);
        Route::post('/save-donation', [ComplaintController::class, 'save_donation']);
        Route::post('/store-device-token', [ClientAuthController::class, 'store_token']);
        Route::post('/logout', [ClientAuthController::class, 'logout']);

    });
});
