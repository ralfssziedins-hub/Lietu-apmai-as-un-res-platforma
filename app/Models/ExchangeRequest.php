<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeRequest extends Model
{
    protected $table = 'requests';

    protected $fillable = [
        'user_id',
        'item_id',
        'offered_item_id',
        'start_date',
        'end_date',
        'message',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function offeredItem()
    {
        return $this->belongsTo(Item::class, 'offered_item_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'request_id');
    }
}