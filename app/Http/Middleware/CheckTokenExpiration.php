<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class CheckTokenExpiration
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()) {
            $tokenId = $request->user()->currentAccessToken()->id;
            $token = PersonalAccessToken::find($tokenId);

            if ($token->expires_at && $token->expires_at->isPast()) {
                $token->delete();
                return response()->json(['message' => 'Token expired'], 401);
            }
        }

        return $next($request);
    }
}
