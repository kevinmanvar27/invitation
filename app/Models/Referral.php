<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referral extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'referrer_user_id',
        'referred_user_id',
        'reward_earned',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'reward_earned' => 'decimal:2',
    ];

    /**
     * Get the user that referred someone.
     */
    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referrer_user_id');
    }

    /**
     * Get the user that was referred.
     */
    public function referred(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }
}