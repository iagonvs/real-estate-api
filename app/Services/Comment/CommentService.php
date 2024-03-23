<?php

namespace App\Services\Comment;

use App\Models\Comment;
use App\Models\Task;
use App\Services\Comment\Interfaces\CommentInterface;
use Illuminate\Support\Facades\Auth;

class CommentService implements CommentInterface
{
    public function createComment(string $content, Task $task): Comment
    {
        return Comment::query()->create([
            'content' => $content,
            'task_id' => $task->id,
            'user_id' => Auth::user()->id,
        ]);
    }
}
