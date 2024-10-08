<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    const TEST_DEVICES = [
        'M2101K6G',
        'iPhone14,5',
        'iPhone13,2',
        '2109119DG',
        'iPhone15,2',
        'iPhone11,2',
        'iPhone15,2',
        'RMX3393',
        'CPH2009',
        'Mi 9T Pro',
        '2201116PG',
        'Mi 9 Lite',
        'iPhone15,2',
        'M2101K6G',
        '2107113SG',
        'iPhone11,8',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'surname' => fake()->firstName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'platform' => fake()->randomElement(User::PLATFORMS),
            'device' => fake()->randomElement(self::TEST_DEVICES),
            'auth_provider' => fake()->randomElement(User::AUTH_PROVIDERS),
            'locale' => fake()->randomElement(['es', 'en'])
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
