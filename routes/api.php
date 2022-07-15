<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Messages\ManageController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::post('login', [LoginController::class, 'login']);
Route::post('signup', [SignUpController::class, 'signup']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('/user', [UserController::class, 'data']);

    // Get all messages
    Route::get('/messages', [MainController::class, 'index']);

    // Method for add message
    Route::post('/messages', [ManageController::class, 'store']);

    // Delete message
    Route::delete('/messages/{id}', [ManageController::class, 'delete']);

});
