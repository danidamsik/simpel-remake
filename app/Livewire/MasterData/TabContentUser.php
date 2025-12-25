<?php

namespace App\Livewire\MasterData;

use App\Models\Organization;
use App\Models\Period;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TabContentUser extends Component
{
    use WithPagination;
    use \Livewire\WithFileUploads;

    public $filterOrganization = '';
    public $filterPeriod = '';

    // Modal Properties
    public $showModal = false;
    public $isEditMode = false;
    public $selectedUserId = null;

    // Form Properties
    public $username;
    public $email;
    public $password;
    public $password_confirmation;
    public $profile;
    public $existingProfile; 

    // Credential Display Properties
    public $showCredentialModal = false;
    public $createdUsername;
    public $createdPassword;
    public $whatsappNumber;

    protected function rules()
    {
        $rules = [
            'username' => 'required|min:3|unique:users,username,' . $this->selectedUserId,
            'email' => 'required|email|unique:users,email,' . $this->selectedUserId,
        ];

        if (!$this->isEditMode) {
            $rules['password'] = 'required|min:8|confirmed';
        } else {
            $rules['password'] = 'nullable|min:8|confirmed';
        }

        if ($this->profile) {
            $rules['profile'] = 'image|max:2048'; 
        }

        return $rules;
    }

    public function updatingFilterOrganization()
    {
        $this->resetPage();
    }

    public function updatingFilterPeriod()
    {
        $this->resetPage();
    }


    public function store()
    {
        $this->validate();

        $profilePath = null;
        if ($this->profile) {
            $profilePath = $this->profile->store('profile', 'public');
        }

        $user = User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => 'Bendahara',
            'profile_path' => $profilePath,
        ]);

        $this->createdUsername = $this->username;
        $this->createdPassword = $this->password;
        
        $this->showModal = false;
        $this->resetForm();
        
        $this->showCredentialModal = true;
    }

    public function update()
    {
        $this->validate();

        $user = User::findOrFail($this->selectedUserId);

        $dataToUpdate = [
            'username' => $this->username,
            'email' => $this->email,
        ];

        $passwordUpdated = false;
        if ($this->password) {
            $dataToUpdate['password'] = bcrypt($this->password);
            $passwordUpdated = true;
            $this->createdPassword = $this->password;
        }

        if ($this->profile) {
            $dataToUpdate['profile_path'] = $this->profile->store('profile', 'public');
        }

        $user->update($dataToUpdate);

        $this->createdUsername = $this->username;

        $this->showModal = false;
        $this->resetForm();

        if ($passwordUpdated) {
            $this->showCredentialModal = true;
        } else {
            $this->dispatch('notify', message: 'Data bendahara berhasil diperbarui!', type: 'success');
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset(['username', 'email', 'password', 'password_confirmation', 'profile', 'selectedUserId', 'isEditMode', 'existingProfile']);
        $this->resetErrorBag();
    }

    public function render()
    {
        $query = User::with([
            'organization' => function ($q) {
                if ($this->filterPeriod) {
                    $q->whereHas('wallets', function ($walletQuery) {
                        $walletQuery->where('period_id', $this->filterPeriod);
                    });
                }
            }
        ])
            ->select('id', 'profile_path', 'username', 'email', 'role') 
            ->where('role', 'Bendahara');

        if ($this->filterOrganization) {
            $query->whereHas('organization', function ($q) {
                $q->where('id', $this->filterOrganization);
            });
        }

        if ($this->filterPeriod) {
            $query->whereHas('organization.wallets', function ($q) {
                $q->where('period_id', $this->filterPeriod);
            });
        }

        $users = $query->paginate(5);
        $periods = Period::orderBy('name')->get();
        $organizations = Organization::orderBy('name')->get();

        return view('livewire.master-data.tab-content-user', [
            'users' => $users,
            'periods' => $periods,
            'organizations' => $organizations,
        ]);
    }

    #[\Livewire\Attributes\Renderless]
    public function sendCredentialToWhatsapp()
    {
        $this->validate([
            'whatsappNumber' => 'required|numeric|min_digits:10|max_digits:15',
        ]);

        $message = "*Informasi Akun Bendahara*\n\n";
        $message .= "Halo, berikut adalah detail akun Anda:\n";
        $message .= "Username: " . $this->createdUsername . "\n";
        $message .= "Password: " . $this->createdPassword . "\n\n";
        $message .= "Mohon simpan informasi ini dengan aman.";

        $response = $this->sendMessage($this->whatsappNumber, $message);

        if ($response['success']) {
            $this->whatsappNumber = ''; 
            $this->showCredentialModal = false;
            $this->dispatch('notify', message: 'Pesan berhasil dikirim ke WhatsApp!', type: 'success');
        } else {
            $this->dispatch('notify', message: 'Gagal mengirim pesan: ' . $response['message'], type: 'error');
        }
    }

    private function sendMessage($phoneNumber, $message)
    {
        try {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $phoneNumber,
                'message' => $message,
                'countryCode' => '62',
            ]);

            $result = $response->json();

            if ($response->successful() && ($result['status'] ?? false)) {
                return [
                    'success' => true,
                    'message' => 'Pesan berhasil dikirim!',
                ];
            }

            return [
                'success' => false,
                'message' => $result['reason'] ?? ($result['detail'] ?? 'Gagal mengirim pesan'),
            ];

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Fonnte API Error', [
                'target' => $phoneNumber,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ];
        }
    }
}

