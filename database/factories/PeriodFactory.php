<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Period>
 */
class PeriodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = $this->faker->numberBetween(2020, 2025);
        $nextYear = $year + 1;

        return [
            'name' => "Periode $year/$nextYear",
            'start_date' => "$year-01-01",
            'end_date'   => "$nextYear-01-01",
            'status' => $this->faker->boolean(80), // 80% aktif
        ];
    }
}
