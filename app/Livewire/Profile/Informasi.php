<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Informasi extends Component
{
    public function render()
    {
        // Gunakan user yang login, atau user pertama jika belum login (untuk testing)
        $user = Auth::user() ?? User::first();

        return view('livewire.profile.informasi', [
            'user' => $user
        ]);
    }
}

