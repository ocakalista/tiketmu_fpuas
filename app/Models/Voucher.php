<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'quota',
        'status',
        'valid_until',
        'discount_percentage'
    ];

    protected $casts = [
        'valid_until' => 'datetime',
        'discount_percentage' => 'integer',
    ];

    public function isValidForUse()
    {
        return $this->status === 'active'
            && $this->quota > 0
            && $this->valid_until->isFuture();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isActive()
    {
        return $this->status === 'active' && $this->quota > 0 && now()->lt($this->valid_until);
    }
}
