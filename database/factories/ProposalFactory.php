<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proposal>
 */
class ProposalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->companyEmail(),
            'hours' => fake()->numberBetween(20, 500),
            'project_id' => Project::factory(),
            'created_at' => fake()->dateTimeBetween('-10 days', 'now'),
        ];
    }
}
