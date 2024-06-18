<?php

namespace App\Providers;

use App\Models\SaleDetail;
use App\MoonShine\Resources\ProductResource;
use App\MoonShine\Resources\SaleDetailResource;
use App\MoonShine\Resources\SaleResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->registerResources();
    }

    /**
     * Register the resources.
     */
    protected function registerResources(){
        SaleResource::class;
        SaleDetailResource::class;
        ProductResource::class;
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
