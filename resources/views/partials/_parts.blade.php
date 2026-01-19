@foreach ($parts as $item)
    <div class="col-lg-3 col-md-6 animate-card">
        <div class="productt-cardd">
            <img src="{{ asset('storage/products/thumbnails/' . $item->thumbnail) }}" alt="{{ $item->image_alt }}"
                class="img-fluid">

            <div class="card-body p-2">
                <div class="product-meta">
                    <div class="stars">
                        @php
                            $rating = $item->rating ?? 0; // rating 0-5
                        @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $rating)
                                <i class="fa-solid fa-star active"></i>
                            @else
                                <i class="fa-solid fa-star"></i>
                            @endif
                        @endfor
                    </div>

                    <span class="stock">In Stock</span>
                </div>

                <h6>{{ $item->name }}</h6>

                <div class="price-row">
                    @if (!empty($item->price) && $item->price > 0)
                        <span class="old-price">${{ number_format($item->price) }}</span>
                    @endif
                    <span class="new-price">${{ number_format($item->sale_price) }}</span>
                    <a href="{{ route('part-detail', $item->slug) }}">
                        <button class="btn-buy">Buy Now</button>
                    </a>
                </div>
            </div>
        </div>

    </div>
@endforeach
