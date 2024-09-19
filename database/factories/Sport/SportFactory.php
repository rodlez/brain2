<?php

namespace Database\Factories\Sport;

use App\Models\Sport\SportCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SportCategory>
 */
class SportFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title' => fake()->sentence(),
            'user_id' => implode(User::get()->pluck('id')->random(1)->toArray()),
            'category_id' => implode(SportCategory::get()->pluck('id')->random(1)->toArray()),
            'status' => fake()->boolean(),
            'date' => fake()->dateTimeBetween('2024-01-01', 'now'),
            'location' => fake()->word(),
            'duration' => fake()->numberBetween(10, 200),
            'distance' => fake()->randomFloat(1, 0, 30),
            'url' => fake()->url(),
            'info' => fake()->text(),
        ];
    }
}
