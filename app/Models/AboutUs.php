<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    // Fillable fields
    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'main_heading',
        'main_description',
        'stats',
        'stats_description',
        'image_1',
        'image_1_alt',
        'image_2',
        'image_2_alt',
        'value_section_heading',
        'value_section_description',
        'value_section_image',
        'value_section_image_alt',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'created_by',
        'updated_by',
    ];

    /**
     * Relations
     */

    // Created By relation
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Updated By relation
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
