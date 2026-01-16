<?php

namespace App\View\Components;

use App\Models\Offer;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OffersSection extends Component
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
            ->where('is_active', true)->where('product_type', 'product')
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
        return view('components.offers-section');
    }
}
