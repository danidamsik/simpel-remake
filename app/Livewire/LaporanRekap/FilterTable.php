<?php

namespace App\Livewire\LaporanRekap;

use App\Models\Activity;
use App\Models\Period;
use App\Models\Organization;
use App\Exports\ActivityExport;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class FilterTable extends Component
{
    use WithPagination;
    
    public $period_id;
    public $lpj_status;
    public $activity_status;
    public $organization_id; 
    
    public function updatedPeriodId()
    {
        $this->resetPage();
    }
    
    public function updatedLpjStatus()
    {
        $this->resetPage();
    }
    
    public function updatedActivityStatus()
    {
        $this->resetPage();
    }
    
    public function updatedOrganizationId()
    {
        $this->resetPage();
    }
    
    public function exportExcel()
    {
        $filters = [
            'period_id' => $this->period_id,
            'lpj_status' => $this->lpj_status,
            'activity_status' => $this->activity_status,
            'organization_id' => $this->organization_id,
        ];

        $fileName = 'Laporan_Kegiatan_' . now()->format('Y-m-d_His') . '.xlsx';
        
        return Excel::download(new ActivityExport($filters), $fileName);
    }
    
    public function exportPdf()
    {
        $data = $this->getFilteredData();
        $filterInfo = $this->getFilterLabels();
    
        $pdf = Pdf::loadView('pdf.laporan-kegiatan', [
            'data' => $data,
            'filterInfo' => $filterInfo,
            'generatedAt' => now()->format('d F Y H:i:s')
        ]);
        
        // Set paper size and orientation
        $pdf->setPaper('a4', 'landscape');
        
        $fileName = 'Laporan_Kegiatan_' . now()->format('Y-m-d_His') . '.pdf';
        
        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->output();
        }, $fileName);
    }
    
    private function getFilteredData()
    {
        $query = Activity::query()
            ->join('organizations', 'activities.organization_id', '=', 'organizations.id')
            ->join('proposals', 'activities.proposal_id', '=', 'proposals.id')
            ->leftJoin('lpj', 'activities.id', '=', 'lpj.activity_id')
            ->select(
                'activities.id',
                'organizations.name as organization_name',
                'activities.name as activity_name',
                'activities.start_date',
                'activities.end_date',
                'proposals.funds_approved',
                'lpj.status as lpj_status'
            )
            ->when($this->period_id, function ($q) {
                $q->where('activities.period_id', $this->period_id);
            })
            ->when($this->lpj_status, function ($q) {
                $q->where('lpj.status', $this->lpj_status);
            })
            ->when($this->activity_status, function ($q) {
                $now = now()->format('Y-m-d');
                if ($this->activity_status === 'Belum Dimulai') {
                    $q->where('activities.start_date', '>', $now);
                } elseif ($this->activity_status === 'Berlangsung') {
                    $q->where('activities.start_date', '<=', $now)
                      ->where('activities.end_date', '>=', $now);
                } elseif ($this->activity_status === 'Selesai') {
                    $q->where('activities.end_date', '<', $now);
                }
            })
            ->when($this->organization_id, function ($q) {
                $q->where('activities.organization_id', $this->organization_id);
            })
            ->orderBy('activities.start_date', 'desc')
            ->get();
            
        return $query;
    }
    
    private function getFilterLabels()
    {
        $filters = [];
        
        if ($this->period_id) {
            $period = Period::find($this->period_id);
            $filters['Periode'] = $period ? $period->name : '-';
        }
        
        if ($this->organization_id) {
            $organization = Organization::find($this->organization_id);
            $filters['Lembaga'] = $organization ? $organization->name : '-';
        }
        
        if ($this->activity_status) {
            $filters['Status Kegiatan'] = $this->activity_status;
        }
        
        if ($this->lpj_status) {
            $filters['Status LPJ'] = $this->lpj_status;
        }
        
        return $filters;
    }
    
    public function render()
    {
        $query = Activity::query()
            ->join('organizations', 'activities.organization_id', '=', 'organizations.id')
            ->join('proposals', 'activities.proposal_id', '=', 'proposals.id')
            ->leftJoin('lpj', 'activities.id', '=', 'lpj.activity_id')
            ->select(
                'activities.id',
                'organizations.name as organization_name',
                'activities.name as activity_name',
                'activities.start_date',
                'activities.end_date',
                'proposals.funds_approved',
                'lpj.status as lpj_status'
            )
            ->when($this->period_id, function ($q) {
                $q->where('activities.period_id', $this->period_id);
            })
            ->when($this->lpj_status, function ($q) {
                $q->where('lpj.status', $this->lpj_status);
            })
            ->when($this->activity_status, function ($q) {
                $now = now()->format('Y-m-d');
                if ($this->activity_status === 'Belum Dimulai') {
                    $q->where('activities.start_date', '>', $now);
                } elseif ($this->activity_status === 'Berlangsung') {
                    $q->where('activities.start_date', '<=', $now)
                      ->where('activities.end_date', '>=', $now);
                } elseif ($this->activity_status === 'Selesai') {
                    $q->where('activities.end_date', '<', $now);
                }
            })
            ->when($this->organization_id, function ($q) {
                $q->where('activities.organization_id', $this->organization_id);
            })
            ->orderBy('activities.start_date', 'desc');
        
        return view('livewire.laporan-rekap.filter-table', [
            'data' => $query->paginate(10),
            'periods' => Period::all(),
            'organizations' => Organization::orderBy('name')->get(),
        ]);
    }
}