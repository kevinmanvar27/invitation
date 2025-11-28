<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SharedInvitation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'design_id',
        'user_id',
        'share_token',
        'share_method',
        'recipient_email',
        'recipient_phone',
        'view_count',
        'sent_at',
        'viewed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'sent_at' => 'datetime',
        'viewed_at' => 'datetime',
    ];

    /**
     * Get the user design that owns the shared invitation.
     */
    public function design(): BelongsTo
    {
        return $this->belongsTo(UserDesign::class);
    }

    /**
     * Get the user that owns the shared invitation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
