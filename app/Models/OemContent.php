<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OemContent extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'order',
        'image',
        'image_alt',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'description',
        'created_by',
        'updated_by',
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
}
