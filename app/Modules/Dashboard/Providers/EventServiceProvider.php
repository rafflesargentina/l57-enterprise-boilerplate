<?php

namespace Raffles\Modules\Dashboard\Providers;

use Raffles\Modules\Dashboard\Listeners\RecordSuccessfulLogin;
use Raffles\Modules\Dashboard\Listeners\RecordSuccessfulLogout;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Login::class => [
            RecordSuccessfulLogin::class,
        ],

        Logout::class => [
            RecordSuccessfulLogout::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
