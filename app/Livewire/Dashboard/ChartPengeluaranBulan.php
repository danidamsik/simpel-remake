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
        return Expense::select(
            DB::raw('MONTH(expense_date) as bulan'),
            DB::raw('SUM(amount) as total')
        )
            ->whereHas('activity', function ($query) {
                $query->where('period_id', $this->periodId);
            })
            ->groupBy(DB::raw('MONTH(expense_date)'))
            ->orderBy(DB::raw('MONTH(expense_date)'))
            ->pluck('total')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard.chart-pengeluaran-bulan');
    }
}
