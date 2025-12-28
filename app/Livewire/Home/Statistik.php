<?php

namespace App\Livewire\Home;

use Livewire\Component;

class Statistik extends Component
{
    public $sisaDana = 0;
    public $danaTerpakai = 0;
    public $lpjTersetor = 0;
    public $menungguLpj = 0;
    public $totalKegiatan = 0;

    public function mount()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user && $user->organizationUser) {
            $organization = $user->organizationUser->organization;
            
            // Sisa Dana dari Wallet
            $this->sisaDana = $user->organizationUser->wallet->balance ?? 0;
            
            // Dana Terpakai (Sum of Expenses)
            $this->danaTerpakai = $organization->expenses()->sum('amount');
            
            $this->lpjTersetor = $organization->lpjs()->where('status', 'Disetujui')->count();
            
            // Menunggu LPJ (Status Belum Disetor)
            $this->menungguLpj = $organization->lpjs()->where('status', 'Belum Disetor')->count();
            
            // Total Kegiatan
            $this->totalKegiatan = $organization->activities()->count();
        }
    }

    public function render()
    {
        return view('livewire.home.statistik');
    }
}
