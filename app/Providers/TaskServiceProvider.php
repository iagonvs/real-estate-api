<?php

namespace App\Providers;

use App\Services\Task\Interfaces\TaskInterface;
use App\Services\Task\TaskService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(
            TaskInterface::class,
            TaskService::class
        );
    }

    public function provides(): array
    {
        return [
          TaskInterface::class,
        ];
    }
}
