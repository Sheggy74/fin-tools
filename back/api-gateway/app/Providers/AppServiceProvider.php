<?php

namespace App\Providers;

use App\Services\SecurityService\Repository\ISecurityRepository;
use App\Services\SecurityService\Repository\SecurityRepositoryRPC;
use App\Services\SecurityService\SecurityService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        App::bind(SecurityService::class, SecurityService::class);
        App::bind(ISecurityRepository::class, SecurityRepositoryRPC::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
