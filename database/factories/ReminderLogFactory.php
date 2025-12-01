<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReminderLog>
 */
class ReminderLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => fake()->numerify('08##########'),
            'message' => $this->faker->randomElement([
                'Mohon segera mengumpulkan LPJ kegiatan sebelum batas waktu.',
                'Pengingat kedua: LPJ kegiatan belum diterima. Mohon diselesaikan.',
                'Pengingat terakhir: Harap segera menyerahkan LPJ untuk proses pencairan dana berikutnya.',
                'LPJ kegiatan belum diunggah. Silakan upload melalui sistem.',
                'Harap segera melengkapi administrasi LPJ kegiatan.',
            ]),
        ];
    }
}
