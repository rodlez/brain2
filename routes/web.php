<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Sport\SportCategoryController;
use App\Http\Controllers\Sport\SportTagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// *********** SPORT *******************
Route::get('/dashboard/sport', function () {
    return view('sport/main');
})->middleware(['auth', 'verified'])->name('sport.main');

// CATEGORIES

Route::get('/dashboard/sport/category', [SportCategoryController::class, 'index'])->name('sportcategory.index')->middleware(['auth', 'verified']);
Route::post('/dashboard/sport/category', [SportCategoryController::class, 'store'])->name('sportcategory.store')->middleware(['auth', 'verified']);
Route::get('/dashboard/sport/category/create', [SportCategoryController::class, 'create'])->name('sportcategory.create')->middleware(['auth', 'verified']);
Route::get('/dashboard/sport/category/{category}', [SportCategoryController::class, 'show'])->name('sportcategory.show')->middleware(['auth', 'verified']);
Route::put('/dashboard/sport/category/{category}', [SportCategoryController::class, 'update'])->name('sportcategory.update')->middleware(['auth', 'verified']);
Route::delete('/dashboard/sport/category/{category}', [SportCategoryController::class, 'destroy'])->name('sportcategory.destroy')->middleware(['auth', 'verified']);
Route::get('/dashboard/sport/category/edit/{category}', [SportCategoryController::class, 'edit'])->name('sportcategory.edit')->middleware(['auth', 'verified']);

Route::get('/dashboard/sport/category/test', [SportCategoryController::class, 'test'])->name('sportcategory.test')->middleware(['auth', 'verified']);

// TAGS 
Route::get('/dashboard/sport/tag', [SportTagController::class, 'index'])->name('sporttag.index')->middleware(['auth', 'verified']);
Route::post('/dashboard/sport/tag', [SportTagController::class, 'store'])->name('sporttag.store')->middleware(['auth', 'verified']);
Route::get('/dashboard/sport/tag/create', [SportTagController::class, 'create'])->name('sporttag.create')->middleware(['auth', 'verified']);
Route::get('/dashboard/sport/tag/{tag}', [SportTagController::class, 'show'])->name('sporttag.show')->middleware(['auth', 'verified']);
Route::put('/dashboard/sport/tag/{tag}', [SportTagController::class, 'update'])->name('sporttag.update')->middleware(['auth', 'verified']);
Route::delete('/dashboard/sport/tag/{tag}', [SportTagController::class, 'destroy'])->name('sporttag.destroy')->middleware(['auth', 'verified']);
Route::get('/dashboard/sport/tag/edit/{tag}', [SportTagController::class, 'edit'])->name('sporttag.edit')->middleware(['auth', 'verified']);



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
