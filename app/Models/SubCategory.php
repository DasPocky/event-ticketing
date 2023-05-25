<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\SubCategory[] $subCategories
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property \App\Models\Category $category
 */
class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
