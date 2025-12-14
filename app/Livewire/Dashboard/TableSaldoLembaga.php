<?php
namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Organization;
use Livewire\Attributes\Renderless;

class TableSaldoLembaga extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function getDatalembaga()
    {
        return Organization::with([
            'wallets',
            'activities' => function ($query) {
                $query->whereHas('period', function ($periodQuery) {
                    $periodQuery->where('status', true);
                })->with(['lpj', 'expenses']);
            }
        ])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage)
            ->through(function ($org) {
                return [
                    'id' => $org->id,
                    'organization_name' => $org->name,
                    'logo_path' => $org->logo_path,
                    'total_funds_used' => $org->activities->sum(function ($activity) {
                        return $activity->expenses->sum('amount');
                    }),
                    'current_balance' => $org->wallets->sum('balance'),
                ];
            });
    }

    #[Renderless]
    public function getActivities($organizationId)
    {
        $organization = Organization::with([
            'activities' => function ($query) {
                $query->whereHas('period', function ($periodQuery) {
                    $periodQuery->where('status', true);
                })->with(['lpj', 'expenses']);
            }
        ])->find($organizationId);

        if (!$organization) {
            return [];
        }

        return $organization->activities->map(function ($activity) {
            return [
                'activity_name' => $activity->name,
                'start_date' => $activity->start_date,
                'end_date' => $activity->end_date,
                'location' => $activity->location,
                'funds_used' => $activity->expenses->sum('amount'),
                'lpj_status' => $activity->lpj->status ?? null
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard.table-saldo-lembaga', [
            'dataLembaga' => $this->getDatalembaga()
        ]);
    }
}