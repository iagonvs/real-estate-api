<?php

namespace App\Providers;

use App\Services\Auth\Interfaces\RegisterInterface;
use App\Services\Auth\RegisterService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RegisterServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(
            RegisterInterface::class,
            RegisterService::class
        );
    }

    public function provides(): array
    {
        return [
            RegisterInterface::class,
        ];
    }
}
