<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\SubCategory[] $subCategories
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 */

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'zip',
        'city',
        'country',
        'phone',
        'stripe_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
