<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Activity;

class KegiatanBerlangsung extends Component
{
    public $limit = 5;

    public function getActivity()
    {
        return Activity::with('organization:id,name')
            ->whereHas('period', function ($query) {
                $query->where('status', true);
            })
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->orderBy('end_date', 'asc')
            ->select('id', 'name', 'organization_id', 'start_date', 'end_date', 'person_responsible')
            ->limit($this->limit)
            ->get()
            ->map(function ($activity) {
                return [
                    'nama_kegiatan'     => $activity->name,
                    'nama_organisasi'  => $activity->organization->name ?? '-',
                    'tanggal_mulai'    => $activity->start_date,
                    'tanggal_selesai'  => $activity->end_date,
                    'penanggung_jawab' => $activity->person_responsible,
                ];
            });
    }

    public function formatPeriode($startDate, $endDate)
    {
        if (!$startDate || !$endDate) return '-';

        $start = \Carbon\Carbon::parse($startDate);
        $end = \Carbon\Carbon::parse($endDate);

        if ($start->format('M') === $end->format('M')) {
            return $start->format('d') . '-' . $end->format('d M Y');
        }

        return $start->format('d M') . ' - ' . $end->format('d M Y');
    }

    public function hitungHariTersisa($endDate)
    {
        if (!$endDate) return 0;

        $end = \Carbon\Carbon::parse($endDate)->startOfDay();
        $today = now()->startOfDay();

        $diff = $today->diffInDays($end, false);
        return $diff >= 0 ? $diff : 0;
    }

    public function render()
    {
        return view('livewire.dashboard.kegiatan-berlangsung', [
            'activities' => $this->getActivity()
        ]);
    }
}
