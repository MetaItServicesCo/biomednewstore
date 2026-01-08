<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiomedServices extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_subtitle',

        'intro_heading',
        'intro_text',
        'intro_image_1',
        'intro_image_1_alt',
        'intro_image_2',
        'intro_image_2_alt',

        'product_heading',

        'banner_heading',
        'banner_text',

        'service_heading',
        'service_sd',

        'service_cards',
        'service_images',

        'meta_title',
        'meta_keywords',
        'meta_description',

        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'service_cards'  => 'array',   // json → array
        'service_images' => 'array',   // json → array
    ];

    // optional: relations with users
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
