<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RsvpSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'design_id',
        'user_id',
        'rsvp_enabled',
        'deadline',
        'max_guests_per_invite',
        'collect_meal_preferences',
        'custom_questions',
        'setting_name',
        'setting_value',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'rsvp_enabled' => 'boolean',
        'collect_meal_preferences' => 'boolean',
        'deadline' => 'date',
        'custom_questions' => 'array',
    ];

    /**
     * Get the user design that owns the RSVP setting.
     */
    public function design(): BelongsTo
    {
        return $this->belongsTo(UserDesign::class, 'design_id');
    }

    /**
     * Get the user that owns the RSVP setting.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
