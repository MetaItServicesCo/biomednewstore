<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RepairServiceSubPage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        // Basic Page Info
        'page_category',
        'title',
        'slug',
        'is_active',
        'short_description',

        // Content Section
        'content_title',
        'content_thumbnail',
        'content_image_alt',
        'gallery_images',
        'content_description',

        // How We Serve
        'serve_heading',
        'serve_description',

        // Benefits
        'benefits_heading',
        'benefits_description',

        // Challenges
        'challenges_image',
        'challenges_image_alt',
        'challenges_description',

        // CTA Section
        'cta_thumbnail',
        'cta_image_alt',
        'cta_description',

        // SEO Fields
        'meta_title',
        'meta_keywords',
        'meta_description',

        // Audit Fields
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_active' => 'boolean',
    ];


    // Who created the product
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Who last updated the product
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Who soft deleted the product
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
