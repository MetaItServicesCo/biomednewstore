<style>
    /* Fixed stray character before style tag to prevent broken markup rendering */
    /* Card remains same */
    /* .custom-card {
        background-color: #ffffff;
        border-radius: 12px;
        height: 380px;
        width: 100%;
        max-width: 260px;
        margin: 0 auto;
        transition: all 0.6s ease-in-out;
    }

    .custom-card:hover {
        transform: scale(1.08);
    } */

    /* Swiper spacing for mobile */
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

<script></script>
