<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\SubCategory[] $subCategories
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 */
class TicketGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'event_id',
        'quantity_total',
        'quantity_sold',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
