<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CategoryRecipient;
use App\Enum\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryRecipient>
 */
class CategoryRecipientFactory extends Factory
{
    protected $model = CategoryRecipient::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'full_name' => $this->faker->name(),
            'from_category' => $this->faker->randomElement(
                array_column(Category::cases(), 'value')
            ),
            'email' => $this->faker->unique()->safeEmail(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
