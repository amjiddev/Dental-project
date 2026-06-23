<?php

namespace App\Providers;

use Livewire\Livewire;
use App\Core\KTBootstrap;
use App\Models\Service;
use App\Models\ContactMessage;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\ServingCity;
use App\Models\State;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Update defaultStringLength
        Builder::defaultStringLength(191);

        Paginator::useBootstrapFive();

        KTBootstrap::init();

        View::composer('layout.partials.sidebar-layout.sidebar.admin-sidebar', function ($view) {
            $view->with(
                'sidebarServices',
                Service::orderBy('order', 'asc')->get(['id', 'name'])
            )->with(
                'unreadMessagesCount',
                ContactMessage::unread()->count()
            );
        });

        View::composer(config('settings.KT_THEME_LAYOUT_DIR').'.partials.sidebar-layout._toolbar', function ($view) {
            $pendingAppointmentsCount = Appointment::where('status', 'pending')->count();

            $view->with('notificationCount', $pendingAppointmentsCount);
        });

        // Share dynamic services with frontend header
        View::composer('frontend.layouts.partials.header', function ($view) {
            $view->with(
                'frontendServices',
                Service::active()->ordered()->get(['id', 'name', 'slug'])
            );
        });

        if (app()->environment('production')) {
            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/starterkit/metronic/laravel/livewire/update', $handle);
            });
        }
    }
}
