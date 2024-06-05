<?php

namespace App\Providers;

use App\Contracts\Interfaces\ProfileInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Contracts\Repositories\ProfileRepository;
use App\Contracts\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private array $register = [
        UserInterface::class => UserRepository::class,
        ProfileInterface::class=>ProfileRepository::class,
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
