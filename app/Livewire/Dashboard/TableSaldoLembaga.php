<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Organization;

class TableSaldoLembaga extends Component
{
    public function getDatalembaga()
    {
        Return Organization::with([
            'wallets',
            'activities' => function ($query) {
                $query->whereHas('period', function ($periodQuery) {
                    $periodQuery->where('status', true);
                })->with(['lpj', 'expenses']);
            }
        ])->get()
            ->map(function ($org) {
                return [
                    'organization_name' => $org->name,
                    'total_funds_used' => $org->activities->sum(function ($activity) {
                        return $activity->expenses->sum('amount');
                    }),
                    'current_balance' => $org->wallets->sum('balance'),
                    'activities' => $org->activities->map(function ($activity) {
                        return [
                            'activity_name' => $activity->name,
                            'start_date' => $activity->start_date,
                            'end_date' => $activity->end_date,
                            'location' => $activity->location,
                            'funds_used' => $activity->expenses->sum('amount'),
                            'lpj_status' => $activity->lpj->status
                        ];
                    })
                ];
            });
    }

    public function render()
    {
        return view('livewire.dashboard.table-saldo-lembaga', [
            'dataLembaga' => $this->getDatalembaga()
        ]);
    }
}
