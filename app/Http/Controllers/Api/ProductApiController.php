<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * Categories for slider
     */
    public function categories()
    {
        $categories = Category::where('status', true)
            ->whereHas('products', function ($q) {
                $q->where('is_active', true)
                    ->whereIn('type', ['for_store', 'both']);
            })
            ->select('id', 'name', 'slug')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }


    /**
     * Products (All / Category / Search)
     */
    public function products(Request $request)
    {
        $query = Product::where('is_active', true)
            ->whereIn('type', ['for_store', 'both']);

        // Category filter
        if ($request->filled('category') && $request->category !== 'all') {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Smart search (product + category)
        if ($request->filled('search')) {
            $search = $request->search;

            $categoryIds = Category::where('name', 'like', "%{$search}%")
                ->pluck('id')
                ->toArray();

            $query->where(function ($q) use ($search, $categoryIds) {
                $q->where('name', 'like', "%{$search}%");

                if (!empty($categoryIds)) {
                    $q->orWhereIn('category_id', $categoryIds);
                }
            });
        }

        $products = $query
            ->latest()
            ->take(16)
            ->get([
                'name',
                'slug',
                'short_description',
                'price',
                'discount_percent',
                'sale_price',
                'thumbnail',
                'image_alt'
            ]);

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }
}
