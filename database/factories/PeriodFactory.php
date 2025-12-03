<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Trunc;

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
        return [
            'name' => "Periode 2025",
            'start_date' => "2025-01-01",
            'end_date'   => "2025-12-31",
            'status' => true, 
        ];
    }
}