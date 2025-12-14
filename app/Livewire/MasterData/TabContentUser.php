<?php

namespace App\Livewire\MasterData;

use App\Models\Organization;
use App\Models\Period;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TabContentUser extends Component
{
    use WithPagination;

    public $filterOrganization = '';
    public $filterPeriod = '';

    public function updatingFilterOrganization()
    {
        $this->resetPage();
    }

    public function updatingFilterPeriod()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = User::with([
            'organization' => function ($q) {
                if ($this->filterPeriod) {
                    $q->whereHas('wallets', function ($walletQuery) {
                        $walletQuery->where('period_id', $this->filterPeriod);
                    });
                }
            }
        ])
            ->select('id', 'profile_path', 'username', 'email')
            ->where('role', 'Bendahara');

        // Filter by organization ID
        if ($this->filterOrganization) {
            $query->whereHas('organization', function ($q) {
                $q->where('id', $this->filterOrganization);
            });
        }

        // Filter by period (users who have organizations with wallets in that period)
        if ($this->filterPeriod) {
            $query->whereHas('organization.wallets', function ($q) {
                $q->where('period_id', $this->filterPeriod);
            });
        }

        $users = $query->paginate(5);
        $periods = Period::orderBy('name')->get();
        $organizations = Organization::orderBy('name')->get();

        return view('livewire.master-data.tab-content-user', [
            'users' => $users,
            'periods' => $periods,
            'organizations' => $organizations,
        ]);
    }
}

