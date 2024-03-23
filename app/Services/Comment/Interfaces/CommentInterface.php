<?php

namespace App\Services\Comment\Interfaces;

use App\Models\Comment;
use App\Models\Task;

interface CommentInterface
{
    public function createComment(string $content, Task $task): Comment;
}
