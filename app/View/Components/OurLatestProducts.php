<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class OurLatestProducts extends Component
{
    public $latestProductCategories;
    public $initialProducts;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Get all active products initially (for "All" tab)
        $this->initialProducts = Product::where('is_active', true)
            ->select(['name', 'slug', 'short_description', 'price', 'discount_percent', 'sale_price', 'thumbnail', 'image_alt', 'rating', 'product_type'])
            ->latest()
            ->get(); // Get all products, not just 4
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.our-latest-products');
    }
}
