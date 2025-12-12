<?php

namespace App\Livewire\PengajuanKegiatan;

use App\Models\Activity;
use App\Models\Period;
use Livewire\Component;
use App\Models\Organization;
use Livewire\WithPagination;

class FilterTableProposal extends Component
{
    use WithPagination;

    public $lembagaFilter = '';
    public $periodId = '';
    public $lpjStatus = '';
    public $search = '';

    public $lembagas;
    public $periods;

    public function mount()
    {
        $this->lembagas = Organization::select('lembaga')->distinct()->pluck('lembaga');
        $this->periods = Period::orderBy('start_date', 'desc')->get();
    }

    public function updatedLembagaFilter()
    {
        $this->resetPage();
    }

    public function updatedPeriodId()
    {
        $this->resetPage();
    }

    public function updatedLpjStatus()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[\Livewire\Attributes\Renderless]
    public function getActivityDetails($activityId)
    {
        $activity = Activity::with([
            'organization:id,name',
            'proposal:id,date_received,funds_approved,proposal_file',
            'lpj:id,activity_id,status,date_received,file'
        ])
        ->withSum('expenses', 'amount')
        ->find($activityId);

        return $activity ? $activity->toArray() : null;
    }

    public function render()
    {
        $activities = Activity::query()
            ->select(['id', 'name', 'location', 'organization_id', 'proposal_id', 'period_id', 'created_at'])
            ->with([
                'organization:id,name,lembaga',
                'proposal:id,date_received,funds_approved',
                'lpj:id,activity_id,status'
            ])
            ->when($this->lembagaFilter, function ($query) {
                $query->whereHas('organization', function ($q) {
                    $q->where('lembaga', $this->lembagaFilter);
                });
            })
            ->when($this->periodId, function ($query) {
                $query->where('period_id', $this->periodId);
            })
            ->when($this->lpjStatus, function ($query) {
                if ($this->lpjStatus === 'Belum Disetor' || $this->lpjStatus === 'Disetujui') {
                    $query->whereHas('lpj', function ($q) {
                        $q->where('status', $this->lpjStatus);
                    });
                }
            })
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.pengajuan-kegiatan.filter-table-proposal', [
            'activities' => $activities
        ]);
    }
}
