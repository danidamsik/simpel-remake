<?php

namespace App\Exports;

use App\Models\Activity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class ActivityExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
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
            ->when($this->filters['period_id'], function ($q) {
                $q->where('activities.period_id', $this->filters['period_id']);
            })
            ->when($this->filters['lpj_status'], function ($q) {
                $q->where('lpj.status', $this->filters['lpj_status']);
            })
            ->when($this->filters['activity_status'], function ($q) {
                $now = now()->format('Y-m-d');
                if ($this->filters['activity_status'] === 'Belum Dimulai') {
                    $q->where('activities.start_date', '>', $now);
                } elseif ($this->filters['activity_status'] === 'Berlangsung') {
                    $q->where('activities.start_date', '<=', $now)
                      ->where('activities.end_date', '>=', $now);
                } elseif ($this->filters['activity_status'] === 'Selesai') {
                    $q->where('activities.end_date', '<', $now);
                }
            })
            ->when($this->filters['organization_id'], function ($q) {
                $q->where('activities.organization_id', $this->filters['organization_id']);
            })
            ->orderBy('activities.start_date', 'desc');

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Lembaga',
            'Kegiatan',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Dana Disetujui',
            'Status Kegiatan',
            'Status LPJ',
        ];
    }

    public function map($item): array
    {
        static $counter = 0;
        $counter++;

        // Determine activity status
        $now = now()->format('Y-m-d');
        if ($item->start_date > $now) {
            $activityStatus = 'Belum Dimulai';
        } elseif ($item->end_date < $now) {
            $activityStatus = 'Selesai';
        } else {
            $activityStatus = 'Berlangsung';
        }

        // Determine LPJ status
        $lpjStatus = $item->lpj_status ?? '-';

        return [
            $counter,
            $item->organization_name,
            $item->activity_name,
            Carbon::parse($item->start_date)->format('d M Y'),
            Carbon::parse($item->end_date)->format('d M Y'),
            'Rp ' . number_format($item->funds_approved, 0, ',', '.'),
            $activityStatus,
            $lpjStatus,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F3F4F6']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 25,
            'C' => 40,
            'D' => 18,
            'E' => 18,
            'F' => 20,
            'G' => 18,
            'H' => 18,
        ];
    }

    public function title(): string
    {
        return 'Laporan Kegiatan';
    }
}