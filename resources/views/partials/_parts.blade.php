@foreach ($parts as $item)
    <div class="col-lg-3 col-md-6 animate-card">
    <a href="{{ route('part-detail', $item->slug) }}">
        <div class="productt-cardd">
            <img src="{{ asset('storage/products/thumbnails/' . $item->thumbnail) }}" alt="{{ $item->image_alt }}"
                class="img-fluid">

            <div class="card-body p-2">
                <div class="product-meta">
                    <div class="stars">
                        @php
                            $rating = getProductRating($item); // helper call
                        @endphp

                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $rating)
                                <i class="fa-solid fa-star active"></i>
                            @else
                                <i class="fa-solid fa-star"></i>
                            @endif
                        @endfor
                    </div>

                    <span class="stock">
                        @if ($item->in_stock)
                            In Stock
                            @if ($item->stock_qty)
                                ({{ $item->stock_qty }})
                            @endif
                        @else
                            Out of Stock
                        @endif
                    </span>
                </div>

                <h6>{{ $item->name }}</h6>

                <div class="price-row">
                    @if (!empty($item->price) && $item->price > 0)
                        <span class="old-price text-decoration-line-through">${{ number_format($item->price, 2) }}</span>
                    @endif
                    <span class="new-price">${{ number_format($item->sale_price, 2) }}</span>
                    {{-- <a href="{{ route('part-detail', $item->slug) }}"> --}}
                        <button class="btn-buy" @if (!$item->in_stock) disabled class="disabled-btn" @endif>
                            {{ $item->in_stock ? 'Buy Now' : 'Out of Stock' }}
                        </button>
                    {{-- </a> --}}
                </div>
            </div>
        </div>
    </a>
    </div>
@endforeach
