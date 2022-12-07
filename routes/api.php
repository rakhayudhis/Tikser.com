<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaymentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user',[AuthController::class, 'alluser']);
Route::get('/user/{id}',[AuthController::class, 'showuser']);
Route::get('/tiket',[TiketController::class, 'index']);
Route::get('/event',[EventController::class, 'index']);
Route::get('/payment',[PaymentController::class, 'index']);
Route::get('/tiketbynama',[TiketController::class, 'show']);
Route::get('/eventbynama',[EventController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('tiket', TiketController::class)->except(['create', 'edit', 'show', 'index']);
    Route::resource('event', EventController::class)->except(['create', 'edit', 'show', 'index']);
    Route::resource('payment', PaymentController::class)->except(['create', 'edit', 'show', 'index']);
});


       
