<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'quantity',
        'quantity_sold',
        'price',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
