<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->name,
            'address' => $this->faker->address,
            'status_id' => $this->faker->numberBetween(1, 4),
            'building_id' => Building::factory(),
            'user_id' => User::factory(),
        ];
    }
}
