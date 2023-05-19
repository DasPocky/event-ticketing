<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'website'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}