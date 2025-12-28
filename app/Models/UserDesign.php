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
        'category_id',
        'design_name',
        'category',
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
     * Get the customization for the design.
     */
    public function customization(): HasOne
    {
        return $this->hasOne(UserCustomization::class, 'design_id');
    }

    /**
     * Get the shared invitations for the design.
     */
    public function sharedInvitations(): HasMany
    {
        return $this->hasMany(SharedInvitation::class, 'design_id');
    }

    /**
     * Get the downloads for the design.
     */
    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class, 'design_id');
    }
}
