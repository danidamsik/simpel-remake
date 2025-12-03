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
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        User::factory()->admin()->create([
            'username' => 'AdminUtama',
            'email' => 'admin@example.com',
        ]);

        $Period = Period::factory()->create();

        $bendahara = User::factory()->bendahara()->count(12)->create();

        foreach ($bendahara as $user) {
            Organization::factory()->create([
                'user_id' => $user->id,
            ]);
        }

        $organisasi = Organization::all();

        foreach ($organisasi as $org) {
            
            Wallet::factory()->create([
                'organization_id' => $org->id,
            ]);

            for ($i = 0; $i < 5; $i++) {
                Proposal::factory()->create([
                    'organization_id' => $org->id
                ]);
            }
        }

        $proposal = Proposal::all();

        foreach ($proposal as $propos) {
            $Activity = Activity::factory()->create([
                'organization_id' => $propos->organization_id,
                'proposal_id' => $propos->id,
                'period_id' => $Period->id
            ]);

            Lpj::factory()->create([
                'activity_id' => $Activity->id,
                'organization_id' => $propos->organization_id
            ]);
        }

        foreach ($organisasi as $org) {
            foreach ($org->activities as $activity) {
                Expense::factory()->count(2)->create([
                    'organization_id' => $org->id,
                    'activity_id' => $activity->id
                ]);

                ReminderLog::factory()->count(2)->create([
                    'activity_id' => $activity->id
                ]);
            }
        }
    }
}
