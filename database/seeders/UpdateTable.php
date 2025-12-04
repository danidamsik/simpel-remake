<?php

namespace Database\Seeders;
use Carbon\Carbon;
use App\Models\Activity;
use Illuminate\Database\Seeder;

class UpdateTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = Activity::all()->take(10);

        foreach ($activities as $activity) {
            $activity->update([
                'end_date' => Carbon::now()->subWeeks(3), 
            ]);
        }

        $this->command->info('✅ 5 kegiatan berhasil di-update menjadi selesai > 2 minggu lalu.');
    }
}
