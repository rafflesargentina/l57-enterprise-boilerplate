<?php

namespace Raffles\Modules\Dashboard\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('dashboard', 'Resources/Lang', 'app'), 'dashboard');
        $this->loadViewsFrom(module_path('dashboard', 'Resources/Views', 'app'), 'dashboard');
        $this->loadMigrationsFrom(module_path('dashboard', 'Database/Migrations', 'app'), 'dashboard');
        $this->loadConfigsFrom(module_path('dashboard', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('dashboard', 'Database/Factories', 'app'));
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }
}
