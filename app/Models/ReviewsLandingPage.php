<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewsLandingPage extends Model
{
    protected $fillable = [
        // Hero Section
        'hero_title',
        'hero_subtitle',

        // Main Content Section
        'main_heading',
        'main_description',
        'main_image',
        'main_image_alt',

        // CTA / Banner Section
        'cta_title',
        'cta_description',
        'cta_logo',
        'cta_logo_alt',

        // Testimonials Section
        'testimonial_heading',
        'testimonial_subheading',

        // SEO
        'meta_title',
        'meta_keywords',
        'meta_description',

        // Audit
        'created_by',
        'updated_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
