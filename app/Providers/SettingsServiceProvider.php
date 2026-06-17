<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use App\Models\Service;


class SettingsServiceProvider extends ServiceProvider
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
        try {
            // Share contact settings with all views (for footer)
            $contactSettings = Cache::remember('contact_settings', 3600, function () {
                return Setting::where('key', 'like', 'contact_%')
                    ->orWhere('key', 'like', 'map_%')
                    ->pluck('value', 'key')
                    ->toArray();
            });
            View::share('contactSettings', $contactSettings);

            // Share first 5 active services for footer
            $footerServices = Cache::remember('footer_services', 3600, function () {
                return Service::active()->ordered()->limit(5)->get();
            });
            View::share('footerServices', $footerServices);
        } catch (\Exception $e) {
            Log::warning('SettingsServiceProvider: Failed to load settings', [
                'error' => $e->getMessage()
            ]);
        }
    }
}
