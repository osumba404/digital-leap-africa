<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;

class PerformanceServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Optimize view loading
        View::composer('*', function ($view) {
            // Share common data efficiently
            if (!$view->offsetExists('siteSettings')) {
                $view->with('siteSettings', app(\App\Helpers\SettingsHelper::class)::all());
            }
        });

        // Add custom Blade directives for performance
        Blade::directive('preload', function ($expression) {
            return "<?php echo '<link rel=\"preload\" href=\"' . {$expression} . '\" as=\"image\">'; ?>";
        });
    }

    public function register(): void
    {
        // Register performance optimizations
        if ($this->app->environment('production')) {
            $this->app['config']->set('session.secure', true);
            $this->app['config']->set('session.http_only', true);
        }
    }
}
