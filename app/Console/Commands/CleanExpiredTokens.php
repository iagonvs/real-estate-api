<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;

class CleanExpiredTokens extends Command
{
    protected $signature = 'tokens:clean-expired';

    protected $description = 'Remove expired personal access tokens';

    public function handle(): void
    {
        $deleted = PersonalAccessToken::query()
            ->where('expires_at', '<', now())
            ->delete();

        Log::info("Removed $deleted expired tokens.");
    }
}
