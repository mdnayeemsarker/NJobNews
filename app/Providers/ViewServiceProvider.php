<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Models\Category;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $route = Route::current();

            if ($route && Route::is('frontend.*')) {

                $categories = Category::with(['subCategories' => function ($q) {
                    $q->where('is_menu', true)
                      ->where('status', true)
                      ->orderBy('id', 'ASC');
                }])
                ->where('is_menu', true)
                ->where('status', true)
                ->orderBy('id', 'ASC')
                ->get(['id', 'title', 'slug', 'is_menu', 'status']);

                // Debug without breaking view
                // dd($categories);

                $view->with('categories', $categories);
            }
        });
    }
}
