<?php

namespace App\Livewire\MasterData;

use App\Models\Period;
use Livewire\Component;
use Livewire\WithPagination;

class TabContentPeriode extends Component
{
    use WithPagination;

    // Modal Properties
    public $showModal = false;
    public $isEditMode = false;
    public $selectedPeriodId = null;

    // Form Properties
    public $name;
    public $start_date;
    public $end_date;
    public $status = true; // Default active

    protected $rules = [
        'name' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'status' => 'boolean',
    ];

    public function render()
    {
        $periods = Period::orderBy('start_date', 'desc')->paginate(5);

        return view('livewire.master-data.tab-content-periode', [
            'periods' => $periods
        ]);
    }

    public function store()
    {
        $this->validate();

        // New period must be active
        $this->status = true;

        // Deactivate all other periods
        Period::where('status', true)->update(['status' => false]);

        Period::create([
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]);

        $this->showModal = false;
        $this->resetForm();
        $this->dispatch('notify', message: 'Periode berhasil ditambahkan dan diaktifkan!', type: 'success');
    }

    public function update()
    {
        $this->validate();

        if ($this->status) {
            // If setting to active, deactivate others
            Period::where('id', '!=', $this->selectedPeriodId)->update(['status' => false]);
        }

        $period = Period::findOrFail($this->selectedPeriodId);
        $period->update([
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]);

        $this->showModal = false;
        $this->resetForm();
        $this->dispatch('notify', message: 'Periode berhasil diperbarui!', type: 'success');
    }

    public function resetForm()
    {
        $this->reset(['name', 'start_date', 'end_date', 'status', 'selectedPeriodId', 'isEditMode']);
        $this->resetErrorBag();
        $this->status = true; // Reset to default true
    }
}

