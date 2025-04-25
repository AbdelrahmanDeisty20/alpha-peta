<?php

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use App\Models\Setting;
use BezhanSalleh\FilamentLanguageSwitch\Enums\Placement;
use Illuminate\Support\ServiceProvider;

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
        $setting = app(\App\Settings\GeneralSettings::class);
        view()->share('setting', $setting);


        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar', 'en']);

        });

        app()->setLocale(session('lang', default: config('app.locale')));
    }
}
