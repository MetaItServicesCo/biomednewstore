<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    // Fillable fields
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'is_active',
        'image',
        'image_alt_text',
        'short_description',
        'description',
        'type',
        'read_time',

        // SEO fields
        'meta_title',
        'meta_keywords',
        'meta_description',

        // User tracking
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    // Relationships

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_id');
    }


    // Creator of the blog
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Last updater of the blog
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Who deleted the blog (if soft deleted)
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
