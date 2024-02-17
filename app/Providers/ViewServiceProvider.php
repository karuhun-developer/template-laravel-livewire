<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\View\View;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Facades\View::composer('components.navigation', function(View $view) {
            $view->with('menus', Menu::orderBy('ordering', 'asc')->where('on', 'cms')->get());
        });

        // Pas setting
        Facades\View::composer(['components.navigation'], function(View $view) {
            $settings = Setting::first();
            $settings->opengraph = json_decode($settings->opengraph, true);
            $settings->dulbincore = json_decode($settings->dulbincore, true);
            $settings->social_media = json_decode($settings->social_media, true);
            $view->with('settings', $settings);
        });
    }
}
