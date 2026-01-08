<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    // Fillable attributes
    protected $fillable = [
        'hero_heading',
        'hero_sd',
        'hero_slider_images',
        'hero_image_alt',
        'content_heading',
        'content_description',
        'content_slider_images',
        'content_image_alt',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    // Cast JSON columns to array automatically
    protected $casts = [
        'hero_slider_images' => 'array',
        'content_slider_images' => 'array',
    ];

    /**
     * Relations
     */

    // Creator
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Updater
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Deleter (soft delete)
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
