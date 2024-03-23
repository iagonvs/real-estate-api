<?php

namespace App\Services\Task\Interfaces;

use App\Models\Task;
use Illuminate\Support\Collection;

interface TaskInterface
{
    public function getTasks(array $filters): Collection;
    public function createTask(array $payload): Task;
}
