<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Project::class;

    public function definition(): array
    {
    $start = $this->faker->dateTimeBetween('-5 years', 'now');

    $hasEnded = $this->faker->boolean(50);

    $end = $hasEnded ? $this->faker->dateTimeBetween($start, 'now') : null;

    return [
        'title' => ucfirst($this->faker->words(3, true)),
        'short_description' => $this->faker->paragraph(2),
        'start_date' => $start,
        'end_date' => $end,
        'phase' => $hasEnded
            ? 'complete'
            : $this->faker->randomElement(['design', 'development', 'testing', 'deployment']),
        'user_id' => User::inRandomOrder()->value('id'),

    ];
}
}