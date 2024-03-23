<?php

namespace App\Services\Auth\Interfaces;

interface RegisterInterface
{
    public function createUserRegister(array $payload): array;
}
