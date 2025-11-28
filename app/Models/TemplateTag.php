<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TemplateTag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'template_id',
        'tag_name',
    ];

    /**
     * Get the template that owns the tag.
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }
}