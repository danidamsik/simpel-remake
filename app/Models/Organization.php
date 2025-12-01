<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'lembaga',
        'number_phone',
        'email',
        'current_balance',
        'logo_path',
    ];

    protected $casts = [
        'current_balance' => 'decimal:2',
    ];

    // Relasi 1:1 dengan User (inverse)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi 1:N dengan Proposal
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    // Relasi 1:N dengan Activity
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    // Relasi 1:N dengan Lpj
    public function lpjs()
    {
        return $this->hasMany(Lpj::class);
    }

    // Relasi 1:N dengan Expense
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}