<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';

    protected $fillable = [
        // Hero section
        'hero_title',
        'hero_subtitle',

        // Map
        'map_iframe',

        // What we offer section
        'offer_heading',
        'offer_description',
        'offers',

        // SEO
        'meta_title',
        'meta_keywords',
        'meta_description',

        // Audit
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'offers' => 'array',
    ];

    // User who created
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // User who updated
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
