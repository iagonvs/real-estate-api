<?php

namespace App\Services\Auth\Interfaces;

interface LoginInterface
{
    public function makeLogin(array $payload): ?string;
    public function makeLogout(): void;
}
