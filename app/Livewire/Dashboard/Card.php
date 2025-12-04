<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Proposal;
use App\Models\Activity;
use App\Models\Lpj;
use App\Models\Expense;
use App\Models\Period;

class Card extends Component
{
    public $selectedPeriodId;
    public $periods, $totalProposals, $totalRunningActivities, $lpjApproved, $lpjPending, $totalExpenses, $totalTax;

    public function mount()
    {
        $activePeriod = Period::where('status', true)->first();
        $this->selectedPeriodId = $activePeriod?->id ?? Period::first()?->id;
        $this->loadData();
    }

    public function updatedSelectedPeriodId()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->periods = Period::orderBy('start_date', 'desc')->get();

        $this->totalProposals = Proposal::whereHas(
            'activity',
            fn($q) =>
            $q->where('period_id', $this->selectedPeriodId)
        )->count();

        $this->totalRunningActivities = Activity::where('period_id', $this->selectedPeriodId)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->count();

        $this->lpjApproved = Lpj::whereHas(
            'activity',
            fn($q) =>
            $q->where('period_id', $this->selectedPeriodId)
        )->where('status', 'Disetujui')->count();

        $this->lpjPending = Lpj::whereHas(
            'activity',
            fn($q) =>
            $q->where('period_id', $this->selectedPeriodId)
        )->where('status', 'Belum Disetor')->count();

        $this->totalExpenses = Expense::whereHas(
            'activity',
            fn($q) =>
            $q->where('period_id', $this->selectedPeriodId)
        )->sum('amount');

        $this->totalTax = Expense::whereHas(
            'activity',
            fn($q) =>
            $q->where('period_id', $this->selectedPeriodId)
        )->get()->sum(
            fn($expense) =>
            $expense->amount * ($expense->tax_persentase / 100)
        );
    }

    public function formatCurrency($value)
    {
        $abs = abs($value);

        if ($abs >= 1000000000) {
            $formatted = round($value / 1000000000, 1);
            return 'Rp ' . rtrim(rtrim(number_format($formatted, 1, ',', '.'), '0'), ',') . ' M';
        } elseif ($abs >= 1000000) {
            $formatted = round($value / 1000000, 1);
            return 'Rp ' . rtrim(rtrim(number_format($formatted, 1, ',', '.'), '0'), ',') . ' Jt';
        } elseif ($abs >= 1000) {
            $formatted = round($value / 1000, 1);
            return 'Rp ' . rtrim(rtrim(number_format($formatted, 1, ',', '.'), '0'), ',') . ' Rb';
        } elseif ($abs >= 100) {
            $formatted = round($value / 100, 1);
            return 'Rp ' . rtrim(rtrim(number_format($formatted, 1, ',', '.'), '0'), ',') . ' Rh';
        } else {
            return 'Rp ' . number_format($value, 0, ',', '.');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.card');
    }
}
