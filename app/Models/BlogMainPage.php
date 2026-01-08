<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogMainPage extends Model
{
    protected $fillable = [
        'heading',
        'short_description',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'created_by',
        'updated_by',
    ];
}
