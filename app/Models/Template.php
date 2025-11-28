<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Template extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'theme',
        'style',
        'orientation',
        'is_premium',
        'price',
        'thumbnail_path',
        'preview_path',
        'template_data',
        'downloads_count',
        'usage_count',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'template_data' => 'array',
        'is_premium' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    /**
     * Get the category that owns the template.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(TemplateCategory::class);
    }

    /**
     * Get the tags for the template.
     */
    public function tags(): HasMany
    {
        return $this->hasMany(TemplateTag::class);
    }

    /**
     * Get the user designs for the template.
     */
    public function userDesigns(): HasMany
    {
        return $this->hasMany(UserDesign::class);
    }
}
