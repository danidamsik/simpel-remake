<?php
namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Organization;
use App\Models\Wallet;
use Livewire\Attributes\Renderless;
use Illuminate\Support\Facades\DB;

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
            'activities' => function ($query) {
                $query->whereHas('period', function ($periodQuery) {
                    $periodQuery->where('status', true);
                })->with(['lpj', 'expenses']);
            }
        ])
            ->addSelect(['current_balance' => Wallet::select(DB::raw('COALESCE(SUM(wallets.balance), 0)'))
                ->join('organization_users', 'organization_users.wallet_id', '=', 'wallets.id')
                ->whereColumn('organization_users.organization_id', 'organizations.id')
                ->whereHas('period', function ($q) {
                    $q->where('status', true);
                })
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
                    'current_balance' => (float) $org->current_balance,
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