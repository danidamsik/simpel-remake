<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReminderLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'number',
        'message',
    ];

    // Relasi N:1 dengan Activity
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}