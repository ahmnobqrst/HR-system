<?php

namespace App\Providers;

use App\Interface\SuperAdmin\SuperAdminInterface;
use App\Repository\SuperAdmin\SuperAdminRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SuperAdminInterface::class, SuperAdminRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
