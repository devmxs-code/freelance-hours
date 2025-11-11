<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        $names = [
            'Tech Solutions', 'Digital Agency', 'Web Studio', 'Code Labs',
            'Innovation Hub', 'Dev Team', 'Software House', 'Tech Corp',
            'Digital Works', 'Code Factory', 'App Studio', 'Web Labs',
        ];

        return [
            'name' => fake()->randomElement($names) . ' ' . fake()->lastName(),
            'email' => fake()->unique()->companyEmail(),
        ];
    }
}
