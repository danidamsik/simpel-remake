<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->numberBetween(50000, 15000000), // 50 ribu s/d 15 juta
            'description' => $this->faker->randomElement([
                'Pembelian ATK untuk kegiatan organisasi',
                'Biaya konsumsi rapat persiapan acara',
                'Sewa sound system untuk seminar',
                'Pembelian spanduk dan banner kegiatan',
                'Biaya transportasi panitia',
                'Honor pemateri acara',
            ]),
            'expense_date' => $this->faker->dateTimeBetween(
                now()->startOfYear(),
                now()->endOfYear()
            ),
            'tax_persentase' => $this->faker->randomElement([0, 5, 10, 11]), // PPN 11%, PPh 5% dst
            'tax_type' => $this->faker->randomElement([
                'PPh22',
                'PPh23',
                'Ppn'
            ]),
            'proof_file' => 'proof/' . $this->faker->uuid() . '.jpg',
        ];
    }
}
