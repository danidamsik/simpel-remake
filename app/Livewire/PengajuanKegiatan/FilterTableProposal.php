<?php

namespace App\Livewire\PengajuanKegiatan;

use App\Models\Activity;
use App\Models\Period;
use App\Models\Lpj;
use Livewire\Component;
use App\Models\Organization;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Renderless;

class FilterTableProposal extends Component
{
    use WithPagination, WithFileUploads;

    public $lembagaFilter, $periodId, $lpjStatus, $search, $lembagas, $periods;
    public $lpjFile;
    public $showDeleteModal = false;
    public $deleteActivityId = null;

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

    #[Renderless]
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

    public function uploadLpj($activityId)
    {
        $this->validate([
            'lpjFile' => 'required|file|mimes:pdf,doc,docx|max:10240', 
        ], [
            'lpjFile.required' => 'File LPJ wajib diupload.',
            'lpjFile.mimes' => 'File harus berformat PDF, DOC, atau DOCX.',
            'lpjFile.max' => 'Ukuran file maksimal 10MB.',
        ]);

        $activity = Activity::find($activityId);
        
        if (!$activity) {
            $this->dispatch('notify', message: 'Kegiatan tidak ditemukan.', type: 'error');
            return;
        }

        $filePath = $this->lpjFile->store('lpj', 'public');

        Lpj::updateOrCreate(
            ['activity_id' => $activityId],
            [
                'organization_id' => $activity->organization_id,
                'file' => $filePath,
                'status' => 'Disetujui',
                'date_received' => now(),
            ]
        );

        $this->reset('lpjFile');

        $this->dispatch('notify', message: 'LPJ berhasil diupload!', type: 'success');
        $this->dispatch('lpj-uploaded', activityId: $activityId);
    }

    public function deleteActivity()
    {
        if ($this->deleteActivityId) {
            $activity = Activity::find($this->deleteActivityId);
            
            if ($activity) {
                $activity->delete();
                $this->dispatch('notify', message: 'Kegiatan berhasil dihapus!', type: 'success');
            } else {
                $this->dispatch('notify', message: 'Kegiatan tidak ditemukan.', type: 'error');
            }
        }
        
        $this->showDeleteModal = false;
        $this->deleteActivityId = null;
    }


    public function render()
    {
        $activities = Activity::query()
            ->select(['id', 'name', 'location', 'organization_id', 'proposal_id', 'period_id', 'created_at'])
            ->with([
                'organization:id,name,lembaga,logo_path',
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