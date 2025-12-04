<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Activity;

class KegiatanBerlangsung extends Component
{
    public function getActivity()
    {
        return Activity::with('organization:id,name')
            ->whereHas('period', function ($query) {
                $query->where('status', true);
            })
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->select('id', 'name', 'organization_id', 'start_date', 'end_date', 'person_responsible')
            ->get()
            ->map(function ($activity) {
                return [
                    'nama_kegiatan'     => $activity->name,
                    'nama_organisasi'  => $activity->organization->name,
                    'tanggal_mulai'    => $activity->start_date,
                    'tanggal_selesai'  => $activity->end_date,
                    'penanggung_jawab' => $activity->person_responsible,
                ];
            });
    }

    public function render()
    {
        return view('livewire.dashboard.kegiatan-berlangsung', [
            'activities' => $this->getActivity()
        ]);
    }
}
