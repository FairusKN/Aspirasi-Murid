<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Enum\UserRole;
use App\Enum\UserClass;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $role =  fake()->randomElement(array_column(UserRole::cases(), 'value'));
        return [
            'email' => fake()->unique()->email(),
            'full_name' => fake()->name(),
            'role' => $role,
            'nis' => $role == UserRole::Student->value ? fake()->creditCardNumber(separator: "") : null,
            //'is_active' => fake()->boolean(),
            'class' => $role == UserRole::Student->value ? fake()->randomElement(UserClass::class) : null,
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
