<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\SubCategory[] $subCategories
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 */

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
