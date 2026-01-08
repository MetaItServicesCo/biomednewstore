<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportantLinks extends Model
{
    protected $fillable = [
        'for_page',
        'title',
        'subtitle',
        'button_text',
        'icon',
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
