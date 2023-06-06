<?php

namespace App\Providers;

use App\Events\CostAmountAdded;
use App\Events\CostAmountDeleted;
use App\Events\CostUpdated;
use App\Listeners\CostAmountAddedNotification;
use App\Listeners\CostAmountDeletedNotification;
use App\Listeners\CostUpdatedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CostUpdated::class => [
            CostUpdatedNotification::class,
        ],
        CostAmountAdded::class => [
            CostAmountAddedNotification::class,
        ],
        CostAmountDeleted::class => [
            CostAmountDeletedNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
