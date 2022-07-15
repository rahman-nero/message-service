<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignUpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', [LoginController::class, 'login']);
Route::post('signup', [SignUpController::class, 'signup']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});
