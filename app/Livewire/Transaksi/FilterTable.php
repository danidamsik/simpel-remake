<?php
namespace App\Livewire\Transaksi;

use App\Models\Activity;
use App\Models\Expense;
use App\Models\Organization;
use App\Models\Period;
use App\Models\Wallet;
use Carbon\Carbon;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class FilterTable extends Component
{
    use WithPagination, WithFileUploads;

    const TAX_RATES = [
        'PPh22' => 1.5,
        'PPh23' => 2,
        'Ppn' => 12,
    ];

    public $selectedLembaga = '';
    public $selectedPeriod = '';
    public $search = '';

    public $showAddModal = false;
    public $selectedActivity = null;
    public $selectedWallet = null;
    
    public function selectActivity($activity)
    {
        $this->selectedActivity = $activity;
        
        if ($activity && isset($activity['id'])) {
            $activityModel = Activity::find($activity['id']);
            if ($activityModel) {
                $wallet = Wallet::join('organization_users', 'organization_users.wallet_id', '=', 'wallets.id')
                    ->where('organization_users.organization_id', $activityModel->organization_id)
                    ->where('wallets.period_id', $activityModel->period_id)
                    ->select('wallets.*')
                    ->first();
                
                $this->selectedWallet = $wallet ? $wallet->toArray() : null;
            }
        } else {
            $this->selectedWallet = null;
        }
    }

    public function clearSelectedActivity()
    {
        $this->selectedActivity = null;
        $this->selectedWallet = null;
    }
    
    public $amount = '';
    public $description = '';
    public $expenseDate = '';
    public $taxType = 'PPh22';
    public $taxPersentase = 0;
    public $proofFile = null;

    protected $rules = [
        'selectedActivity' => 'required',
        'amount' => 'required|numeric|min:1',
        'expenseDate' => 'required|date',
        'taxType' => 'required|in:PPh22,PPh23,Ppn',
        'taxPersentase' => 'nullable|numeric|min:0|max:100',
        'proofFile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
    ];

    protected $messages = [
        'selectedActivity.required' => 'Pilih kegiatan terlebih dahulu.',
        'amount.required' => 'Jumlah wajib diisi.',
        'amount.numeric' => 'Jumlah harus berupa angka.',
        'amount.min' => 'Jumlah minimal 1.',
        'expenseDate.required' => 'Tanggal pengeluaran wajib diisi.',
        'expenseDate.date' => 'Format tanggal tidak valid.',
        'taxType.required' => 'Jenis pajak wajib dipilih.',
        'proofFile.mimes' => 'File harus berformat JPG, PNG, atau PDF.',
        'proofFile.max' => 'Ukuran file maksimal 5MB.',
    ];

    #[Renderless]
    public function searchActivities($search)
    {
        if (strlen($search) < 2) {
            return [];
        }

        $today = Carbon::today();
        
        return Activity::with(['organization:id,name,lembaga', 'period:id,name'])
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->whereHas('period', function ($query) {
                $query->where('status', true);
            })
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('organization', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->limit(10)
            ->get()
            ->toArray();
    }

    public function saveExpense()
    {
        $this->validate();

        if (!$this->selectedActivity) {
            $this->dispatch('notify', message: 'Pilih kegiatan terlebih dahulu.', type: 'error');
            return;
        }

        $activity = Activity::find($this->selectedActivity['id']);
        
        if (!$activity) {
            $this->dispatch('notify', message: 'Kegiatan tidak ditemukan.', type: 'error');
            return;
        }

        $wallet = Wallet::join('organization_users', 'organization_users.wallet_id', '=', 'wallets.id')
            ->where('organization_users.organization_id', $activity->organization_id)
            ->where('wallets.period_id', $activity->period_id)
            ->select('wallets.*')
            ->first();

        if (!$wallet) {
            $this->dispatch('notify', message: 'Wallet untuk organisasi ini belum tersedia.', type: 'error');
            return;
        }

        $expenseAmount = (float) $this->amount;

        if ($wallet->balance < $expenseAmount) {
            $this->dispatch('notify', message: 'Saldo tidak mencukupi. Saldo tersedia: Rp ' . number_format($wallet->balance, 0, ',', '.'), type: 'error');
            return;
        }

        $proofFilePath = null;
        if ($this->proofFile) {
            $proofFilePath = $this->proofFile->store('expenses', 'public');
        }

        Expense::create([
            'organization_id' => $activity->organization_id,
            'activity_id' => $activity->id,
            'amount' => $expenseAmount,
            'description' => $this->description,
            'expense_date' => $this->expenseDate,
            'tax_type' => $this->taxType,
            'tax_persentase' => self::TAX_RATES[$this->taxType] ?? 0,
            'proof_file' => $proofFilePath,
        ]);

        $wallet->decrement('balance', $expenseAmount);
        $this->showAddModal = false;
        
        $this->dispatch('notify', message: 'Transaksi berhasil ditambahkan', type: 'success');
    }

    #[Renderless]
    public function getExpenseDetail($id)
    {
        $expense = Expense::with([
            'organization',
            'activity.period'
        ])->find($id);
        
        if (!$expense) {
            return [
                'error' => true,
                'message' => 'Data transaksi tidak ditemukan'
            ];
        }

        $wallet = null;
        if ($expense->activity && $expense->activity->period) {
            $wallet = Wallet::join('organization_users', 'organization_users.wallet_id', '=', 'wallets.id')
                ->where('organization_users.organization_id', $expense->organization_id)
                ->where('wallets.period_id', $expense->activity->period_id)
                ->select('wallets.*')
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
            'expense_date' => Carbon::parse($expense->expense_date)->translatedFormat('d F Y'),
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
        $lembagas = Organization::select('lembaga')
            ->distinct()
            ->orderBy('lembaga')
            ->pluck('lembaga');
            
        $periods = Period::all();

        $expenses = Expense::with(['organization', 'activity.period'])
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