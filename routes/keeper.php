<?php

use App\Http\Controllers\Keeper\DashboardController;
use App\Http\Controllers\Keeper\ProfileController;
use App\Http\Controllers\Keeper\SupplierController;
use App\Http\Controllers\Keeper\CategoryController;
use App\Http\Controllers\Keeper\ProductController;
use App\Http\Controllers\Keeper\WarehouseController;
use App\Http\Controllers\Keeper\PurchaseController;
use App\Http\Controllers\Keeper\OrderController;
use App\Http\Controllers\Keeper\NotificationController;
use App\Http\Controllers\Keeper\ReportController;

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

    Route::middleware(['auth.keeper', 'verified.keeper'])->group(function () {

        // Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::controller(ProfileController::class)->name('profile.')->group(function () {
            Route::get('/profile', 'index')->name('index');
            // Route::patch('/profile', 'update')->name('update');
            // Route::delete('/profile', 'destroy')->name('destroy');
        });



        Route::resources([
            '/suppliers' => SupplierController::class,
            '/categories' => CategoryController::class,
            '/products' => ProductController::class,
            '/warehouses' => WarehouseController::class,
            '/purchases' => PurchaseController::class,
            '/orders' => OrderController::class,
        ]);
        Route::get('/warehouses/show/transaction/{warehouse_stock}', [WarehouseController::class, 'showTransaction'])->name('warehouses.show.transaction');


        Route::get('/purchases/create/purchase/{purchase}', [PurchaseController::class, 'createPurchase'])->name('purchases.create.purchase');
        Route::get('/purchases/print/purchase/{purchase}', [PurchaseController::class, 'printPurchase'])->name('purchases.print.purchase');



        Route::get('/orders/create/order/{order}', [OrderController::class, 'createOrder'])->name('orders.create.order');
        Route::get('/orders/show/transaction/{order}', [OrderController::class, 'showTransaction'])->name('orders.show.transaction');

        Route::get('/orders/print/order/{order}', [OrderController::class, 'printOrder'])->name('orders.print.order');

        // Reports
        Route::prefix('reports')->name('reports.')->controller(ReportController::class)->group(function () {
            // Show Report
            Route::get('/', 'index')->name('index');
            Route::get('/stocks', 'stocks')->name('stocks');
            Route::get('/stocks/transactions', 'stocksTransactions')->name('stocks.transactions');
            Route::get('/orders', 'orders')->name('orders');
            Route::get('/orders/transactions', 'ordersTransactions')->name('orders.transactions');

            // Print Reports
            Route::get('/print/stocks/{type}/{status}/{fromDate}/{toDate}', 'printStocks')->name('print.stocks');
            Route::get('/print/stocks/transactions/{stocks}/{status}/{fromDate}/{toDate}', 'printStocksTransactions')->name('print.stocks.transactions');
            Route::get('/print/orders/{type}/{status}/{fromDate}/{toDate}', 'printOrders')->name('print.orders');
            Route::get('/print/orders/transactions/{order}/{oldStatus}/{newStatus}/{fromDate}/{toDate}', 'printOrdersTransactions')->name('print.orders.transactions');
        });

        // Notifications
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.read.all');


    });

    require __DIR__.'/auth/keeper.php';


});

