<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeaturedProductsSection extends Component
{
    public $p;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->p = Product::select([
            'id',
            'name',
            'slug',
            'short_description',
            'price',
            'discount_percent',
            'sale_price',
            'thumbnail',
            'image_alt',
            'rating',
        ])
            ->where('is_active', true)
            ->where('product_type', 'product')
            ->where('is_featured', 'yes')
            ->whereIn('type', ['for_store', 'both'])
            ->latest()
            ->take(16)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.featured-products-section');
    }
}
