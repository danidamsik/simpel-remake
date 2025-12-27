<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'user_id',
        'wallet_id',
    ];

    // Relasi N:1 dengan Organization
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    // Relasi 1:1 dengan User (inverse)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi 1:1 dengan Wallet (inverse)
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
