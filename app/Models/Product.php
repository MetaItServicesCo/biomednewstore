<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'type',
        'short_description',
        'description',
        'price',
        'discount_percent',
        'sale_price',
        'stock_qty',
        'in_stock',
        'thumbnail',
        'gallery_images',
        'image_alt',
        'is_active',
        'show_on_header',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'created_by',
        'updated_by',
        'deleted_by',

        'condition',
        'availability',
        'rating',
        'brochures',
        'model',
        'product_type'
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'in_stock' => 'boolean',
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

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

    // Who soft deleted the product
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
