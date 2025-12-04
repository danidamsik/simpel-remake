<?php

namespace App\Livewire\Dashboard\ReminderWhatsapp;

use Livewire\Component;
use App\Models\Activity;
use Carbon\Carbon;

class TableLpjTerlambat extends Component
{
    public function getLpjterlambat()
    {
        return Activity::with('organization:id,name')
            ->whereHas('period', function ($query) {
                $query->where('status', true); 
            })
            ->whereHas('lpj', function ($query) {
                $query->where('status', 'Belum Disetor'); 
            })
            ->whereDate('end_date', '<', Carbon::now()->subWeeks()) 
            ->select('id', 'name', 'organization_id', 'end_date')
            ->get()
            ->map(function ($activity) {
                return [
                    'nama_kegiatan'    => $activity->name,
                    'nama_organisasi' => $activity->organization->name,
                    'tanggal_selesai' => $activity->end_date,
                ];
            });
    }
    public function render()
    {
        return view('livewire.dashboard.reminder-whatsapp.table-lpj-terlambat', [
            'lpjTerlambat' => $this->getLpjterlambat()
        ]);
    }
}
