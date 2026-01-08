<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyCertification extends Model
{
    protected $fillable = [
        'title',
        'certificate',
        'certificate_alt',
        'created_by',
        'updated_by',
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
