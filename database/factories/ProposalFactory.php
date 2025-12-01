<?php

namespace Database\Factories;

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
            'proposal_file' => 'proposal_' . fake()->uuid() . '.pdf',
            'funds_approved' => fake()->randomFloat(2, 1000000, 1000000),
            'date_received' => fake()->dateTimeBetween('-90 days', 'now')->format('Y-m-d'),
        ];
    }
}
