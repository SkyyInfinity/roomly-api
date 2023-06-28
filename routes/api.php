<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\api\RoomController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\FavoriteController;
use App\Http\Controllers\api\ReservationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);

Route::post('users', [UserController::class, 'store']);


Route::group(['middleware' => ['jwt.auth']], function() {
    // Auth routes
    Route::post('logout', [AuthController::class, 'logout']);
    
    // Ressources routes
    Route::apiResource('users', UserController::class, ['except' => ['store']]);
    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('reservations', ReservationController::class);
    Route::get('user-reservations/{id}', [ReservationController::class, 'getByUser']);
    Route::get('favorites/{id}', [FavoriteController::class, 'index']);
    Route::apiResource('favorites', FavoriteController::class, ['except' => ['index']]);
});
