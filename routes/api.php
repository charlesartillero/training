<?php

use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Ticket;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    $version = 'v1';

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix($version)->group(function () {
        Route::apiResource('tickets', TicketController::class);
        Route::apiResource('users', UserController::class);
    });


});




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
