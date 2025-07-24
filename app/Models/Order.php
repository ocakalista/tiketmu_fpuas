<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'voucher_id',
        'payment_method',
        'total_price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function orderDetail()
    {
        return $this->hasOne(OrderDetail::class);
    }
}
