<div class="col-lg-6 col-md-6 mb-4">

    <h3 class="product-name">{!! highlightBracketText($product->name ?? '') !!}</h3>

    <p class="product-desc">
        {!! $product->description !!}
    </p>

    <!-- BUTTONS -->
    <div class="d-flex gap-3 btn-wrraper">
        <button class="btn-service" data-open-form>
            <i class="bi bi-gear"></i>
            <span class="btn-label" data-slug="{{ $product->slug ?? '' }}">Get Service</span>
            {{-- <button class="buy-btn" data-slug="{{ $product->slug ?? '' }}" data-open-form>Get A Quote</button> --}}
        </button>

        <button class="btn-call">
            <i class="bi bi-telephone"></i>
            <span class="btn-label">Call Us</span>
        </button>
    </div>
</div>

<div class="col-lg-6 col-md-6">
    <div class="product-section">

        {{-- MAIN THUMBNAIL IMAGE --}}
        <div class="img-wrapper position-relative">
            <img src="{{ asset('storage/products/thumbnails/' . $product->thumbnail) }}"
                class="img-fluid rental-img mainProductImg active-img" alt="{{ $product->image_alt ?? '' }}">
            <button class="btn-overlay">Get For Rent</button>
        </div>

        {{-- PREPARE GALLERY --}}
        @php
            $gallery = [];

            if (is_string($product->gallery_images)) {
                $decoded = json_decode($product->gallery_images, true);
                $gallery = is_array($decoded) ? $decoded : [];
            } elseif (is_array($product->gallery_images)) {
                $gallery = $product->gallery_images;
            }

            // Build full image list = thumbnail + gallery
            $allImages = [];

            // Thumbnail first
            if ($product->thumbnail) {
                $allImages[] = 'products/thumbnails/' . $product->thumbnail;
            }

            // Then gallery
            foreach ($gallery as $img) {
                $allImages[] = 'products/gallery/' . $img;
            }
        @endphp

        {{-- DOTS --}}
        <div class="img-dots mt-3 text-center">
            @foreach ($allImages as $index => $imgPath)
                <span class="dot {{ $index == 0 ? 'active' : '' }}" data-img="{{ asset('storage/' . $imgPath) }}">
                </span>
            @endforeach
        </div>

    </div>
</div>
