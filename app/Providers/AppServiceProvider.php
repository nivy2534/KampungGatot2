<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\BlogRepository;
use App\Repositories\Contracts\GaleryRepositoryInterface;
use App\Repositories\GaleryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(GaleryRepositoryInterface::class, GaleryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
