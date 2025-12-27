<?php

namespace App\Livewire\Dashboard;

use App\Models\Period;
use App\Models\Expense;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ChartPengeluaranBulan extends Component
{
    public $seriesData;
    public $periodId;

    public function mount()
    {
        $activePeriod = Period::where('status', true)->first();
        $this->periodId = $activePeriod?->id ?? Period::first()?->id;
        $this->seriesData = $this->pengeluaranPerBulan();
    }

    public function pengeluaranPerBulan(): array
    {
        $results = Expense::select(
            DB::raw('MONTH(expense_date) as bulan'),
            DB::raw('SUM(amount) as total')
        )
            ->whereHas('activity', function ($query) {
                $query->where('period_id', $this->periodId);
            })
            ->groupBy(DB::raw('MONTH(expense_date)'))
            ->pluck('total', 'bulan')
            ->toArray();

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = isset($results[$i]) ? (float) $results[$i] : 0;
        }

        return $data;
    }

    public function render()
    {
        return view('livewire.dashboard.chart-pengeluaran-bulan');
    }
}
