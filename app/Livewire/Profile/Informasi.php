<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Informasi extends Component
{
    use WithFileUploads;

    #[Title('Profile Saya')]
    public $username;
    public $email;
    public $current_password;
    public $password;
    public $password_confirmation;
    public $photo;

    public function mount()
    {
        $user = Auth::user();
        
        if ($user) {
            $this->username = $user->username;
            $this->email = $user->email;
        }
    }

    public function update()
    {
        $user = Auth::user();

        if (!$user) {
            $this->dispatch('notify', message: 'Anda harus login terlebih dahulu', type: 'error');
            return redirect()->route('login');
        }

        $this->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:password|current_password',
            'password' => 'nullable|min:8|confirmed',
            'photo' => 'nullable|image|max:1024', // 1MB Max
        ]);

        $user->username = $this->username;
        $user->email = $this->email;

        if ($this->password) {
            $user->password = bcrypt($this->password);
        }

        if ($this->photo) {
            if ($user->profile_path) {
                Storage::disk('public')->delete($user->profile_path);
            }
            $user->profile_path = $this->photo->store('profile-user', 'public');
        }

        $user->save();

        $this->reset(['current_password', 'password', 'password_confirmation', 'photo']);
        
        $this->dispatch('notify', message: 'Profil berhasil diperbarui', type: 'success');
    }

    public function render()
    {
        return view('livewire.profile.informasi', [
            'user' => Auth::user()
        ]);
    }
}

