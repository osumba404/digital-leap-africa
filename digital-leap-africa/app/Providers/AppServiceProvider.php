<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

// Add these new 'use' statements
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;

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
        Paginator::useBootstrapFive();

        // Share all site settings with all views
        if (Schema::hasTable('site_settings') && !$this->app->runningInConsole()) {
            try {
                $settings = SiteSetting::pluck('value', 'key')->all();
                View::share('siteSettings', $settings);
            } catch (\Exception $e) {
                View::share('siteSettings', []); // Share an empty array on error
            }
        } else {
            View::share('siteSettings', []);
        }
    }
}