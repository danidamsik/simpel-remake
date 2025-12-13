<?php

namespace App\Livewire\Transaksi;

use App\Models\Expense;
use App\Models\Period;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Card extends Component
{
    public function render()
    {
        $activePeriod = Period::where('status', true)->first();
        $periodId = $activePeriod ? $activePeriod->id : null;

        $totalExpenses = Expense::whereHas('activity', function ($query) use ($periodId) {
            $query->where('period_id', $periodId);
        })->sum('amount');

        $totalTax = Expense::whereHas('activity', function ($query) use ($periodId) {
            $query->where('period_id', $periodId);
        })->sum(DB::raw('amount * (tax_persentase / 100)'));

        $remainingBalance = Wallet::where('period_id', $periodId)->sum('balance');

        $totalBudget = $remainingBalance + $totalExpenses;

        return view('livewire.transaksi.card', [
            'totalExpenses' => $totalExpenses,
            'totalTax' => $totalTax,
            'remainingBalance' => $remainingBalance,
            'totalBudget' => $totalBudget,
        ]);
    }
}
