<?php

use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\FoodSizeController;
use App\Http\Controllers\FoodToppingController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//admin route
Route::prefix('/admin')->middleware(['isAdmin', 'auth'])->group(function () {
    Route::get('/', [HomeController::class, 'adminIndex'])->name('admin.home');
    Route::resource('/user', UserController::class);
    Route::resource('/level', LevelController::class);
    Route::resource('/gender', GenderController::class);

    Route::resource('/food-category', FoodCategoryController::class);

    Route::resource('/food-size', FoodSizeController::class);
    Route::put('/food-size/{food-size}/change-visible', [FoodCategoryController::class, 'updateVisible'])
        ->name('food-size.changeVisible');
});

//customer route
Route::prefix('/home')->middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});
