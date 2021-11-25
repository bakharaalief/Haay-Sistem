<?php

use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\FoodMenuController;
use App\Http\Controllers\FoodSizeController;
use App\Http\Controllers\FoodTypeController;
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

    //food menu
    Route::resource('/food-menu', FoodMenuController::class);

    //food category
    Route::put('/food-category/{id}/change-visible', [FoodCategoryController::class, 'updateVisible'])
        ->name('food-category.changeVisible');
    Route::resource('/food-category', FoodCategoryController::class);

    //food size
    Route::put('/food-size/{id}/change-visible', [FoodSizeController::class, 'updateVisible'])
        ->name('food-size.changeVisible');
    Route::resource('/food-size', FoodSizeController::class);

    //food type
    Route::put('/food-type/{id}/change-visible', [FoodTypeController::class, 'updateVisible'])
        ->name('food-type.changeVisible');
    Route::resource('/food-type', FoodTypeController::class);
});

//customer route
Route::prefix('/home')->middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});
