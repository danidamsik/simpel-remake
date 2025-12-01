<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'activity_id',
        'amount',
        'description',
        'expense_date',
        'tax_persentase',
        'tax_type',
        'proof_file',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'tax_persentase' => 'decimal:2',
        'expense_date' => 'date',
    ];

    // Relasi N:1 dengan Organization
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    // Relasi N:1 dengan Activity
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}