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
        Paginator::useTailwind();

        // This code will now work because the classes have been imported.
        // We also check if the app is running in the console to avoid errors during migration.
        if (Schema::hasTable('site_settings') && !$this->app->runningInConsole()) {
            try {
                $logoUrl = SiteSetting::where('key', 'logo_url')->firstOrFail()->value;
                View::share('logoUrl', $logoUrl);
            } catch (\Exception $e) {
                // Handle cases where the setting might not exist yet, even if the table does.
                View::share('logoUrl', 'https://via.placeholder.com/150x50.png/020b13/ffffff?text=DLA+Error');
            }
        } else {
             // Provide a default fallback if the table doesn't exist or we are in the console
            View::share('logoUrl', 'https://via.placeholder.com/150x50.png/020b13/ffffff?text=DLA+Default');
        }
    }
}