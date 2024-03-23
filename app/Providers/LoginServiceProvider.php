<?php

namespace App\Providers;

use App\Services\Auth\Interfaces\LoginInterface;
use App\Services\Auth\LoginService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class LoginServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(
            LoginInterface::class,
            LoginService::class
        );
    }

    public function provides(): array
    {
        return [
            LoginInterface::class,
        ];
    }
}
