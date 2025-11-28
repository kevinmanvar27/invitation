<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RsvpResponse extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shared_invitation_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'response',
        'plus_ones_count',
        'meal_preference',
        'special_requests',
        'responded_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'responded_at' => 'datetime',
        'plus_ones_count' => 'integer',
    ];

    /**
     * Get the shared invitation that owns the RSVP response.
     */
    public function sharedInvitation(): BelongsTo
    {
        return $this->belongsTo(SharedInvitation::class);
    }
}
