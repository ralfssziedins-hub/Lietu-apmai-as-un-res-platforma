<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'request_id',
        'author_id',
        'receiver_id',
        'rating',
        'text',
    ];

    public function request()
    {
        return $this->belongsTo(ExchangeRequest::class, 'request_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}