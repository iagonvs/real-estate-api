<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\Auth\Interfaces\RegisterInterface;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __construct(protected readonly RegisterInterface $registerService)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        return response()->json($this->registerService->createUserRegister($request->validated()));
    }
}
