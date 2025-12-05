<?php

namespace App\Livewire\PengajuanKegiatan;

use App\Models\Lpj;
use App\Models\Period;
use Livewire\Component;
use App\Models\Activity;
use App\Models\Proposal;
use Illuminate\Support\Carbon;

class CardStatistik extends Component
{
    public $periodId;

    public function mount()
    {
        $this->periodId = Period::where('status', true)->value('id');
    }

    public function render()
    {
        $today = Carbon::today();

        $totalProposal = Proposal::whereHas('activity', function ($q) {
            $q->where('period_id', $this->periodId);
        })->count();

        $totalDanaDisetujui = Proposal::whereHas('activity', function ($q) {
            $q->where('period_id', $this->periodId);
        })->sum('funds_approved');

        $totalKegiatan = Activity::where('period_id', $this->periodId)->count();

        $kegiatanBerlangsung = Activity::where('period_id', $this->periodId)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->count();

        $totalLpj = Lpj::whereHas('activity', function ($q) {
            $q->where('period_id', $this->periodId);
        })->count();

        $menungguLpj = Lpj::where('status', 'Belum Disetor')
            ->whereHas('activity', function ($q) {
                $q->where('period_id', $this->periodId);
            })->count();

        $sudahDisetor = Lpj::where('status', 'Disetujui')
            ->whereHas('activity', function ($q) {
                $q->where('period_id', $this->periodId);
            })->count();

        return view('livewire.pengajuan-kegiatan.card-statistik', compact(
            'totalProposal',
            'totalDanaDisetujui',
            'totalKegiatan',
            'kegiatanBerlangsung',
            'menungguLpj',
            'sudahDisetor',
            'totalLpj'
        ));
    }
}
