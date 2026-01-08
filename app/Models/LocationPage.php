<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationPage extends Model
{
    protected $table = 'location_pages';

    protected $fillable = [
        // ===== Hero Section =====
        'hero_title',
        'hero_subtitle',

        // ===== Areas We Serve Section =====
        'areas_title',
        'areas_description',

        // ===== Major Cities Section =====
        'cities_section_title',

        // ===== How We Serve =====
        'serve_heading',
        'serve_description',

        // ===== Contact Us =====
        'contact_us_description',

        // ===== Form Section =====
        'form_title',
        'form_description',

        // ===== SEO Fields =====
        'meta_title',
        'meta_keywords',
        'meta_description',

        // ===== Audit Fields =====
        'created_by',
        'updated_by',
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
