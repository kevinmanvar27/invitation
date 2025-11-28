<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'min_purchase',
        'valid_from',
        'valid_until',
        'usage_limit',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'discount_value' => 'decimal:2',
        'min_purchase' => 'decimal:2',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
    ];
}