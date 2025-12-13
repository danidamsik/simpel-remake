<?php
namespace App\Livewire\Transaksi;

use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithPagination;

class FilterTable extends Component
{
    use WithPagination;

    public $selectedLembaga = '';
    public $selectedPeriod = '';
    public $search = '';

    #[Renderless]
    public function getExpenseDetail($id)
    {
        $expense = \App\Models\Expense::with([
            'organization.wallets',
            'activity.period'
        ])->find($id);
        
        if (!$expense) {
            return [
                'error' => true,
                'message' => 'Data transaksi tidak ditemukan'
            ];
        }

        $wallet = null;
        if ($expense->organization && $expense->activity && $expense->activity->period) {
            $wallet = $expense->organization->wallets()
                ->where('period_id', $expense->activity->period_id)
                ->first();
        }

        $taxValue = $expense->amount * (($expense->tax_persentase ?? 0) / 100);
        $total = $expense->amount + $taxValue;

        return [
            'error' => false,
            'id' => $expense->id,
            'organization_name' => $expense->organization->name,
            'lembaga_name' => $expense->organization->lembaga,
            'activity_name' => $expense->activity->name,
            'amount' => 'Rp ' . number_format($expense->amount, 0, ',', '.'),
            'amount_raw' => $expense->amount,
            'expense_date' => \Carbon\Carbon::parse($expense->expense_date)->translatedFormat('d F Y'),
            'tax_type' => $expense->tax_type ?? '-',
            'tax_persentase' => $expense->tax_persentase ? $expense->tax_persentase . '%' : '0%',
            'tax_value' => 'Rp ' . number_format($taxValue, 0, ',', '.'),
            'total' => 'Rp ' . number_format($total, 0, ',', '.'),
            'proof_file' => $expense->proof_file,
            'proof_file_url' => $expense->proof_file ? asset('storage/' . $expense->proof_file) : null,
            'description' => $expense->description ?? '-',
            'bank_name' => $wallet->bank_name ?? '-',
            'account_name' => $wallet->account_name ?? '-',
            'account_number' => $wallet->account_number ?? '-',
        ];
    }

    public function render()
    {
        $lembagas = \App\Models\Organization::select('lembaga')
            ->distinct()
            ->orderBy('lembaga')
            ->pluck('lembaga');
            
        $periods = \App\Models\Period::all();

        $expenses = \App\Models\Expense::with(['organization', 'activity.period'])
            ->when($this->selectedLembaga, function ($query) {
                $query->whereHas('organization', function ($q) {
                    $q->where('lembaga', $this->selectedLembaga);
                });
            })
            ->when($this->selectedPeriod, function ($query) {
                $query->whereHas('activity', function ($q) {
                    $q->where('period_id', $this->selectedPeriod);
                });
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('organization', function ($subQ) {
                        $subQ->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('activity', function ($subQ) {
                        $subQ->where('name', 'like', '%' . $this->search . '%');
                    });
                });
            })
            ->latest('expense_date')
            ->paginate(10);

        return view('livewire.transaksi.filter-table', [
            'lembagas' => $lembagas,
            'periods' => $periods,
            'expenses' => $expenses
        ]);
    }
}