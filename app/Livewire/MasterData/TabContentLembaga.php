<?php

namespace App\Livewire\MasterData;

use App\Models\Organization;
use App\Models\OrganizationUser;
use App\Models\Period;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class TabContentLembaga extends Component
{
    use WithPagination, WithFileUploads;

    public $filterLembaga = '';
    public $filterPeriod = '';
    public $search = '';

    // Modal Properties
    public $showModal = false;

    // Form Organization Properties
    public $name;
    public $lembaga;
    public $number_phone;
    public $email;
    public $logo;

    // Form Bendahara Properties
    public $selectedUserId;

    // Form Wallet Properties
    public $bank_name;
    public $account_name;
    public $account_number;
    public $balance = 0;

    // Lembaga Types (enum values)
    public $lembagaOptions = [
        'Fakultas Sains & Teknologi',
        'Fakultas Tarbiyah',
        'Fakultas Syariah',
        'Fakultas Ushuluddin',
        'Fakultas Ekonomi & Bisnis Islam',
    ];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'lembaga' => 'required|in:' . implode(',', $this->lembagaOptions),
            'number_phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'logo' => 'nullable|image|max:2048',
            'selectedUserId' => 'required|exists:users,id',
            'bank_name' => 'nullable|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:50|unique:wallets,account_number',
            'balance' => 'required|numeric|min:0',
        ];
    }

    protected $messages = [
        'name.required' => 'Nama lembaga wajib diisi.',
        'lembaga.required' => 'Pilih fakultas/lembaga.',
        'number_phone.required' => 'Nomor telepon wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'selectedUserId.required' => 'Pilih bendahara.',
        'account_name.required' => 'Nama akun rekening wajib diisi.',
        'account_number.required' => 'Nomor rekening wajib diisi.',
        'account_number.unique' => 'Nomor rekening sudah terdaftar.',
        'balance.required' => 'Saldo awal wajib diisi.',
        'balance.min' => 'Saldo tidak boleh negatif.',
    ];

    public function updatingFilterLembaga()
    {
        $this->resetPage();
    }

    public function updatingFilterPeriod()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function store()
    {
        $this->validate();

        DB::transaction(function () {
            // 1. Simpan logo jika ada
            $logoPath = null;
            if ($this->logo) {
                $logoPath = $this->logo->store('profile', 'public');
            }

            // 2. Buat Organization
            $organization = Organization::create([
                'name' => $this->name,
                'lembaga' => $this->lembaga,
                'number_phone' => $this->number_phone,
                'email' => $this->email,
                'logo_path' => $logoPath,
            ]);

            // 3. Ambil periode aktif
            $activePeriod = Period::where('status', true)->first();
            if (!$activePeriod) {
                $activePeriod = Period::latest()->first();
            }

            // 4. Buat Wallet
            $wallet = Wallet::create([
                'period_id' => $activePeriod->id,
                'bank_name' => $this->bank_name,
                'account_name' => $this->account_name,
                'account_number' => $this->account_number,
                'balance' => $this->balance,
            ]);

            // 5. Buat OrganizationUser (pivot)
            OrganizationUser::create([
                'organization_id' => $organization->id,
                'user_id' => $this->selectedUserId,
                'wallet_id' => $wallet->id,
            ]);
        });

        $this->showModal = false;
        $this->resetForm();
        $this->dispatch('notify', message: 'Lembaga berhasil ditambahkan!', type: 'success');
    }

    public function resetForm()
    {
        $this->reset([
            'name', 'lembaga', 'number_phone', 'email', 'logo',
            'selectedUserId', 'bank_name', 'account_name', 'account_number', 'balance'
        ]);
        $this->balance = 0;
        $this->resetErrorBag();
    }

    public function render()
    {
        $query = Organization::with(['organizationUsers.user:id,username'])
            ->select('id', 'logo_path', 'name', 'lembaga', 'number_phone', 'email');

        if ($this->filterPeriod) {
            $query->with([
                'organizationUsers.wallet' => function ($q) {
                    $q->where('period_id', $this->filterPeriod)
                        ->select('id', 'period_id', 'balance');
                }
            ]);
        } else {
            $query->with(['organizationUsers.wallet:id,period_id,balance']);
        }

        if ($this->filterLembaga) {
            $query->where('lembaga', $this->filterLembaga);
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $organizations = $query->paginate(5);
        $periods = Period::orderBy('name')->get();

        $lembagaTypes = Organization::select('lembaga')->distinct()->orderBy('lembaga')->pluck('lembaga');

        // Ambil user Bendahara yang belum ada di organization_users
        $availableBendaharas = User::where('role', 'Bendahara')
            ->whereDoesntHave('organizationUser')
            ->select('id', 'username', 'email')
            ->orderBy('username')
            ->get();

        return view('livewire.master-data.tab-content-lembaga', [
            'organizations' => $organizations,
            'periods' => $periods,
            'lembagaTypes' => $lembagaTypes,
            'availableBendaharas' => $availableBendaharas,
        ]);
    }
}

