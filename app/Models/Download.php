<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Download extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'design_id',
        'file_type',
        'resolution',
        'file_size',
        'file_path',
        'download_count',
    ];

    /**
     * Get the user that owns the download.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user design associated with the download.
     */
    public function design(): BelongsTo
    {
        return $this->belongsTo(UserDesign::class, 'design_id');
    }
}
