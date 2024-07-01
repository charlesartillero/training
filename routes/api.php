<?php

use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Ticket;

$version = 'v1/';

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);



Route::middleware('auth:sanctum')
    ->apiResource($version.'tickets', TicketController::class);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
