<?php

use App\Http\Controllers\Keeper\SettingController;
use App\Http\Controllers\Keeper\ProfileController;
use App\Http\Controllers\Keeper\AdminController;
use App\Http\Controllers\Keeper\AdminRoleController;
use App\Http\Controllers\Keeper\UserController;
use App\Http\Controllers\Keeper\UserRoleController;
use App\Http\Controllers\Keeper\SupplierController;
use App\Http\Controllers\Keeper\CategoryController;
use App\Http\Controllers\Keeper\ProductController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Keeper Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('keeper')->name('keeper.')->group(function () {

    Route::middleware('auth.keeper')->group(function () {

        Route::get('/', function () {
            return view('keeper.dashboard');
        });
        Route::get('/dashboard', function () {
            return view('keeper.dashboard');
        })->name('dashboard');

        // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::controller(ProfileController::class)->name('profile.')->group(function () {
            Route::get('/profile', 'edit')->name('edit');
            Route::patch('/profile', 'update')->name('update');
            Route::delete('/profile', 'destroy')->name('destroy');
        });
        
    });

    require __DIR__.'/auth/keeper.php';


});

