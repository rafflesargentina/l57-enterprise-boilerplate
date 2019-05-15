<?php

namespace Raffles\Providers;

use Raffles\Listeners\PruneOldTokens;
use Raffles\Listeners\RevokeOldTokens;
use Raffles\Listeners\SendEmailUserRegistered;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Laravel\Passport\Events\AccessTokenCreated;
use Laravel\Passport\Events\RefreshTokenCreated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        AccessTokenCreated::class => [
            RevokeOldTokens::class,
        ],

        RefreshTokenCreated::class => [
            PruneOldTokens::class,
        ],

        Registered::class => [
            SendEmailUserRegistered::class,
            SendEmailVerificationNotification::class,
        ]
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        //
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
