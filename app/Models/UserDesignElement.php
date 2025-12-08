<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDesignElement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_design_id',
        'element_type',
        'content',
        'position_x',
        'position_y',
        'width',
        'height',
        'rotation',
        'z_index',
        'styles',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'position_x' => 'float',
        'position_y' => 'float',
        'width' => 'float',
        'height' => 'float',
        'rotation' => 'float',
        'z_index' => 'integer',
        'styles' => 'array',
    ];
    
    /**
     * Get the user design that owns this element.
     */
    public function userDesign(): BelongsTo
    {
        return $this->belongsTo(UserDesign::class);
    }
}
