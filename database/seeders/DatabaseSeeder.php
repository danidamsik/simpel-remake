<?php

namespace Database\Seeders;

use App\Models\Lpj;
use App\Models\User;
use App\Models\Period;
use App\Models\Wallet;
use App\Models\Expense;
use App\Models\Activity;
use App\Models\Proposal;
use App\Models\ReminderLog;
use App\Models\Organization;
use App\Models\OrganizationUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create([
            'username' => 'AdminUtama',
            'email' => 'admin@example.com',
            'role' => 'Admin'
        ]);

        $period1 = Period::factory()->create([
            'name' => 'Periode Ganjil 2024',
            'start_date' => '2024-01-01',
            'end_date' => '2024-06-30',
            'status' => false,
        ]);

        $period2 = Period::factory()->create([
            'name' => 'Periode Genap 2024',
            'start_date' => '2024-07-01',
            'end_date' => '2024-12-31',
            'status' => true,
        ]);

        $periods = [$period1, $period2];

        $organizationNames = [
            // Fakultas Sains & Teknologi (10)
            ['name' => 'Himpunan Mahasiswa Informatika', 'lembaga' => 'Fakultas Sains & Teknologi'],
            ['name' => 'Himpunan Mahasiswa Sistem Informasi', 'lembaga' => 'Fakultas Sains & Teknologi'],
            ['name' => 'Himpunan Mahasiswa Teknik Arsitektur', 'lembaga' => 'Fakultas Sains & Teknologi'],
            ['name' => 'Himpunan Mahasiswa Matematika', 'lembaga' => 'Fakultas Sains & Teknologi'],
            ['name' => 'Himpunan Mahasiswa Biologi', 'lembaga' => 'Fakultas Sains & Teknologi'],
            ['name' => 'Himpunan Mahasiswa Fisika', 'lembaga' => 'Fakultas Sains & Teknologi'],
            ['name' => 'Himpunan Mahasiswa Kimia', 'lembaga' => 'Fakultas Sains & Teknologi'],
            ['name' => 'Club Robotika UIN', 'lembaga' => 'Fakultas Sains & Teknologi'],
            ['name' => 'Komunitas Data Science', 'lembaga' => 'Fakultas Sains & Teknologi'],
            ['name' => 'BEM Fakultas Sains & Teknologi', 'lembaga' => 'Fakultas Sains & Teknologi'],

            // Fakultas Tarbiyah (10)
            ['name' => 'Himpunan Mahasiswa PAI', 'lembaga' => 'Fakultas Tarbiyah'],
            ['name' => 'Himpunan Mahasiswa PBA', 'lembaga' => 'Fakultas Tarbiyah'],
            ['name' => 'Himpunan Mahasiswa TBI', 'lembaga' => 'Fakultas Tarbiyah'],
            ['name' => 'Himpunan Mahasiswa PGMI', 'lembaga' => 'Fakultas Tarbiyah'],
            ['name' => 'Himpunan Mahasiswa PIAUD', 'lembaga' => 'Fakultas Tarbiyah'],
            ['name' => 'Himpunan Mahasiswa Manajemen Pendidikan', 'lembaga' => 'Fakultas Tarbiyah'],
            ['name' => 'Sanggar Seni Tarbiyah', 'lembaga' => 'Fakultas Tarbiyah'],
            ['name' => 'Club Debat Tarbiyah', 'lembaga' => 'Fakultas Tarbiyah'],
            ['name' => 'Pramuka Racana Tarbiyah', 'lembaga' => 'Fakultas Tarbiyah'],
            ['name' => 'BEM Fakultas Tarbiyah', 'lembaga' => 'Fakultas Tarbiyah'],

            // Fakultas Syariah (10)
            ['name' => 'Himpunan Mahasiswa Hukum Ekonomi Syariah', 'lembaga' => 'Fakultas Syariah'],
            ['name' => 'Himpunan Mahasiswa Hukum Keluarga Islam', 'lembaga' => 'Fakultas Syariah'],
            ['name' => 'Himpunan Mahasiswa Hukum Tata Negara', 'lembaga' => 'Fakultas Syariah'],
            ['name' => 'Himpunan Mahasiswa Perbandingan Mazhab', 'lembaga' => 'Fakultas Syariah'],
            ['name' => 'Himpunan Mahasiswa Ilmu Hukum', 'lembaga' => 'Fakultas Syariah'],
            ['name' => 'Lembaga Kajian Hukum Islam', 'lembaga' => 'Fakultas Syariah'],
            ['name' => 'Komunitas Peradilan Semu', 'lembaga' => 'Fakultas Syariah'],
            ['name' => 'Pusat Bantuan Hukum Mahasiswa', 'lembaga' => 'Fakultas Syariah'],
            ['name' => 'Forum Diskusi Syariah', 'lembaga' => 'Fakultas Syariah'],
            ['name' => 'BEM Fakultas Syariah', 'lembaga' => 'Fakultas Syariah'],

            // Fakultas Ushuluddin (10)
            ['name' => 'Himpunan Mahasiswa Ilmu Al-Quran dan Tafsir', 'lembaga' => 'Fakultas Ushuluddin'],
            ['name' => 'Himpunan Mahasiswa Hadis', 'lembaga' => 'Fakultas Ushuluddin'],
            ['name' => 'Himpunan Mahasiswa Aqidah Filsafat', 'lembaga' => 'Fakultas Ushuluddin'],
            ['name' => 'Himpunan Mahasiswa Studi Agama-Agama', 'lembaga' => 'Fakultas Ushuluddin'],
            ['name' => 'Himpunan Mahasiswa Tasawuf Psikoterapi', 'lembaga' => 'Fakultas Ushuluddin'],
            ['name' => 'Komunitas Kajian Filsafat', 'lembaga' => 'Fakultas Ushuluddin'],
            ['name' => 'Club Tahfidz Ushuluddin', 'lembaga' => 'Fakultas Ushuluddin'],
            ['name' => 'Sanggar Kaligrafi Ushuluddin', 'lembaga' => 'Fakultas Ushuluddin'],
            ['name' => 'Forum Kajian Kitab Kuning', 'lembaga' => 'Fakultas Ushuluddin'],
            ['name' => 'BEM Fakultas Ushuluddin', 'lembaga' => 'Fakultas Ushuluddin'],

            // Fakultas Ekonomi & Bisnis Islam (10)
            ['name' => 'Himpunan Mahasiswa Perbankan Syariah', 'lembaga' => 'Fakultas Ekonomi & Bisnis Islam'],
            ['name' => 'Himpunan Mahasiswa Ekonomi Syariah', 'lembaga' => 'Fakultas Ekonomi & Bisnis Islam'],
            ['name' => 'Himpunan Mahasiswa Akuntansi Syariah', 'lembaga' => 'Fakultas Ekonomi & Bisnis Islam'],
            ['name' => 'Himpunan Mahasiswa Manajemen Syariah', 'lembaga' => 'Fakultas Ekonomi & Bisnis Islam'],
            ['name' => 'Himpunan Mahasiswa Pariwisata Syariah', 'lembaga' => 'Fakultas Ekonomi & Bisnis Islam'],
            ['name' => 'Galeri Investasi Syariah', 'lembaga' => 'Fakultas Ekonomi & Bisnis Islam'],
            ['name' => 'Kelompok Studi Ekonomi Islam', 'lembaga' => 'Fakultas Ekonomi & Bisnis Islam'],
            ['name' => 'Inkubator Bisnis Mahasiswa', 'lembaga' => 'Fakultas Ekonomi & Bisnis Islam'],
            ['name' => 'Forum Kewirausahaan Mahasiswa', 'lembaga' => 'Fakultas Ekonomi & Bisnis Islam'],
            ['name' => 'BEM Fakultas Ekonomi & Bisnis Islam', 'lembaga' => 'Fakultas Ekonomi & Bisnis Islam'],
        ];

        foreach ($organizationNames as $orgData) {
            Organization::factory()->create([
                'name' => $orgData['name'],
                'lembaga' => $orgData['lembaga'],
            ]);
        }

        $organizations = Organization::all();

        foreach ($periods as $periodIndex => $period) {
            
            $bendaharaNames = [
                // 1-10
                'Ahmad Fadli', 'Siti Aisyah', 'Muhammad Rizki', 'Nurul Hidayah', 'Rizky Maulana',
                'Putri Lestari', 'Dewi Kartika', 'Budi Santoso', 'Agus Pratama', 'Fajar Ramadhan',
                // 11-20
                'Intan Permata', 'Rina Oktaviani', 'Hendra Wijaya', 'Dian Pratiwi', 'Aditya Saputra',
                'Nanda Febriani', 'Eko Prasetyo', 'Ratna Sari', 'Joko Susilo', 'Wulan Dari',
                // 21-30
                'Bambang Suryadi', 'Sari Indah', 'Yudi Hartono', 'Fitriani Nur', 'Bayu Nugraha',
                'Nina Marlina', 'Dedi Kurniawan', 'Lia Anggraini', 'Rudi Hartono', 'Tia Maharani',
                // 31-40
                'Iwan Setiawan', 'Maya Puspita', 'Reza Pahlevi', 'Indah Permatasari', 'Doni Saputra',
                'Vina Melati', 'Ari Wibowo', 'Desi Ratnasari', 'Gilang Ramadhan', 'Citra Kirana',
                // 41-50
                'Dimas Anggara', 'Bella Saphira', 'Ferry Irawan', 'Gita Gutawa', 'Hari Panca',
                'Ika Putri', 'Jaka Tarub', 'Kartika Putri', 'Lukman Sardi', 'Melly Goeslaw',
                // 51-60
                'Taufik Hidayat', 'Susi Susanti', 'Alan Budikusuma', 'Chris John', 'Bambang Pamungkas',
                'Evan Dimas', 'Liliana Natsir', 'Tontowi Ahmad', 'Greysia Polii', 'Apriyani Rahayu',
                // 61-70
                'Markus Gideon', 'Kevin Sanjaya', 'Anthony Ginting', 'Jonatan Christie', 'Hendra Setiawan',
                'Mohammad Ahsan', 'Fajar Alfian', 'Rian Ardianto', 'Gregoria Mariska', 'Windy Cantika',
                // 71-80
                'Eko Yuli', 'Triyatno', 'Lisa Rumbewas', 'Daud Yordan', 'Ellyas Pical',
                'Ade Rai', 'Rochy Putiray', 'Boaz Solossa', 'Andik Vermansah', 'Egy Maulana',
                // 81-90
                'Witan Sulaeman', 'Asnawi Mangkualam', 'Pratama Arhan', 'Nadeo Argawinata', 'Ricky Kambuaya',
                'Rachmat Irianto', 'Syahrian Abimanyu', 'Dedik Setiawan', 'Kurnia Meiga', 'Stefano Lilipaly',
                // 91-100
                'Irfan Bachdim', 'Kim Kurniawan', 'Cristian Gonzales', 'Beto Goncalves', 'Marc Klok',
                'Ilija Spasojevic', 'Otavio Dutra', 'Victor Igbonefo', 'Greg Nwokolo', 'Bio Paulin'
            ];

            // Ambil 50 nama berdasarkan periodIndex (0 = nama 0-49, 1 = nama 50-99)
            $namesForThisPeriod = array_slice($bendaharaNames, $periodIndex * 50, 50);

            $bendaharaUsers = collect();
            foreach ($namesForThisPeriod as $name) {
                $bendaharaUsers->push(
                    User::factory()->bendahara()->create(['username' => $name])
                );
            }

            foreach ($organizations as $orgIndex => $org) {
                
                $wallet = Wallet::factory()->create([
                    'period_id' => $period->id,
                    'account_name' => $bendaharaUsers[$orgIndex]->username,
                ]);

                OrganizationUser::create([
                    'organization_id' => $org->id,
                    'user_id' => $bendaharaUsers[$orgIndex]->id,
                    'wallet_id' => $wallet->id,
                ]);

                $proposalCount = $periodIndex == 0 ? 3 : 4;
                
                for ($i = 0; $i < $proposalCount; $i++) {
                    $proposal = Proposal::factory()->create([
                        'organization_id' => $org->id,
                    ]);

                    $activity = Activity::factory()->create([
                        'organization_id' => $org->id,
                        'proposal_id' => $proposal->id,
                        'period_id' => $period->id,
                        'name' => 'Kegiatan ' . ($i + 1) . ' - ' . $org->name,
                    ]);

                    Lpj::factory()->create([
                        'activity_id' => $activity->id,
                        'organization_id' => $org->id,
                    ]);

                    $expenseCount = $periodIndex == 0 ? 2 : 3;
                    Expense::factory()->count($expenseCount)->create([
                        'organization_id' => $org->id,
                        'activity_id' => $activity->id,
                    ]);

                    ReminderLog::factory()->count(2)->create([
                        'activity_id' => $activity->id,
                    ]);
                }
            }
        }

        // --- Create Late Activities for Testing ---
        $activePeriodIds = collect($periods)->where('status', true)->pluck('id');
        
        $lateActivities = Activity::whereIn('period_id', $activePeriodIds)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        foreach ($lateActivities as $activity) {
            $endDate = now()->subDays(rand(8, 14)); // 1-2 weeks ago
            $startDate = (clone $endDate)->subDays(3);

            $activity->update([
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);

            // Ensure LPJ is 'Belum Disetor'
            if ($activity->lpj) {
                $activity->lpj->update(['status' => 'Belum Disetor']);
            }
        }
    }
}
