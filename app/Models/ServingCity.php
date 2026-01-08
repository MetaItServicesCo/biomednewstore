<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServingCity extends Model
{
    protected $fillable = [
        // Hero Section
        'hero_title',
        'hero_subtitle',
        'slug',

        // City
        'city_name',
        'area_name',
        'show_on_header',
        'city_image',
        'city_image_alt',

        // Content Section
        'content_title',
        'gallery_images',
        'image_alt',
        'content_description',

        // How We Serve
        'serve_heading',
        'serve_description',

        // Status
        'is_active',

        // SEO Fields
        'meta_title',
        'meta_keywords',
        'meta_description',

        // Audit Fields
        'created_by',
        'updated_by',
    ];

    // JSON cast (important)
    protected $casts = [
        'gallery_images' => 'array',
        'is_active'      => 'boolean',
    ];

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
}
