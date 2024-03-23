<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Task;
use App\Services\Comment\Interfaces\CommentInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function __construct(protected readonly CommentInterface $commentService)
    {
    }

    public function store(CreateCommentRequest $request, Task $task): JsonResponse
    {
        return response()->json(
            $this->commentService->createComment($request->validated()['content'], $task),
            Response::HTTP_CREATED
        );
    }
}
