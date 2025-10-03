<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IconControllerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->group(function () {
        Route::group([
            'prefix' => 'category',
            'as' => 'category.'
        ], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CategoryController::class, 'show'])->name('show');
            Route::get('/get-category', [CategoryController::class, 'getAjaxCategoryData'])->name('get-category');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('delete');
        });

        Route::group([
            'prefix' => 'icon',
            'as' => 'icon.'
        ], function () {
            Route::get('/', [IconControllerController::class, 'index'])->name('index');
            Route::get('/create', [IconControllerController::class, 'create'])->name('create');
            Route::post('/store', [IconControllerController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [IconControllerController::class, 'show'])->name('show');
            Route::get('/get-icon', [IconControllerController::class, 'getAjaxCategoryData'])->name('get-icon');
            Route::put('/update/{id}', [IconControllerController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [IconControllerController::class, 'destroy'])->name('delete');
        });
    });
});

require __DIR__.'/auth.php';
