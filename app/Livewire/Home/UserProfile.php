<?php

namespace App\Livewire\Home;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserProfile extends Component
{
    use WithFileUploads;

    public $username;
    public $email;
    public $role;
    public $profile_path;
    public $photo; // Temporary file upload

    public $password;
    public $password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->username = $user->username;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->profile_path = $user->profile_path;
    }

    public function save()
    {
        $user = Auth::user();

        $rules = [
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'max:1024'], // 1MB Max
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];

        $validated = $this->validate($rules);

        $updateData = [
            'username' => $validated['username'],
            'email' => $validated['email'],
        ];

        // Handle Profile Photo
        if ($this->photo) {
            if ($user->profile_path) {
                Storage::disk('public')->delete($user->profile_path);
            }
            // Store in 'profile-user' directory within 'public' disk
            $path = $this->photo->store('profile-user', 'public');
            $updateData['profile_path'] = $path;
        }

        // Handle Password
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        // Reset temporary fields
        $this->photo = null;
        $this->password = '';
        $this->password_confirmation = '';
        
        // Refresh profile path display
        $this->profile_path = $user->refresh()->profile_path;

        session()->flash('success', 'Profile updated successfully.');
        
        // Dispatch event for other components (like header) to update if needed
        $this->dispatch('profile-updated'); 
    }

    public function render()
    {
        return view('livewire.home.user-profile');
    }
}
