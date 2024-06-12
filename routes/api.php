<?php

use App\Http\Controllers\Api\AuthApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//public API
Route::group(['prefix' => 'v1'], function () {
    Route::post('auth/login', [AuthApiController::class, 'login']);
});

//protected API
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::post('auth/logout', [AuthApiController::class, 'logout']);
    });
});