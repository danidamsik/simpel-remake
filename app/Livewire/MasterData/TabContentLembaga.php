<?php

namespace App\Livewire\MasterData;

use App\Models\Organization;
use App\Models\Period;
use Livewire\Component;
use Livewire\WithPagination;

class TabContentLembaga extends Component
{
    use WithPagination;

    public $filterLembaga = '';
    public $filterPeriod = '';

    public function updatingFilterLembaga()
    {
        $this->resetPage();
    }

    public function updatingFilterPeriod()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Organization::with(['user:id,username'])
            ->select('id', 'logo_path', 'name', 'lembaga', 'user_id', 'number_phone', 'email');

        // Add wallet balance based on period filter
        if ($this->filterPeriod) {
            $query->with([
                'wallets' => function ($q) {
                    $q->where('period_id', $this->filterPeriod)
                        ->select('id', 'organization_id', 'balance');
                }
            ]);
        } else {
            $query->with(['wallets:id,organization_id,balance']);
        }

        // Filter by lembaga type
        if ($this->filterLembaga) {
            $query->where('lembaga', $this->filterLembaga);
        }

        // Filter by period (only show organizations that have wallets in that period)
        if ($this->filterPeriod) {
            $query->whereHas('wallets', function ($q) {
                $q->where('period_id', $this->filterPeriod);
            });
        }

        $organizations = $query->paginate(5);
        $periods = Period::orderBy('name')->get();

        // Get unique lembaga types for filter dropdown
        $lembagaTypes = Organization::select('lembaga')->distinct()->orderBy('lembaga')->pluck('lembaga');

        return view('livewire.master-data.tab-content-lembaga', [
            'organizations' => $organizations,
            'periods' => $periods,
            'lembagaTypes' => $lembagaTypes,
        ]);
    }
}

