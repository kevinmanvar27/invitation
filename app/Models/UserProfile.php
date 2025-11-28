<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'profile_picture',
        'wedding_date',
        'partner_name',
        'preferences',
        'first_name',
        'last_name',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'bio',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'preferences' => 'array',
        'wedding_date' => 'date',
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}