<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'proposal_file',
        'funds_approved',
        'date_received',
    ];

    protected $casts = [
        'funds_approved' => 'decimal:2',
        'date_received' => 'date',
    ];

    // Relasi N:1 dengan Organization
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    // Relasi 1:1 dengan Activity
    public function activity()
    {
        return $this->hasOne(Activity::class);
    }
}