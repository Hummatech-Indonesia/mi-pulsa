<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\TopupAgen;
use App\Models\Transaction;
use App\Models\User;
use App\Observers\Dashboard\CustomerObserver;
use App\Observers\Dashboard\ProductObserver;
use App\Observers\Dashboard\TopupAgenObserver;
use App\Observers\Dashboard\TopupObserver;
use App\Observers\TopupAgenObserver as ObserversTopupAgenObserver;
use App\Observers\TransactionObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Customer::observe(CustomerObserver::class);
        Product::observe(ProductObserver::class);
        Transaction::observe(TransactionObserver::class);
        TopupAgen::observe(ObserversTopupAgenObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
