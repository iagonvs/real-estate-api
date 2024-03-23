<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Auth\Interfaces\RegisterInterface;
use Illuminate\Support\Facades\Hash;

class RegisterService implements RegisterInterface
{
    public function createUserRegister(array $payload): array
    {
        return $this->createBearerToken($this->createUser($payload));
    }

    private function createUser(array $payload): User
    {
        return User::query()->create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'password' => Hash::make($payload['password']),
        ]);
    }

    private function createBearerToken(User $user): array
    {
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->accessToken;
        $token->expires_at = now()->addDay();
        $token->save();

        return [
            'token' => $tokenResult->plainTextToken,
            'user' => $user->toArray(),
        ];
    }
}
