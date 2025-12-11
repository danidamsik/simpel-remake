<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DaftarLpjTerlambat extends Component
{
    public function render()
    {
        $lpjTerlambat = Activity::query()
            ->join('lpj', 'activities.id', '=', 'lpj.activity_id')
            ->join('organizations', 'activities.organization_id', '=', 'organizations.id')
            ->join('periods', 'activities.period_id', '=', 'periods.id')
            ->where('periods.status', true)
            ->where('activities.end_date', '<=', Carbon::now()->subDays(7))
            ->where('lpj.status', 'Belum Disetor')
            ->select(
                'organizations.name',
                'organizations.lembaga',
                'activities.name as activity_name',
                'activities.end_date',
                DB::raw("DATE_ADD(activities.end_date, INTERVAL 7 DAY) as deadline")
            )
            ->orderBy('activities.end_date', 'asc')
            ->get();

        return view('livewire.dashboard.daftar-lpj-terlambat', [
            'lpjTerlambat' => $lpjTerlambat,
        ]);
    }
}
