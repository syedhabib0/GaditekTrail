<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Review\ReviewController;
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

Route::middleware(['api'])->group(function () {
    Route::middleware('guest')->group(function () {
        Route::post('login', [AuthenticatedSessionController::class, 'loginApi']);
    });
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'logoutApi']);
        Route::post('review/create', [ReviewController::class, 'create']);
        Route::get('review/fake-reviews', [ReviewController::class, 'fakeReviews']);
    });
});