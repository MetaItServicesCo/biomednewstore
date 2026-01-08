<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandWeCarry extends Model
{
    protected $fillable = [
        'company_name',
        'logo',
        'logo_alt',
        'website',
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
