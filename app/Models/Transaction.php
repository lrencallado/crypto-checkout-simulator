<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'reference_id',
        'email',
        'amount',
        'status',
    ];

    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['amount'] / 100,
            set: fn ($value) => (int) round($value * 100),
        );
    }
}
