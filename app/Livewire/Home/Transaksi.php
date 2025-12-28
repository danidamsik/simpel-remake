<?php

namespace App\Livewire\Home;

use Livewire\Component;

class Transaksi extends Component
{
    public $transaksi = [];

    public function mount()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user && $user->organizationUser) {
            $organization = $user->organizationUser->organization;

            $expenses = $organization->expenses()
                ->with('activity')
                ->latest('expense_date')
                ->get();

            $this->transaksi = $expenses->map(function ($expense) {
                return [
                    'id' => $expense->id,
                    'kegiatan' => $expense->activity->name,
                    'jumlah' => $expense->amount,
                    'deskripsi' => $expense->description,
                    'tanggal' => $expense->expense_date,
                    'bukti' => $expense->proof_file,
                ];
            });
        }
    }

    public function render()
    {
        return view('livewire.home.transaksi');
    }
}
