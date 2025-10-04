<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APIGoalController;
use App\Http\Controllers\API\APILoginController;
use App\Http\Controllers\Api\APIProfileController;
use App\Http\Controllers\API\APICategoryController;
use App\Http\Controllers\API\APIRegisterController;

Route::post('/login', [APILoginController::class, 'login'])->name('api.login');

Route::post('/register', [APIRegisterController::class, 'store'])->name('api.register');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [APILoginController::class, 'logout'])->name('api.logout');

    Route::post('category-and-icon', [APIGoalController::class, 'index'])->name('api.category-and-icon');

    Route::post('goal-store', [APIGoalController::class, 'store'])->name('api.goal-store');

    Route::post('goal-details/{goal}', [APIGoalController::class, 'goalDetails'])->name('api.goal-details');

    Route::delete('/goals/{goal}', [APIGoalController::class, 'goalDelete']);

    Route::post('home', [APIGoalController::class, 'home'])->name('api.home');

    Route::post('categories', [APICategoryController::class, 'index'])->name('api.home');

    Route::put('/goals/{goal}/contribute', [APIGoalController::class, 'addContribution']);

    Route::post('/profile', [APIProfileController::class, 'show']);

    Route::put('/profile', [APIProfileController::class, 'update']);









});