<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $organisasi = [
            'Himpunan Mahasiswa Informatika',
            'Himpunan Mahasiswa Sistem Informasi',
            'Himpunan Mahasiswa Teknik Elektro',
            'Unit Kegiatan Mahasiswa Seni',
            'Unit Kegiatan Mahasiswa Olahraga',
            'BEM Fakultas Sains & Teknologi',
            'BEM Fakultas Tarbiyah',
            'BEM Fakultas Syariah',
            'BEM Fakultas Ushuluddin',
            'Komunitas Programming UIN Datokarama',
            'Komunitas Data Science UIN Datokarama',
            'Komunitas Cyber Security UIN Datokarama',
        ];

        $fakultas = [
            'Fakultas Sains & Teknologi',
            'Fakultas Tarbiyah',
            'Fakultas Syariah',
            'Fakultas Ushuluddin',
            'Fakultas Ekonomi & Bisnis Islam',
        ];

        return [
            'name' => fake()->unique()->randomElement($organisasi),
            'lembaga' => fake()->randomElement($fakultas),
            'number_phone' => fake()->numerify('08##########'),
            'email' => fake()->unique()->companyEmail(),
            'logo_path' => null,
        ];
    }
}
