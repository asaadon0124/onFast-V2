<?php

use App\Livewire\Admin\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfNotAuth;
use App\Livewire\Admin\Reborts\PrintRebort;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admins\AuthController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServantController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\GovernorateController;

    Route::middleware('guest:admin')->group(function ()
    {
        Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
    });

    Route::middleware(RedirectIfNotAuth::class)->group(function ()
    {
        Route::get('/dashBoard', [AuthController::class,'dashboard'])->name('admin.dashboard');
        Route::get('/logout', [AuthController::class,'logout'])->name('admin.logout');

        // GOVERNORATES ROUTES
        Route::get('/governorates', [GovernorateController::class,'index'])->name('governorates.index');

        // CITIES ROUTES
        Route::get('/cities', [CityController::class,'index'])->name('cities.index');

        // SUPPLIERS ROUTES
        Route::get('/suppliers', [SupplierController::class,'index'])->name('suppliers.index');

        // SERVANTS ROUTES
        Route::get('/servants', [ServantController::class,'index'])->name('servants.index');


        // PRODUCTS ROUTES
        Route::get('/products', [ProductController::class,'index'])->name('products.index');

        // ORDERS ROUTES
        Route::get('/orders', [OrderController::class,'index'])->name('orders.index');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('orders.show');


        // REBORTS ROUTES
        Route::get('/reborts', [ReportController::class,'index'])->name('reborts.index');
        Route::get('/reborts/print', [ReportController::class,'print'])->name('reborts.print');





    });
