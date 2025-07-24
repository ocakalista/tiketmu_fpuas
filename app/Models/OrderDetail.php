<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'buyer_name',
        'buyer_nik',
        'ticket_code'
    ];

    public function setTicketCodeAttribute($value)
    {
        $this->attributes['ticket_code'] = strtoupper($value);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
