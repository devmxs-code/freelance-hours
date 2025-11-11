<?php

namespace App\Providers;

use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Repositories\Contracts\ProposalRepositoryInterface;
use App\Repositories\ProjectRepository;
use App\Repositories\ProposalRepository;
use App\Services\Contracts\ProjectServiceInterface;
use App\Services\Contracts\ProposalServiceInterface;
use App\Services\ProjectService;
use App\Services\ProposalService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(
            ProjectRepositoryInterface::class,
            ProjectRepository::class
        );

        $this->app->bind(
            ProposalRepositoryInterface::class,
            ProposalRepository::class
        );

        // Services
        $this->app->bind(
            ProjectServiceInterface::class,
            ProjectService::class
        );

        $this->app->bind(
            ProposalServiceInterface::class,
            ProposalService::class
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
