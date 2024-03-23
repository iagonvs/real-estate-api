<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\FilterTasksRequest;
use App\Services\Task\Interfaces\TaskInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function __construct(protected readonly TaskInterface $taskService)
    {
    }

    public function get(FilterTasksRequest $request): JsonResponse
    {
        return response()->json($this->taskService->getTasks($request->validated()));
    }

    public function store(CreateTaskRequest $request): JsonResponse
    {
        return response()->json($this->taskService->createTask(
            $request->validated()),
            Response::HTTP_CREATED
        );
    }
}
