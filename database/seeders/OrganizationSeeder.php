<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class OrganizationSeeder extends Seeder
{
    /**
     * Mapping nama folder dari storage ke nilai enum lembaga di database.
     */
    private array $lembagaMapping = [
        'Fakultas Sains Dan teknologi' => 'Fakultas Sains & Teknologi',
        'Fakultas Tarbiyah Dan Ilmu Keguruan' => 'Fakultas Tarbiyah dan Ilmu Keguruan',
        'Fakultas Syariah' => 'Fakultas Syariah',
        'Fakultas Ushuludin Adab Dan dakwah' => 'Fakultas Ushuluddin adab dan dakwah',
        'Fakultas Ekonomi Dan bisnis Islam' => 'Fakultas Ekonomi & Bisnis Islam',
        'Fakultas Dakwah dan komunikasi islam' => 'Fakultas dakwah dan Komunikasi islam',
        'Universitas' => 'Universitas',
    ];

    public function run(): void
    {
        $basePath = storage_path('app/public/logo-organisasi');

        // Dapatkan semua folder (lembaga)
        $folders = File::directories($basePath);

        foreach ($folders as $folderPath) {
            $folderName = basename($folderPath);
            
            // Map nama folder ke nilai enum lembaga
            $lembaga = $this->lembagaMapping[$folderName] ?? null;
            
            if (!$lembaga) {
                $this->command->warn("Folder '{$folderName}' tidak memiliki mapping lembaga. Dilewati.");
                continue;
            }

            // Dapatkan semua file dalam folder
            $files = File::files($folderPath);

            foreach ($files as $file) {
                $fileName = $file->getFilename();
                // Hapus ekstensi file untuk mendapatkan nama organisasi
                $organizationName = pathinfo($fileName, PATHINFO_FILENAME);
                
                // Path relatif untuk disimpan di database
                $logoPath = 'logo-organisasi/' . $folderName . '/' . $fileName;

                // Cek apakah organisasi sudah ada
                $existingOrg = Organization::where('name', $organizationName)
                    ->where('lembaga', $lembaga)
                    ->first();

                if ($existingOrg) {
                    $this->command->info("Organisasi '{$organizationName}' sudah ada. Dilewati.");
                    continue;
                }

                // Buat organisasi baru
                Organization::create([
                    'name' => $organizationName,
                    'lembaga' => $lembaga,
                    'logo_path' => $logoPath,
                ]);

                $this->command->info("Created: {$organizationName} ({$lembaga})");
            }
        }

        $this->command->info('Selesai! Total organisasi: ' . Organization::count());
    }
}
