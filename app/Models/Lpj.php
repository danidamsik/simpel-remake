<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lpj extends Model
{
    use HasFactory;

    protected $table = 'lpj';

    protected $fillable = [
        'activity_id',
        'organization_id',
        'date_received',
        'status',
        'file',
    ];

    protected $casts = [
        'date_received' => 'date',
    ];

    // Relasi 1:1 dengan Activity (inverse)
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    // Relasi N:1 dengan Organization
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}