<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'sub_category_id',
        'venue_id',
        'title',
        'description',
        'entry_datetime',
        'start_datetime',
        'end_datetime',
        'status',
        'image',
        'website'
    ];

    protected $dates = [
        'entry_datetime',
        'start_datetime',
        'end_datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function purchases()
    {
        return $this->hasManyThrough(Purchase::class, Ticket::class);
    }
}
