<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserCustomization extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'design_id',
        'user_id',
        'bride_name',
        'groom_name',
        'wedding_date',
        'wedding_time',
        'venue',
        'custom_text',
        'language',
        'wording_style',
        'rsvp_enabled',
        'rsvp_deadline',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'custom_text' => 'array',
        'wedding_date' => 'date',
        'wedding_time' => 'time',
        'rsvp_enabled' => 'boolean',
        'rsvp_deadline' => 'date',
    ];

    /**
     * Get the user design that owns the customization.
     */
    public function design(): BelongsTo
    {
        return $this->belongsTo(UserDesign::class, 'design_id');
    }

    /**
     * Get the user that owns the customization.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
