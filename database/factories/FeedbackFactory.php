<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Enum\FeedbackStatus;
use App\Enum\Category;

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
            'category' => fake()->randomElement(Category::class),
            'feedback_title' => fake()->unique()->words(2, true),
            'details' => fake()->text(200),
            'location' => fake()->locale(),
            'status' => fake()->randomElement(FeedbackStatus::class),
            'image' => fake()->filePath(),
            'admin_response' => fake()->boolean() ? fake()->text(200) : ""
        ];
    }
}
