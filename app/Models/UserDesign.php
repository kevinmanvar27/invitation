<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserDesign extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'template_id',
        'design_name',
        'canvas_data',
        'thumbnail_path',
        'is_completed',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'canvas_data' => 'array',
        'is_completed' => 'boolean',
    ];

    /**
     * Get the user that owns the design.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the template that owns the design.
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    /**
     * Get the customization for the design.
     */
    public function customization(): HasOne
    {
        return $this->hasOne(UserCustomization::class);
    }

    /**
     * Get the shared invitations for the design.
     */
    public function sharedInvitations(): HasMany
    {
        return $this->hasMany(SharedInvitation::class);
    }

    /**
     * Get the downloads for the design.
     */
    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class);
    }

    /**
     * Get the print orders for the design.
     */
    public function printOrders(): HasMany
    {
        return $this->hasMany(PrintOrder::class);
    }

    /**
     * Get the RSVP settings for the design.
     */
    public function rsvpSettings(): HasOne
    {
        return $this->hasOne(RsvpSetting::class);
    }
}
