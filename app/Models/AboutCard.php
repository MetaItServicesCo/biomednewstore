<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutCard extends Model
{
    // Fillable fields
    protected $fillable = [
        'title',
        'slug',
        'description',
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
