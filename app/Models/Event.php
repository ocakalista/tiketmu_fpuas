<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'event_date',
        'quota',
        'description',
        'category',
        'banner_url',
        'total_likes',
        'ticket_price',
    ];

    public $timestamps = true;

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function usersWhoLiked()
    {
        return $this->belongsToMany(User::class, 'event_likes')->withTimestamps();
    }
}
