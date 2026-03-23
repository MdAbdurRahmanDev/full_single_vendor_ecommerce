<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

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
        if (Schema::hasTable('settings')) {
            $settings = Setting::pluck('value', 'key')->all();
            View::share('global_settings', $settings);
        }

        if (Schema::hasTable('categories')) {
            $categories = \App\Models\Categorie::where('status', 'active')->get();
            View::share('global_categories', $categories);
        }
    }
}
