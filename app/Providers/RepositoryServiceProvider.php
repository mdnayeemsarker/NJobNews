<?php

namespace App\Providers;

use App\Repositories\AdsRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\FileUploadRepository;
use App\Repositories\Interfaces\AdsRepositoryInterface;
use App\Repositories\SettingRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\FileUploadRepositoryInterface;
use App\Repositories\Interfaces\JobRepositoryInterface;
use App\Repositories\Interfaces\PageRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\SmsWorkerRepositoryInterface;
use App\Repositories\JobRepository;
use App\Repositories\PageRepository;
use App\Repositories\SmsWorkerRepository;
use App\Services\FileUploadService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind CategoryRepositoryInterface to CategoryRepository
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);

        // Bind PageRepositoryInterface to PageRepository
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);

        // Bind AdsRepositoryInterface to AdsRepository
        $this->app->bind(AdsRepositoryInterface::class, AdsRepository::class);

        // Bind SmsWorkerRepositoryInterface to SmsWorkerRepository
        $this->app->bind(SmsWorkerRepositoryInterface::class, SmsWorkerRepository::class);

        // Bind JobRepositoryInterface to JobRepository
        $this->app->bind(JobRepositoryInterface::class, JobRepository::class);

        // Bind SettingRepositoryInterface to SettingRepository
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);

        // Bind the FileUploadRepository
        $this->app->bind(FileUploadRepositoryInterface::class, FileUploadRepository::class);

        // Bind the FileUploadService with the required dependency
        $this->app->singleton(FileUploadService::class, function ($app) {
            return new FileUploadService($app->make(FileUploadRepository::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
