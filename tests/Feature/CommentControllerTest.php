<?php

namespace Tests\Feature;

use App\Http\Middleware\CheckTokenExpiration;
use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();

        $this->user = User::factory()->create();
        $this->task = Task::factory()->create();
    }

    public function test_cant_use_route_and_return_unauthorized(): void
    {
        $this->withMiddleware();

        $this->postJson(route('create.comments', $this->task))->assertUnauthorized();
    }

    public function test_cant_use_route_with_user_not_authenticated(): void
    {
        $this->postJson(route('create.comments', $this->task))->assertForbidden();
    }

    public function test_can_store_comment_and_should_return_status_201(): void
    {
        $this->withMiddleware();
        $this->withoutMiddleware(CheckTokenExpiration::class);

        $commentData = [
            'content' => $this->faker->title,
            'task_id' => $this->task->id,
            'user_id' => $this->user->id,
        ];

        $this->actingAs($this->user)->postJson(route('create.comments', $this->task), $commentData)
            ->assertStatus(201)
            ->assertJson($commentData);

        $this->assertDatabaseHas(Comment::class, $commentData);
    }
}
