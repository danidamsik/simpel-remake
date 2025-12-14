<?php

namespace App\Livewire\MasterData;

use App\Models\Period;
use Livewire\Component;
use Livewire\WithPagination;

class TabContentPeriode extends Component
{
    use WithPagination;

    public function render()
    {
        $periods = Period::orderBy('start_date', 'desc')->paginate(5);

        return view('livewire.master-data.tab-content-periode', [
            'periods' => $periods
        ]);
    }
}

