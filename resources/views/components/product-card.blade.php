{{-- <style>
  
    .latestProductSwiper {
        padding: 20px 0 20px;
    }
</style>

<div class="custom-card shadow-sm position-relative">
    @if ($product->discount_percent > 0)
        <span class="discount-badge">{{ $product->discount_percent }}% OFF</span>
    @endif

    <div class="card-image-box">
        <img src="{{ $product->thumbnail ? asset('storage/products/thumbnails/' . $product->thumbnail) : '' }}"
            alt="{{ $product->image_alt ?? '' }}" class="img-fluid">
    </div>

    <div class="card-content-box p-3 pt-2">
        <div class="rating-stars pt-2 pb-0">
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
        </div>

        <h5 class="product-title fw-bold">{!! plainBracketText($product->name ?? '') !!}</h5>
        <p class="card-text small mb-3">
            {{ \Illuminate\Support\Str::limit($product->short_description ?? '', 35) }}
        </p>

        <div class="price-action-row d-flex justify-content-between align-items-center">
            @if ($product->price > 0)
                <span class="old-price text-decoration-line-through text-muted small">
                    ${{ number_format($product->price) }}
                </span>
            @endif

            @if ($product->sale_price > 0)
                <span class="new-price fw-bolder fs-5 text-primary">
                    ${{ number_format($product->sale_price) }}
                </span>
            @endif

            <a href="javascript:void(0)" class="btn buy-now-btn btn-sm" data-slug="{{ $product->slug ?? '' }}"
                data-open-form>Get A Quote</a>
        </div>
    </div>

</div>

<script></script> --}}

<style>
    .latestProductSwiper {
        padding: 20px 0 20px;
    }
</style>
{{-- 
<div class="custom-card shadow-sm position-relative">
    @if ($product->discount_percent > 0)
        <span class="discount-badge">{{ $product->discount_percent }}% OFF</span>
    @endif

    <div class="card-image-box">
        <img src="{{ $product->thumbnail ? asset('storage/products/thumbnails/' . $product->thumbnail) : '' }}"
            alt="{{ $product->image_alt ?? '' }}" class="img-fluid">
    </div>

    <div class="card-content-box p-3 pt-2">
        <div class="rating-stars pt-2 pb-0">
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
        </div>

        <h5 class="product-title fw-bold">{!! plainBracketText($product->name ?? '') !!}</h5>
        <p class="card-text small mb-3">
            {{ \Illuminate\Support\Str::limit($product->short_description ?? '', 35) }}
        </p>

        <div class="price-action-row d-flex justify-content-between align-items-center">
            @if ($product->price > 0)
                <span class="old-price text-decoration-line-through text-muted small">
                    ${{ number_format($product->price) }}
                </span>
            @endif

            @if ($product->sale_price > 0)
                <span class="new-price fw-bolder fs-5 text-primary">
                    ${{ number_format($product->sale_price) }}
                </span>
            @endif

            <a href="javascript:void(0)" class=" buy-now-btnn " data-slug="{{ $product->slug ?? '' }}"
                data-open-form>Get A Quote</a>
        </div>
    </div>

</div> --}}
<div class="custom-card shadow-sm position-relative">
    <a href="{{ route('product-detail', $product->slug ?? '') }}" class="stretched-link product-card-link"></a>
    @if ($product->discount_percent > 0)
        <span class="discount-badge">{{ $product->discount_percent }}% OFF</span>
    @endif

    <div class="card-image-box">
        <img src="{{ $product->thumbnail ? asset('storage/products/thumbnails/' . $product->thumbnail) : '' }}"
            alt="{{ $product->image_alt ?? '' }}" class="img-fluid custtom-imgg">
    </div>


    <div class="card-content-box p-3 pt-2">
        <div class="stars p- pt-2 pb-0">
            @php
                $rating = getProductRating($product); // helper call
            @endphp

            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $rating)
                    <i class="bi bi-star-fill gold"></i>
                @else
                    <i class="bi bi-star-fill"></i>
                @endif
            @endfor
        </div>
        <h5 class="product-title fw-bold">{{ $product->name ?? '' }}</h5>
        <p class="card-text small mb-3">
            {{ \Illuminate\Support\Str::limit($product->short_description ?? '', 35) }}</p>

        <div class="price-action-row d-flex justify-content-between align-items-center">

            @if (!empty($product->price) && $product->price > 0)
                <span
                    class="old-price text-decoration-line-through text-muted small">${{ number_format($product->price, 2) }}</span>
            @endif
            @if (!empty($product->sale_price) && $product->sale_price > 0)
                <span class="new-price fw-bolder fs-5 text-primary">${{ number_format($product->sale_price, 2) }}</span>
            @endif
            <button type="button" class="now-btnn">Buy Now</button>
        </div>
    </div>
</div>
<script></script>
