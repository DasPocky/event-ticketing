<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 */
class Organizer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'zip',
        'city',
        'country',
        'email',
        'phone',
        'website',
        'stripe_account_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
