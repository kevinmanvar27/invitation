<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrintOrder extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'design_id',
        'quantity',
        'paper_type',
        'finish',
        'size',
        'orientation',
        'unit_price',
        'total_price',
        'discount',
        'status',
        'tracking_number',
        'ordered_at',
        'delivery_address',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'discount' => 'decimal:2',
        'ordered_at' => 'datetime',
    ];

    /**
     * Get the user that owns the print order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user design associated with the print order.
     */
    public function design(): BelongsTo
    {
        return $this->belongsTo(UserDesign::class);
    }
}