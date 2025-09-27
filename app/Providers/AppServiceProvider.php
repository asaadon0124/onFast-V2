<?php

namespace App\Providers;

use App\Admin\CityInterface;
use App\Admin\OrderInterface;
use App\Admin\RebortInterface;
use App\Admin\ProductInterface;
use App\Admin\ServantInterface;
use App\Admin\SupplierInterface;
use App\Admin\AdminAuthInterface;
use App\Admin\DashboardInterface;
use App\Admin\GovernorateInterface;
use App\Services\Admin\CityService;
use App\Services\Admin\OrderService;
use Illuminate\Pagination\Paginator;
use App\Admin\OrderDetailesInterface;
use App\Services\Admin\RebortService;
use Illuminate\Support\Facades\Route;
use App\Services\Admin\ProductService;
use App\Services\Admin\ServantService;
use App\Services\Admin\SupplierService;
use Illuminate\Support\ServiceProvider;
use App\Services\Admin\AuthAdminService;
use App\Services\Admin\DashboardService;
use App\Services\Admin\GovernorateService;
use App\Services\Admin\OrderDetailesService;
use App\Admin\ProductManagementStatusInterface;
use App\Services\Admin\ProductManagementStatusService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AdminAuthInterface::class, AuthAdminService::class);
        $this->app->bind(GovernorateInterface::class, GovernorateService::class);
        $this->app->bind(CityInterface::class, CityService::class);
        $this->app->bind(SupplierInterface::class, SupplierService::class);
        $this->app->bind(ServantInterface::class, ServantService::class);
        $this->app->bind(ProductInterface::class, ProductService::class);
        $this->app->bind(OrderInterface::class, OrderService::class);
        $this->app->bind(OrderDetailesInterface::class, OrderDetailesService::class);
        $this->app->bind(ProductManagementStatusInterface::class, ProductManagementStatusService::class);
        $this->app->bind(DashboardInterface::class, DashboardService::class);
        $this->app->bind(RebortInterface::class, RebortService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paginator::useBootstrap();
         // Load admin routes
        Route::prefix('admin')
            ->middleware('web')
            ->group(base_path('routes/admin.php'));


             Paginator::useBootstrapFour();
    }
}
