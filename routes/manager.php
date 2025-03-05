<?php

use App\Http\Controllers\Manager\SettingController;
use App\Http\Controllers\Manager\DashboardController;
use App\Http\Controllers\Manager\ProfileController;
use App\Http\Controllers\Manager\AdminController;
use App\Http\Controllers\Manager\AdminRoleController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\ManagerRoleController;
use App\Http\Controllers\Manager\UserController;
use App\Http\Controllers\Manager\UserRoleController;
use App\Http\Controllers\Manager\SupervisorController;
use App\Http\Controllers\Manager\SupervisorRoleController;
use App\Http\Controllers\Manager\RestaurantController;
use App\Http\Controllers\Manager\KitchenController;
use App\Http\Controllers\Manager\KeeperController;
use App\Http\Controllers\Manager\KeeperRoleController;
use App\Http\Controllers\Manager\WarehouseController;
use App\Http\Controllers\Manager\MenuController;
use App\Http\Controllers\Manager\SupplierController;
use App\Http\Controllers\Manager\ClientController;
use App\Http\Controllers\Manager\CategoryController;
use App\Http\Controllers\Manager\ProductController;
use App\Http\Controllers\Manager\PurchaseController;
use App\Http\Controllers\Manager\OrderController;
use App\Http\Controllers\Manager\SaleController;
use App\Http\Controllers\Manager\NotificationController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('manager')->name('manager.')->group(function () {

    Route::middleware(['auth.manager', 'verified.manager'])->group(function () {

        // Route::get('/', function () {
        //     return view('manager.dashboard');
        // });
        // Route::get('/dashboard', function () {
        //     return view('manager.dashboard');
        // })->name('dashboard');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::controller(ProfileController::class)->name('profile.')->group(function () {
            Route::get('/profile', 'index')->name('index');
            // Route::patch('/profile', 'update')->name('update');
            // Route::delete('/profile', 'destroy')->name('destroy');
        });

        Route::resources([
            '/admins' => AdminController::class,
            '/admins-roles' => AdminRoleController::class,

            '/managers' => ManagerController::class,
            '/managers-roles' => ManagerRoleController::class,

            '/users' => UserController::class,
            '/users-roles' => UserRoleController::class,

            '/supervisors' => SupervisorController::class,
            '/supervisors-roles' => SupervisorRoleController::class,

            '/keepers' => KeeperController::class,
            '/keepers-roles' => KeeperRoleController::class,
            
            '/restaurants' => RestaurantController::class,
            '/kitchens' => KitchenController::class,
            '/warehouses' => WarehouseController::class,
            '/menus' => MenuController::class,

            '/suppliers' => SupplierController::class,
            '/clients' => ClientController::class,
            '/categories' => CategoryController::class,
            '/products' => ProductController::class,

            '/purchases' => PurchaseController::class,
            '/orders' => OrderController::class,
            '/sales' => SaleController::class,
            // '/purchases-items' => PurchaseItemController::class,


        ]);
        Route::get('/kitchens/show/transaction/{kitchen_stock}', [KitchenController::class, 'showTransaction'])->name('kitchens.show.transaction');
        Route::get('/warehouses/show/transaction/{warehouse_stock}', [WarehouseController::class, 'showTransaction'])->name('warehouses.show.transaction');

        Route::get('/purchases/create/purchase/{purchase}', [PurchaseController::class, 'createPurchase'])->name('purchases.create.purchase');
        Route::get('/purchases/print/purchase/{purchase}', [PurchaseController::class, 'printPurchase'])->name('purchases.print.purchase');


        Route::get('/orders/create/order/{order}', [OrderController::class, 'createOrder'])->name('orders.create.order');
        Route::get('/orders/show/transaction/{order}', [OrderController::class, 'showTransaction'])->name('orders.show.transaction');
        Route::get('/orders/print/order/{order}', [OrderController::class, 'printOrder'])->name('orders.print.order');

        Route::get('/sales/create/sale/{sale}', [SaleController::class, 'createSale'])->name('sales.create.sale');
        Route::get('/sales/show/transaction/{sale}', [SaleController::class, 'showTransaction'])->name('sales.show.transaction');
        Route::get('/sales/print/sale/{sale}', [SaleController::class, 'printSale'])->name('sales.print.sale');
        
        // Read All Notifications
        Route::get('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.read.all');

        Route::controller(AdminController::class)->group(function () {
            Route::patch('/admins/verify/{admin}', 'verify')->name('admins.verify');
            Route::patch('/admins/assign-role/{admin}', 'assignRole')->name('admins.assign.role');
        });

        Route::controller(ManagerController::class)->group(function () {
            Route::patch('/managers/verify/{manager}', 'verify')->name('managers.verify');
            Route::patch('/managers/assign-role/{manager}', 'assignRole')->name('managers.assign.role');
        });

        Route::controller(SupervisorController::class)->group(function () {
            Route::patch('/supervisors/verify/{supervisor}', 'verify')->name('supervisors.verify');
        });

        

        Route::controller(UserController::class)->group(function () {
            Route::patch('/users/verify/{user}', 'verify')->name('users.verify');
        });

        Route::get('/settings', [SettingController::class, 'index'])->name('settings');

        
    });

    require __DIR__.'/auth/manager.php';


});

