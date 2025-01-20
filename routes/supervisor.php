<?php

use App\Http\Controllers\Supervisor\SettingController;
use App\Http\Controllers\Supervisor\ProfileController;
use App\Http\Controllers\Supervisor\AdminController;
use App\Http\Controllers\Supervisor\AdminRoleController;
use App\Http\Controllers\Supervisor\UserController;
use App\Http\Controllers\Supervisor\UserRoleController;
use App\Http\Controllers\Supervisor\SupplierController;
use App\Http\Controllers\Supervisor\CategoryController;
use App\Http\Controllers\Supervisor\ProductController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Supervisor Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('supervisor')->name('supervisor.')->group(function () {

    Route::middleware('auth.supervisor')->group(function () {

        Route::get('/', function () {
            return view('supervisor.dashboard');
        });
        Route::get('/dashboard', function () {
            return view('supervisor.dashboard');
        })->name('dashboard');

        Route::controller(ProfileController::class)->name('profile.')->group(function () {
            Route::get('/profile', 'edit')->name('edit');
            Route::patch('/profile', 'update')->name('update');
            Route::delete('/profile', 'destroy')->name('destroy');
        });
        
    });

    require __DIR__.'/auth/supervisor.php';


});

