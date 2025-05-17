<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    // 1. Mass-assignable fields
    protected $fillable = [
        'name',
        'brand',
        'model',
        'year',
        'car_type',
        'daily_rent_price',
        'availability',
        'image',
    ];

    // 2. Relationships
    /**
     * A car can have many rentals.
     */
    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }
}
