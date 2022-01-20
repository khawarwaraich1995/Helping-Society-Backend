<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\AuthController as ClientAuthController;

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

        Route::post('/logout', [ClientAuthController::class, 'logout']);

    });
});