<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use UploadImageTrait;

    public function index(ProductDataTable $dataTable)
    {
        $this->authorize('read product');

        return $dataTable->render('pages.products.index');
    }

    public function create()
    {
        $this->authorize('create product');

        $categories = Category::where('status', true)->get();

        return view('pages.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('create product');

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'sku' => 'nullable|string|unique:products,sku',
            'type' => 'required|string',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_qty' => 'nullable|integer|min:0',
            'in_stock' => 'required|boolean',
            'is_active' => 'required|boolean',
            'show_on_header' => 'required|boolean',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
            'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
            'image_alt' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',

            'condition' => 'nullable',
            'rating' => 'nullable|integer|min:1|max:5',
            'availability' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'brochures' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'product_type' => 'required|in:product,part',
        ]);

        DB::beginTransaction();

        try {
            $product = new Product;
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->slug = Str::slug($request->slug);
            $product->sku = $request->sku;
            $product->type = $request->type;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount_percent = $request->discount_percent;

            // Sale Price
            $product->sale_price = $request->sale_price;

            $product->stock_qty = $request->stock_qty ?? 0;
            $product->in_stock = $request->in_stock;
            $product->is_active = $request->is_active;
            $product->show_on_header = $request->show_on_header;

            $product->condition = $request->condition;
            $product->rating = $request->rating;
            $product->availability = $request->availability;
            $product->model = $request->model;
            $product->product_type = $request->product_type;

            $product->brochures = $this->uploadImage($request->file('brochures'), 'products/brochures');

            // Thumbnail
            $product->thumbnail = $this->uploadImage($request->file('thumbnail'), 'products/thumbnails');

            // Gallery
            if ($request->hasFile('gallery_images')) {
                $gallery = [];
                foreach ($request->file('gallery_images') as $image) {
                    $gallery[] = $this->uploadImage($image, 'products/gallery');
                }
                $product->gallery_images = json_encode($gallery);
            }

            $product->image_alt = $request->image_alt;
            // SEO
            $product->meta_title = $request->meta_title;
            $product->meta_keywords = $request->meta_keywords;
            $product->meta_description = $request->meta_description;

            // Audit
            $product->created_by = Auth::id();

            $product->save();
            DB::commit();

            return redirect()->route('admin-products.list')->with('success', 'Product created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error
            Log::error('Product Store Error: '.$e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(Product $product)
    {
        $this->authorize('write product');

        try {
            $categories = Category::where('status', true)->get();

            return view('pages.products.create', [
                'data' => $product, // blade me $data ke naam se access ho
                'categories' => $categories,
            ]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Product Edit Error: '.$e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'product_id' => $product->id,
            ]);

            // Redirect back with error message
            return redirect()->route('admin-products.list')
                ->withErrors(['error' => 'Something went wrong while loading the product. Please check the logs.']);
        }
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('write product');

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,'.$product->id,
            'sku' => 'nullable|string|unique:products,sku,'.$product->id,
            'type' => 'required|string',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_qty' => 'nullable|integer|min:0',
            'in_stock' => 'required|boolean',
            'is_active' => 'required|boolean',
            'show_on_header' => 'required|boolean',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300', // 300 KB
            'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300', // 300 KB
            'image_alt' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',

            'condition' => 'nullable',
            'rating' => 'nullable|integer|min:1|max:5',
            'availability' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'brochures' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'product_type' => 'required|in:product,part',

        ]);

        DB::beginTransaction();

        try {
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->slug = Str::slug($request->slug);
            $product->sku = $request->sku;
            $product->type = $request->type;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount_percent = $request->discount_percent;

            // Sale Price
            $product->sale_price = $request->sale_price;

            $product->stock_qty = $request->stock_qty ?? 0;
            $product->in_stock = $request->in_stock;
            $product->is_active = $request->is_active;
            $product->show_on_header = $request->show_on_header;

            $product->condition = $request->condition;
            $product->rating = $request->rating;
            $product->availability = $request->availability;
            $product->model = $request->model;
            $product->product_type = $request->product_type;

            $product->brochures = $this->updateImage($request, 'brochures', 'products/brochures', $product->brochures);

            // Thumbnail image update
            $product->thumbnail = $this->updateImage($request, 'thumbnail', 'products/thumbnails', $product->thumbnail);

            // Gallery images update (append new, keep old)
            $existingGallery = is_array($product->gallery_images)
                ? $product->gallery_images
                : json_decode($product->gallery_images, true) ?? [];

            if ($request->hasFile('gallery_images')) {
                $existingGallery = $this->uploadMultipleImages($existingGallery, $request->file('gallery_images'), 'products/gallery');
            }

            $product->gallery_images = json_encode($existingGallery);

            $product->image_alt = $request->image_alt;
            // SEO
            $product->meta_title = $request->meta_title;
            $product->meta_keywords = $request->meta_keywords;
            $product->meta_description = $request->meta_description;

            // Audit
            $product->updated_by = Auth::id();

            $product->save();
            DB::commit();

            return redirect()->route('admin-products.list')->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error
            Log::error('Product Update Error: '.$e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
                'product_id' => $product->id,
            ]);

            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function removeGalleryImage(Request $request)
    {
        // Validate input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'image' => 'required|string',
        ]);

        // Find product
        $product = Product::findOrFail($request->product_id);

        // Decode existing gallery images
        $galleryImages = json_decode($product->gallery_images, true) ?? [];

        if (! in_array($request->image, $galleryImages)) {
            return response()->json([
                'success' => false,
                'message' => 'Image not found in this product.',
            ]);
        }

        // Remove image from array
        $galleryImages = array_filter($galleryImages, fn ($img) => $img !== $request->image);

        // Save updated JSON
        $product->gallery_images = json_encode(array_values($galleryImages));
        $product->save();

        // Delete image from storage
        if (Storage::exists('public/products/gallery/'.$request->image)) {
            Storage::delete('public/products/gallery/'.$request->image);
        }

        // Return JSON with success message
        return response()->json([
            'success' => true,
            'message' => 'Image has been removed successfully.',
        ]);
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete product');

        DB::beginTransaction();

        try {
            $authId = Auth::id();

            if ($product->trashed()) {
                // Soft delete scenario: just update deleted_by
                $product->deleted_by = $authId;
                $product->save();
            } else {
                // Hard delete: remove images
                // Delete Thumbnail
                if ($product->thumbnail && Storage::disk('public')->exists('products/thumbnails/'.$product->thumbnail)) {
                    Storage::disk('public')->delete('products/thumbnails/'.$product->thumbnail);
                }

                // Delete Gallery Images
                if ($product->gallery_images) {
                    $galleryImages = is_array($product->gallery_images) ? $product->gallery_images : json_decode($product->gallery_images, true);
                    if ($galleryImages && count($galleryImages) > 0) {
                        foreach ($galleryImages as $image) {
                            if (Storage::disk('public')->exists('products/gallery/'.$image)) {
                                Storage::disk('public')->delete('products/gallery/'.$image);
                            }
                        }
                    }
                }

                // Set deleted_by for record and hard delete
                $product->deleted_by = $authId;
                $product->save();

                $product->forceDelete(); // Hard delete
            }

            DB::commit();

            return redirect()->route('admin-products.list')->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Product Delete Error: '.$e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'product_id' => $product->id,
            ]);

            return back()->withErrors(['error' => 'Failed to delete the product: '.$e->getMessage()]);
        }
    }

    public function products()
    {
        try {
            // Categories to exclude
            $excluded = ['parts', 'featured'];

            // Get categories with products
            $categories = Category::where('status', true) // active categories
                ->whereNotIn('slug', $excluded)          // exclude specific slugs
                ->with(['products' => function ($query) {
                    $query->where('is_active', true)
                        ->where('product_type', 'product')
                        ->whereIn('type', ['for_store', 'both'])
                        ->orderBy('name', 'asc'); // order products by name
                }])
                ->select(['id', 'name', 'slug']) // id is required for relation
                ->orderBy('name', 'asc')         // order categories by name
                ->get();

            // All active products (for store + both) with pagination
            $allProducts = Product::where('is_active', true)
                ->where('product_type', 'product')
                ->whereIn('type', ['for_store', 'both'])
                ->orderBy('name', 'asc')
                ->paginate(15); // 15 products per page

            $recentProducts = Product::where('is_active', true)
                ->where('product_type', 'product')
                ->whereIn('type', ['for_store', 'both'])
                ->orderBy('created_at', 'desc')
                ->limit(4)
                ->get();
            $faqs = getFaqs('products');

            // Return view with data
            return view('frontend.pages.product-list', compact('categories', 'allProducts', 'faqs', 'recentProducts'));
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle database query errors
            Log::error('Database Query Error in Products Page: '.$e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong while fetching products. Please try again later.');
        } catch (\Exception $e) {
            // Handle any other errors
            Log::error('Error in Products Page: '.$e->getMessage());

            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }

    // AJAX Filter
    public function productsFilter(Request $request)
    {
        try {
            $min = (float) ($request->min_price ?? 0);
            $max = (float) ($request->max_price ?? 50000);
            $search = trim($request->search ?? '');

            if ($min > $max) {
                [$min, $max] = [$max, $min];
            }

            $query = Product::where('is_active', true)
                ->where('product_type', 'product')
                ->whereIn('type', ['for_store', 'both']);

            // 🔍 Search
            if ($search !== '') {
                $query->where('name', 'like', "%{$search}%");
            }
            // 💰 Filter only when no search
            else {
                $query->whereBetween('sale_price', [$min, $max]);
            }

            $products = $query->orderBy('name', 'asc')->paginate(15);

            return response()->json([
                'html' => view('partials._products', compact('products'))->render(),
                'pagination' => view('vendor.pagination._pagination', compact('products'))->render(),
            ]);
        } catch (\Exception $e) {
            Log::error('Product Filter Error', ['msg' => $e->getMessage()]);

            return response()->json(['error' => true], 500);
        }
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->first();
        $faqs = getFaqs('products');

        return view('frontend.pages.product-detail', compact('product', 'faqs'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Stock validation
        if ($request->qty > $product->stock_qty) {
            return response()->json([
                'success' => false,
                'message' => 'Only '.$product->stock_qty.' items available in stock.',
            ], 422);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $newQty = $cart[$product->id]['qty'] + $request->qty;
            if ($newQty > $product->stock_qty) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maximum stock limit reached.',
                ], 422);
            }

            $cart[$product->id]['qty'] = $newQty;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->sale_price,
                'qty' => $request->qty,
                'image' => $product->thumbnail,
                'slug' => $product->slug,
                'stock_qty' => $product->stock_qty, // <-- add stock here
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => $product->name.' added in cart',
            'cart' => $cart,
        ]);
    }

    public function cart()
    {
        return view('frontend.pages.cart');
    }

    public function clearCart(Request $request)
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Shopping cart cleared successfully',
        ]);
    }

    public function removeCartItem(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = session('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart',
        ]);
    }

    public function updateCartQuantity(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session('cart', []);

        // Check if product is in cart
        if (! isset($cart[$product->id])) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in cart',
            ], 404);
        }

        // Validate stock
        if ($request->qty > $product->stock_qty) {
            return response()->json([
                'success' => false,
                'message' => 'Only '.$product->stock_qty.' items available in stock.',
            ], 422);
        }

        // Update quantity and refresh stock from database
        $cart[$product->id]['qty'] = $request->qty;
        $cart[$product->id]['stock_qty'] = $product->stock_qty; // Refresh stock data
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Quantity updated successfully',
            'cart' => $cart,
        ]);
    }

    public function order()
    {
        try {
            $cart = session('cart', []);

            // If cart is empty → redirect to products page
            if (empty($cart)) {
                return redirect()
                    ->route('products')
                    ->with('error', 'Your cart is empty. Please add products first.');
            }

            $countries = Country::where('is_active', 1)
                ->orderBy('name', 'asc')
                ->get();

            return view('frontend.pages.billing', compact('countries'));
        } catch (\Throwable $e) {

            // Log the error for debugging
            Log::error('Error while opening billing page', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'user_id' => auth()->id(),
            ]);

            // Redirect user safely
            return redirect()
                ->route('products')
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function parts()
    {
        $parts = Product::where('is_active', true)
            ->where('product_type', 'part')
            // ->whereIn('type', ['for_store', 'both'])
            ->orderBy('name', 'asc')
            ->get();

        return view('frontend.pages.parts', compact('parts'));
    }
}
