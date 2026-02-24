@if (isset($brands) && $brands->count() > 0)
    <section class="brand-s">
        <div class="brand-slider container">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    @foreach ($brands as $brand)
                        <div class="swiper-slide">
                                <img src="{{ asset('storage/brands-we-carry/' . $brand->logo) }}"
                                    alt="{{ $brand->logo_alt ?? '' }}" class="img-fluid">
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endif
