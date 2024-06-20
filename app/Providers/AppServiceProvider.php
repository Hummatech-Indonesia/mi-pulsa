<?php

namespace App\Providers;

use App\Contracts\Interfaces\Dashboard\AboutInterface;
use App\Contracts\Interfaces\Dashboard\ContactInterface;
use App\Contracts\Interfaces\Dashboard\CustomerInterface;
use App\Contracts\Interfaces\Dashboard\DepositInterface;
use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Contracts\Interfaces\Dashboard\ProviderInterface;
use App\Contracts\Interfaces\Dashboard\TopupAgenInterface;
use App\Contracts\Interfaces\Dashboard\TransactionInterface;
use App\Contracts\Interfaces\FcmTokenInterface;
use App\Contracts\Interfaces\ProfileInterface;
use App\Contracts\Interfaces\RegisterInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Contracts\Repositories\Dashboard\AboutRepository;
use App\Contracts\Repositories\Dashboard\ContactRepository;
use App\Contracts\Repositories\Dashboard\CustomerRepository as DashboardCustomerRepository;
use App\Contracts\Repositories\Dashboard\DepositRepository;
use App\Contracts\Repositories\Dashboard\ProductRepository;
use App\Contracts\Repositories\Dashboard\ProviderRepository;
use App\Contracts\Repositories\Dashboard\TopupAgenRepository;
use App\Contracts\Repositories\Dashboard\TransactionRepository;
use App\Contracts\Repositories\FcmTokenRepository;
use App\Contracts\Repositories\ProfileRepository;
use App\Contracts\Repositories\RegisterRepository;
use App\Contracts\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private array $register = [
        UserInterface::class => UserRepository::class,
        ProfileInterface::class => ProfileRepository::class,
        RegisterInterface::class => RegisterRepository::class,
        FcmTokenInterface::class => FcmTokenRepository::class,
        CustomerInterface::class => DashboardCustomerRepository::class,
        ProductInterface::class => ProductRepository::class,
        AboutInterface::class => AboutRepository::class,
        ContactInterface::class => ContactRepository::class,
        TopupAgenInterface::class => TopupAgenRepository::class,
        ProviderInterface::class => ProviderRepository::class,
        DepositInterface::class => DepositRepository::class,
        TransactionInterface::class => TransactionRepository::class
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->register as $index => $value)
            $this->app->bind($index, $value);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
