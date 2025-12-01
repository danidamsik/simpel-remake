<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $kegiatan = [
            'Seminar Nasional',
            'Workshop IT',
            'Pelatihan Kepemimpinan',
            'Kuliah Umum',
            'Rapat Kerja',
            'Musyawarah Besar',
            'Study Club',
            'Bakti Sosial',
            'Pelatihan Jurnalistik',
            'Lomba Debat',
            'Turnamen Futsal',
            'Pengabdian Masyarakat',
            'Pelatihan Organisasi',
            'Pelatihan Desain Grafis',
            'Pelatihan Kewirausahaan',
            'Expo UKM',
            'Seminar Anti-Narkoba',
            'Workshop Robotik',
            'Lomba Cerdas Cermat',
            'Pelatihan Public Speaking',
        ];

        $kampusLocations = [
            'Aula Utama',
            'Lapangan Upacara',
            'Gedung Rektorat',
            'Laboratorium Komputer',
            'Perpustakaan Pusat',
            'Ruang Seminar Lantai 2',
            'Masjid Kampus',
            'Auditorium Fakultas',
            'Ruang Himpunan Mahasiswa',
            'Gedung Serbaguna (GSG)',
            'Ruang Kelas B-203',
        ];

        $descriptions = [
            'Kegiatan ini bertujuan untuk meningkatkan kemampuan mahasiswa dalam bidang akademik dan organisasi.',
            'Acara ini merupakan bagian dari program kerja himpunan mahasiswa untuk meningkatkan solidaritas.',
            'Kegiatan rutin yang diadakan setiap semester untuk meningkatkan kreativitas mahasiswa.',
            'Sesi pelatihan yang ditujukan agar mahasiswa memahami perkembangan teknologi terbaru.',
            'Kegiatan ini diselenggarakan untuk mempersiapkan mahasiswa menghadapi kompetisi tingkat nasional.',
            'Program ini dilaksanakan sebagai bentuk pengabdian kepada masyarakat oleh mahasiswa.',
            'Forum diskusi antar mahasiswa dan dosen untuk membahas isu akademik terkini.',
        ];

        $namaIndonesia = [
            'Ahmad Fadli',
            'Siti Aisyah',
            'Muhammad Rizki',
            'Nurul Hidayah',
            'Rizky Maulana',
            'Putri Lestari',
            'Dewi Kartika',
            'Budi Santoso',
            'Agus Pratama',
            'Fajar Ramadhan',
            'Intan Permata',
            'Rina Oktaviani',
            'Hendra Wijaya',
            'Dian Pratiwi',
            'Aditya Saputra',
            'Nanda Febriani',
        ];

        return [
            'name' =>  fake()->randomElement($kegiatan),
            'start_date' => fake()->dateTimeBetween('-30 days', '+10 days')->format('Y-m-d'),
            'end_date' => fake()->dateTimeBetween('+11 days', '+40 days')->format('Y-m-d'),
            'location' => $this->faker->randomElement($kampusLocations),
            'description' => $this->faker->randomElement($descriptions),
            'person_responsible' => $this->faker->randomElement($namaIndonesia),
            'number_pr' => fake()->numerify('08##########')
        ];
    }
}
