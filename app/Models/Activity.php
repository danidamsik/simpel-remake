<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'organization_id',
        'proposal_id',
        'period_id',
        'start_date',
        'end_date',
        'location',
        'description',
        'person_responsible',
        'number_pr',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relasi N:1 dengan Organization
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    // Relasi 1:1 dengan Proposal (inverse)
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    // Relasi N:1 dengan Period
    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    // Relasi 1:1 dengan Lpj
    public function lpj()
    {
        return $this->hasOne(Lpj::class);
    }

    // Relasi 1:N dengan Expense
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    // Relasi 1:N dengan ReminderLog
    public function reminderLogs()
    {
        return $this->hasMany(ReminderLog::class);
    }
}