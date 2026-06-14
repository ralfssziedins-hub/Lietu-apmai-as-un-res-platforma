<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'role',
    'is_blocked',
])]
#[Hidden([
    'password',
    'remember_token',
])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_blocked' => 'boolean',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function isBlocked()
    {
        return $this->is_blocked;
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function requests()
    {
        return $this->hasMany(ExchangeRequest::class);
    }

    public function writtenReviews()
    {
        return $this->hasMany(Review::class, 'author_id');
    }

    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'receiver_id');
    }
}