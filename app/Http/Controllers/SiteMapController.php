<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class SiteMapController extends Controller
{
    //
     public function index()
    { 
        $urls = [];

        // Static pages
        $staticPages = [
            ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => route('products'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('parts'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('feedback'), 'priority' => '0.9', 'changefreq' => 'weekly'],

        ];

        foreach ($staticPages as $page) {
            $urls[] = [
                'loc' => $page['url'],
                'lastmod' => Carbon::now()->toAtomString(),
                'changefreq' => $page['changefreq'],
                'priority' => $page['priority'],
            ];
        }

        // Product pages
        try {
            $products = Product::where('is_active', true)->get();
            foreach ($products as $product) {
                $path = strtolower($product->product_type) === 'part'
                    ? "parts/{$product->slug}"
                    : "products/{$product->slug}";

                $urls[] = [
                    'loc' => url($path),
                    'lastmod' => $product->updated_at->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.8',
                ];
            }
        } catch (\Exception $e) {
            \Log::warning('Sitemap: Error fetching product pages', ['error' => $e->getMessage()]);
        }

  
        return response()->view('sitemap', ['urls' => $urls], 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
        ]);
    }
}
