@if ($products->count())
    @foreach ($products as $product)
        <div class="col-lg-3 col-md-6 col-sm-12 animate-card product-card-item"
            style="{{ $loop->index >= 4 ? 'display:none;' : '' }}">
            <div class="custom-card shadow-sm position-relative">
                <a href="{{ route('product-detail', $product->slug ?? '') }}"
                    class="stretched-link product-card-link"></a>

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
                            $rating = getProductRating($product);
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
                            <span
                                class="new-price fw-bolder fs-5 text-primary">${{ number_format($product->sale_price, 2) }}</span>
                        @endif
                        <button type="button" class="now-btnn">Buy Now</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- See More / Show Less button only for lg screens --}}
    @if ($products->count() > 4)
        <div class="col-12 text-center mt-3 d-none d-lg-flex justify-content-center">
            <!-- Icon Button -->
            <button type="button" class="see-more-products-btn" data-expanded="false">
                <i class="bi bi-chevron-down"></i>
            </button>
        </div>
    @endif
@else
    <div class="col-12 text-center py-5">
        <p class="text-muted">No products found.</p>
    </div>
@endif


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const seeMoreBtn = document.querySelector('.see-more-products-btn');
        if (!seeMoreBtn) return;

        const cards = document.querySelectorAll('.product-card-item');

        // Initially hide cards > 4 for LG screens only
        if (window.innerWidth >= 992) {
            cards.forEach((card, index) => {
                if (index >= 4) card.style.display = 'none';
            });
        }

        seeMoreBtn.addEventListener('click', () => {
            const expanded = seeMoreBtn.dataset.expanded === "true";

            if (!expanded) {
                cards.forEach(card => card.style.display = 'block');
                seeMoreBtn.dataset.expanded = "true";
            } else {
                cards.forEach((card, index) => {
                    if (index >= 4) card.style.display = 'none';
                });
                seeMoreBtn.dataset.expanded = "false";
            }
        });
    });
</script>
