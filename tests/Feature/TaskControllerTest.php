<?php

namespace Tests\Feature;

use App\Models\Building;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();

        $this->user = User::factory()->create();
    }

    /**
     * @testWith ["get.tasks"]
     *           ["create.tasks"]
     */
    public function test_cant_use_route_and_return_unauthorized(string $routeName): void
    {
        $this->withMiddleware();

        $this->getJson(route($routeName))->assertUnauthorized();
    }

    /**
     * @testWith ["get.tasks"]
     *           ["create.tasks"]
     */
    public function test_cant_use_route_with_user_not_authenticated(string $routeName): void
    {
        $this->getJson(route($routeName))->assertForbidden();
    }

    public function test_can_get_tasks_and_should_return_status_200(): void
    {
        $task = Task::factory()->count(3)->create();

        $this->actingAs($this->user)->getJson(route('get.tasks'))
            ->assertOk()
            ->assertJson($task->toArray());
    }

    public function test_get_tasks_with_status_filter_and_validate_response(): void
    {
        $user = $this->user;
        $building = Building::factory()->create([
            'id' => 1,
        ]);

        Task::factory()->create([
            'created_at' => now(),
            'user_id' => $user->id,
            'status_id' => Status::IN_PROGRESS,
            'building_id' => $building->id,
        ]);

        Task::factory()->create([
            'created_at' => now(),
            'user_id' => $user->id,
            'status_id' => Status::OPEN,
            'building_id' => $building->id,
        ]);

        $response = $this->actingAs($user)->json('GET', route('get.tasks'), [
            'status_id' => Status::IN_PROGRESS,
        ])->assertStatus(200);

        $this->assertCount(1, json_decode($response->getContent(), true));
    }

    public function test_get_tasks_with_user_filter_and_validate_response(): void
    {
        $user = $this->user;
        $building = Building::factory()->create([
            'id' => 1,
        ]);

        Task::factory()->create([
            'created_at' => now(),
            'user_id' => $user->id,
            'status_id' => Status::IN_PROGRESS,
            'building_id' => $building->id,
        ]);

        Task::factory()->create([
            'created_at' => now(),
            'user_id' => User::factory()->create()->id,
            'status_id' => Status::IN_PROGRESS,
            'building_id' => $building->id,
        ]);

        $response = $this->actingAs($user)->json('GET', route('get.tasks'), [
            'user_id' => $this->user->id,
        ])->assertStatus(200);

        $this->assertCount(1, json_decode($response->getContent(), true));
    }

    public function test_get_tasks_with_building_filter_and_validate_response(): void
    {
        $user = $this->user;
        $building = Building::factory()->create([
            'id' => 1,
        ]);

        Task::factory()->create([
            'created_at' => now(),
            'user_id' => $user->id,
            'status_id' => Status::IN_PROGRESS,
            'building_id' => $building->id,
        ]);

        Task::factory()->create([
            'created_at' => now(),
            'user_id' => User::factory()->create()->id,
            'status_id' => Status::IN_PROGRESS,
            'building_id' => 2,
        ]);

        $response = $this->actingAs($user)->json('GET', route('get.tasks'), [
            'building_id' => $building->id,
        ])->assertStatus(200);

        $this->assertCount(1, json_decode($response->getContent(), true));
    }

    public function test_get_tasks_with_date_filter_and_validate_response(): void
    {
        $user = $this->user;

        Task::factory()->create([
            'created_at' => now(),
            'user_id' => $user->id,
            'status_id' => Status::IN_PROGRESS,
            'building_id' => 2,
        ]);

        Task::factory()->create([
            'created_at' => now()->subDays(2),
            'user_id' => User::factory()->create()->id,
            'status_id' => Status::IN_PROGRESS,
            'building_id' => 2,
        ]);

        $response = $this->actingAs($user)->json('GET', route('get.tasks'), [
            'date_from' => now()->format('Y-m-d'),
            'date_to' => now()->format('Y-m-d'),
        ])->assertStatus(200);

        $this->assertCount(1, json_decode($response->getContent(), true));
    }

    public function test_can_store_task_and_should_return_status_201(): void
    {
        $taskData = [
            "title" => $this->faker->title,
            "address" => $this->faker->address,
            "description" => $this->faker->name,
            "user_id" => $this->user->id,
            "status_id" => Status::OPEN,
            "building_id" => Building::factory()->create()->id,
        ];

        $this->actingAs($this->user)->postJson(route('create.tasks'), $taskData)
            ->assertStatus(201)
            ->assertJson($taskData);

        $this->assertDatabaseHas(Task::class, $taskData);
    }
}
