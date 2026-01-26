<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Category;
use App\Enum\FeedbackStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'category_id' => Category::factory()->create()->id,
            'feeedback_title' => fake()->unique()->words(2, true),
            'details' => fake()->paragraph(),
            'location' => fake()->locale(),
            'status' => fake()->randomElement(FeedbackStatus::class),
            'anonymous' => fake()->boolean(),
            'image' => fake()->filePath(),
            'admin_response' => fake()->boolean() ? fake()->paragraph() : ""
        ];
    }
}
