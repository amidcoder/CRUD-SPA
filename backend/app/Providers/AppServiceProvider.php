<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domains\Posts\Repositories\PostRepositoryInterface;
use Src\Infrastructure\Persistence\EloquentPostRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind interfaces to their implementations here
        $this->app->bind(
            PostRepositoryInterface::class,
            EloquentPostRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
