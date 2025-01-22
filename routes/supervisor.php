<?php

use App\Http\Controllers\Supervisor\ProfileController;
use App\Http\Controllers\Supervisor\ProductController;
use App\Http\Controllers\Supervisor\KitchenController;
use App\Http\Controllers\Supervisor\OrderController;
use App\Http\Controllers\Supervisor\NotificationController;

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



        Route::resources([
            '/kitchens' => KitchenController::class,

            '/products' => ProductController::class,

            '/orders' => OrderController::class,
        ]);
        Route::get('/kitchens/show/transaction/{kitchen_stock}', [KitchenController::class, 'showTransaction'])->name('kitchens.show.transaction');

        Route::get('/orders/create/order/{order}', [OrderController::class, 'createOrder'])->name('orders.create.order');
        Route::get('/orders/print/order/{order}', [OrderController::class, 'printOrder'])->name('orders.print.order');

        // Read All Notifications
        Route::get('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.read.all');



        
    });

    require __DIR__.'/auth/supervisor.php';


});

