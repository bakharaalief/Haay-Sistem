<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\FoodMenuController;
use App\Http\Controllers\FoodMenuTypeController;
use App\Http\Controllers\FoodSizeController;
use App\Http\Controllers\FoodTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\NormalController;
use App\Http\Controllers\OrderAdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Models\Cart;
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

//normal route
Route::prefix('/')->group(function () {
    Route::get('/', [NormalController::class, 'homeIndex'])->name('normal.home');
    Route::get('/menu', [NormalController::class, 'menuIndex'])->name('normal.menu');
    Route::get('/menu/{id}', [NormalController::class, 'menuDetail'])->name('normal.menuDetail');
});

Auth::routes();

//admin route
Route::prefix('/admin')->middleware(['isAdmin', 'auth'])->group(function () {
    Route::get('/', [HomeController::class, 'adminIndex'])->name('admin.home');
    Route::resource('/user', UserController::class);
    Route::resource('/level', LevelController::class);

    //food menu
    Route::put('/food-menu/{id}/change-visible', [FoodMenuController::class, 'updateVisible'])
        ->name('food-menu.changeVisible');
    Route::get('/food-menu/{id}/all-type', [FoodMenuController::class, 'allType'])
        ->name('food-menu.allType');
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

    //food menu type
    Route::resource('/food-menu-type', FoodMenuTypeController::class);

    //order
    Route::get('/order/{id}/order-detail', [OrderAdminController::class, 'orderDetail'], ['as' => 'admin']);
    Route::resource('/order', OrderAdminController::class, ['as' => 'admin']);
});

//customer route
Route::resource('/cart', CartController::class)->middleware(['auth']);
Route::resource('/order', OrderController::class)->middleware(['auth']);
