<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rental extends Model
{
    // 1. Mass-assignable fields
    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'total_cost',
        'status',
    ];

    // 2. Cast dates properly
    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'status'     => 'string',
    ];

    // 3. Relationships
    /**
     * A rental belongs to one car.
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * A rental belongs to one user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
