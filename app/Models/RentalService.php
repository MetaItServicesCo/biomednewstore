<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalService extends Model
{
    // Fillable fields
    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'main_heading',
        'main_description',
        'main_image',
        'main_image_alt',
        'equipment_heading',
        'equipment_list',
        'why_rent_heading',
        'why_rent_list',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'created_by',
        'updated_by',
    ];

    /**
     * Relation: who created this record
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relation: who last updated this record
     */
    public function updateBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
