<?php

namespace App\Services\Task;

use App\Models\Task;
use App\Services\Task\Interfaces\TaskInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class TaskService implements TaskInterface
{
    public function getTasks(array $filters): Collection
    {
        $query = Task::with(['comments', 'building']);

        $this->applyFilters($query, $filters);

        return $query->get();
    }

    private function applyFilters(Builder $query, array $filters): void
    {
        foreach ($filters as $filter => $value) {
            match ($filter) {
                'date_from', 'date_to' => $this->applyDateFilter($query, $filters),
                'user_id', 'status_id', 'building_id' => $this->applyDirectFilter($query, $filter, $value),
                default => null,
            };
        }
    }

    private function applyDateFilter(Builder $query, array $filters): void
    {
        if (! Arr::has($filters, ['date_from', 'date_to'])) {
            return;
        }

        $dateFrom = Arr::get($filters, 'date_from');
        $dateTo = Arr::get($filters, 'date_to');

        $dateToAdjusted = $this->adjustDateToEndOfDay($dateTo);

        $query->whereBetween('created_at', [$dateFrom, $dateToAdjusted]);
    }

    private function adjustDateToEndOfDay(string $date): string
    {
        return Carbon::createFromFormat('Y-m-d', $date)->endOfDay()->toDateTimeString();
    }

    private function applyDirectFilter(Builder $query, string $filter, int|string $value): void
    {
        $query->where($filter, $value);
    }

    public function createTask(array $payload): Task
    {
        return Task::query()->create($payload);
    }
}
