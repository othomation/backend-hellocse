<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\StarController;
use App\Http\Requests\StoreStarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::post('star', [StarController::class, 'store']);
    Route::delete('star/{id}', [StarController::class, 'delete']);
    Route::put('star/{id}', [StarController::class, 'update']);
});

Route::controller(AuthenticationController::class)->prefix('auth')->group(function () {
    Route::post("login", 'login');
    Route::post("register", 'register');
});

Route::controller(StarController::class)->prefix('star')->group(function () {
    Route::get("", "index");
    Route::get("{id}", "show");
});
