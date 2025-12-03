<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Period;

class DashboardTest extends TestCase
{
    /** @test */
    public function dashboard_card_can_load_data_from_real_database()
    {
        $activePeriod = Period::where('status', true)->first();

        $this->assertNotNull(
            $activePeriod,
            'Tidak ada period aktif (status = true) di database.'
        );

        Livewire::test(\App\Livewire\Dashboard\Card::class)
            ->set('selectedPeriodId', $activePeriod->id)
            ->call('loadData')
            ->assertSet('selectedPeriodId', $activePeriod->id)

            ->assertSet('totalProposals', fn ($v) => is_int($v))
            ->assertSet('totalRunningActivities', fn ($v) => is_int($v))
            ->assertSet('lpjApproved', fn ($v) => is_int($v))
            ->assertSet('lpjPending', fn ($v) => is_int($v))

            ->assertSet('totalExpenses', fn ($v) => is_numeric($v))
            ->assertSet('totalTax', fn ($v) => is_numeric($v))
            ->assertSet('periods', fn ($v) => count($v) >= 1);
    }
}
