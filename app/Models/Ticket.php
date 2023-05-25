<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\SubCategory[] $subCategories
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\TicketGroup[] $ticketGroups
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Ticket[] $tickets
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Ticket[] $purchases
 */
class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_group_id',
        'event_id',
        'name',
        'quantity_sold',
        'price',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function ticketGroup()
    {
        return $this->belongsTo(TicketGroup::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
