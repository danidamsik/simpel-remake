<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'period_id',
        'bank_name',
        'account_name',
        'account_number',
        'balance',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
