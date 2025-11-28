<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        // Add a custom Blade directive for versioned assets
        Blade::directive('versionedAsset', function ($expression) {
            return "<?php echo versioned_asset($expression); ?>";
        });
    }
}
