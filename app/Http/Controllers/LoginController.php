<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Auth\Interfaces\LoginInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function __construct(protected readonly LoginInterface $loginService)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $makeLogin = $this->loginService->makeLogin($request->validated());

        if (! $makeLogin) {
            response()->json(['Invalid credentials'], 401);
        }

        return response()->json(['access_token' => $makeLogin]);
    }


    public function logout(): Response
    {
        $this->loginService->makeLogout();
        return response()->noContent();
    }
}
