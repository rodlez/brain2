<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Sport\SportCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// SPORT
Route::get('/dashboard/sport', function () {
    return view('sport/main');
})->middleware(['auth', 'verified'])->name('sport.main');

// CATEGORIES

Route::get('/dashboard/sport/category/test', [SportCategoryController::class, 'test'])->name('sportcategory.test')->middleware(['auth', 'verified']);


Route::get('/dashboard/sport/category', [SportCategoryController::class, 'index'])->name('sportcategory.index')->middleware(['auth', 'verified']);;
/* Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy'); */



/* Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('/dashboard/sport/category', SportCategoryController::class);
});
 */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
