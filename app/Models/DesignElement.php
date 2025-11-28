<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignElement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'category',
        'svg_path',
        'png_path',
        'is_premium',
        'tags',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_premium' => 'boolean',
        'tags' => 'array',
    ];
}
