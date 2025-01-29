<?php

use App\Http\Controllers\Supervisor\DashboardController;
use App\Http\Controllers\Supervisor\ProfileController;
use App\Http\Controllers\Supervisor\ProductController;
use App\Http\Controllers\Supervisor\KitchenController;
use App\Http\Controllers\Supervisor\OrderController;
use App\Http\Controllers\Supervisor\NotificationController;
use App\Http\Controllers\Supervisor\ReportController;

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

        // Route::get('/', function () {
        //     return view('supervisor.dashboard');
        // });
        // Route::get('/dashboard', function () {
        //     return view('supervisor.dashboard');
        // })->name('dashboard');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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


        // Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        // Route::get('/reports/stocks', [ReportController::class, 'stocks'])->name('reports.stocks');
        // Route::get('/reports/stocks/transactions', [ReportController::class, 'stocksTransactions'])->name('reports.stocks.transactions');
        // Route::get('/reports/orders', [ReportController::class, 'orders'])->name('reports.orders');
        // Route::get('/reports/orders/transactions', [ReportController::class, 'ordersTransactions'])->name('reports.orders.transactions');
        
        // // Print Reports
        // Route::get('/reports/print/stocks/{type}/{status}/{fromDate}/{toDate}', [ReportController::class, 'printStocks'])->name('reports.print.stocks');
        // Route::get('/reports/print/stocks/transactions/{stocks}/{status}/{fromDate}/{toDate}', [ReportController::class, 'printStocksTransactions'])->name('reports.print.stocks.transactions');
        // Route::get('/reports/print/orders/{type}/{status}/{fromDate}/{toDate}', [ReportController::class, 'printOrders'])->name('reports.print.orders');
        // Route::get('/reports/print/orders/transactions/{order}/{oldStatus}/{newStatus}/{fromDate}/{toDate}', [ReportController::class, 'printOrdersTransactions'])->name('reports.print.orders.transactions');


        // Notifications
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.read.all');



        
    });

    require __DIR__.'/auth/supervisor.php';


});

