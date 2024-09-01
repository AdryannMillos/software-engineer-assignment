<?php

namespace App\Providers;

use App\Repositories\Candidate\CandidateRepository;
use App\Repositories\Candidate\CandidateRepositoryInterface;
use App\Repositories\Disposition\DispositionRepository;
use App\Repositories\Disposition\DispositionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CandidateRepositoryInterface::class, CandidateRepository::class);
        $this->app->bind(DispositionRepositoryInterface::class, DispositionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
