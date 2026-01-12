<div class="row g-4">
    @if ($products->count())
        @foreach ($products as $product)
            <div class="col-lg-4 col-md-6">
                <div class="productt-cardd">
                    <img src="{{ $product->thumbnail ? asset('storage/products/thumbnails/' . $product->thumbnail) : '' }}"
                        alt="{{ $product->image_alt ?? $product->name }}">

                    <div class="card-body p-2">
                        <div class="product-meta">
                            <div class="stars">
                                @php $rating = $product->rating ?? 0; @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating)
                                        <i class="fa-solid fa-star active"></i>
                                    @else
                                        <i class="fa-solid fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="stock">
                                @if ($product->in_stock)
                                    In Stock
                                    @if ($product->stock_qty)
                                        ({{ $product->stock_qty }})
                                    @endif
                                @else
                                    Out of Stock
                                @endif
                            </span>
                        </div>

                        <h6>{{ $product->name }}</h6>
                        <div class="price-row">
                            @if ($product->price && $product->price > 0)
                                <span class="old-price">${{ number_format($product->price, 2) }}</span>
                            @endif
                            <span class="new-price">${{ number_format($product->sale_price, 2) }}</span>
                            <button class="btn-buy" data-slug="{{ $product->slug ?? '' }}">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12 text-center text-muted">No Products Found</div>
    @endif
</div>