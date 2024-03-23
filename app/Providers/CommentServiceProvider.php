<?php

namespace App\Providers;

use App\Services\Comment\CommentService;
use App\Services\Comment\Interfaces\CommentInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(
            CommentInterface::class,
            CommentService::class
        );
    }

    public function provides(): array
    {
        return [
            CommentInterface::class,
        ];
    }
}
