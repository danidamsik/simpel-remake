<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Renderless;
use App\Models\Activity;
use App\Models\ReminderLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DaftarLpjTerlambat extends Component
{

    #[Renderless]
    public function getLogs($activityId)
    {
        $activity = Activity::find($activityId);
        
        if (!$activity) {
            return [
                'activityName' => '',
                'logs' => [],
            ];
        }

        $logs = ReminderLog::where('activity_id', $activityId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($log) {
                return [
                    'number' => $log->number,
                    'message' => $log->message,
                    'created_at' => Carbon::parse($log->created_at)->format('d M Y, H:i'),
                ];
            });

        return [
            'activityName' => $activity->name,
            'logs' => $logs,
        ];
    }

    #[Renderless]
    public function sendMessage($activityId, $phoneNumber, $message)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $phoneNumber,
                'message' => $message,
                'countryCode' => '62',
            ]);

            $result = $response->json();

            if ($response->successful() && ($result['status'] ?? false)) {
                ReminderLog::create([
                    'activity_id' => $activityId,
                    'number' => $phoneNumber,
                    'message' => $message,
                ]);

                return [
                    'success' => true,
                    'message' => 'Pesan berhasil dikirim!',
                ];
            }

            return [
                'success' => false,
                'message' => $result['reason'] ?? ($result['detail'] ?? 'Gagal mengirim pesan'),
            ];

        } catch (\Exception $e) {
            Log::error('Fonnte API Error', [
                'target' => $phoneNumber,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ];
        }
    }

    public function render()
    {
        $lpjTerlambat = Activity::query()
            ->join('lpj', 'activities.id', '=', 'lpj.activity_id')
            ->join('organizations', 'activities.organization_id', '=', 'organizations.id')
            ->join('periods', 'activities.period_id', '=', 'periods.id')
            ->where('periods.status', true)
            ->where('activities.end_date', '<=', Carbon::now()->subDays(7))
            ->where('lpj.status', 'Belum Disetor')
            ->select(
                'organizations.name',
                'organizations.lembaga',
                'activities.name as activity_name',
                'activities.end_date',
                'activities.person_responsible',
                'activities.number_pr',
                'activities.id as activity_id',
                DB::raw("DATE_ADD(activities.end_date, INTERVAL 7 DAY) as deadline")
            )
            ->orderBy('activities.end_date', 'asc')
            ->get();

        return view('livewire.dashboard.daftar-lpj-terlambat', [
            'lpjTerlambat' => $lpjTerlambat,
        ]);
    }
}

