<?php

namespace App\Livewire\PengajuanKegiatan;

use App\Models\Period;
use Livewire\Component;
use App\Models\Organization;
use Livewire\WithPagination;

class FilterTableProposal extends Component
{
    use WithPagination;

    public $organizationId = '', $periodId = '', $lpjStatus = '', $search = '';

    public $organizations, $periods;

    public function mount()
    {
        $this->organizations = Organization::orderBy('name')->get();
        $this->periods = Period::orderBy('start_date', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.pengajuan-kegiatan.filter-table-proposal');
    }
}
