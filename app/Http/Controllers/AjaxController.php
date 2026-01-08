<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    // AjaxController.php (ya koi common controller)
    public function filterRentalProducts(Request $request)
    {
        $slug = $request->slug;

        $map = [
            'featured'          => 'Featured',
            'medical-equipment' => 'Medical Equipment',
            'supplies'          => 'Supplies',
            'parts'             => 'Parts',
        ];

        $name = $map[$slug] ?? null;
        if (!$name) return response()->json(['html' => 'Invalid']);

        $category = Category::where('name', $name)->first(['id']);
        if (!$category) return response()->json(['html' => '<div class="col-12 text-center py-5">No Product found.</div>']);

        $products = Product::where('is_active', true)
            ->whereIn('type', ['for_rent', 'both'])
            ->where('category_id', $category->id)
            ->select(['name', 'slug', 'short_description', 'description', 'price', 'thumbnail', 'image_alt'])
            ->latest()
            ->get();

        $html = view('partials.rental-products', compact('products'))->render();

        return response()->json(['html' => $html]);
    }
}
