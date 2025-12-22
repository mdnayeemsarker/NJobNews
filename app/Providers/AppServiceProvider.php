<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\User;
use App\Observers\JobObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        User::observe(UserObserver::class);
        Job::observe(JobObserver::class);
    }
}
