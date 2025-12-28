<?php

namespace App\Livewire\Home;

use Livewire\Component;

class Kegiatan extends Component
{
    public $kegiatan = [];

    public function mount()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user && $user->organizationUser) {
            $organization = $user->organizationUser->organization;
            
            $activities = $organization->activities()
                ->with(['lpj', 'expenses'])
                ->get();

            $this->kegiatan = $activities->map(function ($activity) {
                $now = \Carbon\Carbon::now();
                $start = \Carbon\Carbon::parse($activity->start_date);
                $end = \Carbon\Carbon::parse($activity->end_date);
                
                $status = 'Belum dimulai';
                if ($now->between($start, $end)) {
                    $status = 'Sedang berjalan';
                } elseif ($now->greaterThan($end)) {
                    $status = 'Selesai';
                }

                return [
                    'id' => $activity->id,
                    'nama' => $activity->name,
                    'mulai' => $activity->start_date,
                    'selesai' => $activity->end_date,
                    'status' => $status,
                    'lokasi' => $activity->location,
                    'dana' => $activity->expenses->sum('amount'),
                    'deskripsi' => $activity->description,
                    'status_lpj' => $activity->lpj ? $activity->lpj->status : 'Belum Disetor',
                ];
            });
        }
    }

    public function render()
    {
        return view('livewire.home.kegiatan');
    }
}
