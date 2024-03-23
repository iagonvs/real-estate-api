<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Auth\Interfaces\LoginInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService implements LoginInterface
{
    public function makeLogin(array $payload): ?string
    {
        $user = $this->takeUser($payload['email']);

        if (! Hash::check($payload['password'], $user->password)) {
            return null;
        }

        $user->activeTokens()?->delete();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->accessToken;
        $token->expires_at = now()->addDay();
        $token->save();

        return $tokenResult->plainTextToken;
    }

    private function takeUser(string $email): User
    {
        return User::query()->where('email', $email)->firstOrFail();
    }

    public function makeLogout(): void
    {
        Auth::user()->tokens()->delete();
    }
}
