<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'period_id',
        'bank_name',
        'account_name',
        'account_number',
        'balance',
    ];

    // Relasi 1:1 dengan OrganizationUser
    public function organizationUser()
    {
        return $this->hasOne(OrganizationUser::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
