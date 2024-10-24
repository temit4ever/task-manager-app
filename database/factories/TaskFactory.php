<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $project = Project::getOneProjectId();
        return [
            'name' => fake()->name(),
            'priority' => fake()->randomNumber(1),
            'project_id' => $project[0]->id
        ];
    }
}
