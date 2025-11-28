<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Font extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'font_name',
        'font_family',
        'font_file_path',
        'font_weight',
        'is_premium',
        'language_support',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_premium' => 'boolean',
        'language_support' => 'array',
    ];
}
