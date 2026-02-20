@php
    // Fixed tabs: All, Products, Parts
    $tabs = [
        ['label' => 'All', 'type' => 'all'],
        ['label' => 'Products', 'type' => 'product'],
        ['label' => 'Parts', 'type' => 'part'],
    ];
@endphp

<section class="products-series-section py-5">
    <div class="container-fluid py-4 product-series-bg">
        <div class="container text-center">
            <p class="text-center  product-series-para  mb-3 fade-left">New From Mr. Biomed Tech Services</p>
            <h2 class="text-center mb-2  product-section-heading fade-right">Our <span>Latest Products</span> </h2>

            <div class="product-filter-tabs mb- d-flex justify-content-center flex-wrap gap-2">

                {{-- <button class="filter-btn active" data-filter="featured">Featured</button>

                <button class="filter-btn" data-filter="equipment">Medical Equipment</button>
                <button class="filter-btn" data-filter="supplies">Supplies</button>
                <button class="filter-btn" data-filter="parts">Parts</button> --}}

                @foreach ($categories as $tab)
                    <button class="filter-btn {{ $loop->first ? 'active' : '' }}" data-slug="{{ $tab['slug'] }}">
                        {{ $tab['label'] }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="container mt-4">

            <!-- 🔹 Mobile + MD Slider -->
            <div class="swiper latestProductSwiper d-lg-none">
                <div class="swiper-wrapper">
                    @foreach ($initialProducts as $product)
                        <div class="swiper-slide">
                            @include('components.product-card', ['product' => $product])
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 🔹 LG Screen Normal Grid -->
            <div class="row g-4 d-none d-lg-flex" id="latest-products-container">
                @include('partials.latest-products', ['products' => $initialProducts])
            </div>

        </div>

    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        if (window.latestProductsInitialized) return;
        window.latestProductsInitialized = true;

        const section = document.querySelector('.products-series-section');
        const tabsWrapper = section?.querySelector('.product-filter-tabs');
        const lgContainer = section?.querySelector('#latest-products-container');
        const sliderContainer = section?.querySelector('.latestProductSwiper .swiper-wrapper');
        const filterUrl = "{{ route('latest.products.filter') }}";

        if (!section || !tabsWrapper || !lgContainer || !sliderContainer) return;

        // Helper: rebuild swiper slides from card markup to avoid broken structure
        const rebuildSwiperSlides = (html) => {
            const temp = document.createElement('div');
            temp.innerHTML = html;
            const cards = temp.querySelectorAll('.custom-card');

            sliderContainer.innerHTML = '';
            if (!cards.length) {
                sliderContainer.innerHTML = `<div class="swiper-slide">${html}</div>`;
                return;
            }

            cards.forEach(card => {
                const slide = document.createElement('div');
                slide.className = 'swiper-slide';
                slide.appendChild(card);
                sliderContainer.appendChild(slide);
            });
        };

        const initLatestProductAnimations = () => {
            const cards = lgContainer.querySelectorAll('.animate-card');
            if (!cards.length) return;

            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) return;

                    const card = entry.target;
                    if (card.classList.contains('show')) return;

                    const row = card.closest('.row');
                    const rowCards = row ? row.querySelectorAll('.animate-card') : cards;
                    const index = Array.from(rowCards).indexOf(card);
                    const delay = index * 380;

                    card.style.setProperty('--delay', `${delay}ms`);
                    card.classList.add('show');
                    obs.unobserve(card);
                });
            }, {
                threshold: 0.25
            });

            cards.forEach(card => observer.observe(card));
        };

        initLatestProductAnimations();

        tabsWrapper.addEventListener('click', function(e) {
            const btn = e.target.closest('button.filter-btn');
            if (!btn) return;

            const type = btn.dataset.type;
            if (!type) return;

            currentType = type;

            tabsWrapper.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Loader for both LG and slider
            lgContainer.innerHTML = sliderContainer.innerHTML = `
            <div class="col-12 text-center py-5">
                <div class="spinner-border"></div>
                <p class="mt-2">Loading...</p>
            </div>
        `;

            fetch(`${filterUrl}?type=${type}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(res => {
                    if (!res.ok) throw new Error('Request failed');
                    return res.json();
                })
                .then(data => {
                    // ✅ Update LG Grid
                    lgContainer.innerHTML = data.html;

                    initLatestProductAnimations();

                    // ✅ Update Swiper Slider (keep proper swiper-slide structure)
                    rebuildSwiperSlides(data.html);

                    // Destroy old Swiper instance (if exists)
                    if (window.latestSwiper) {
                        window.latestSwiper.destroy(true, true);
                    }

                    // Re-initialize Swiper only on mobile/tablet
                    if (window.innerWidth < 992) {
                        const updatedSlides = sliderContainer.querySelectorAll('.swiper-slide')
                            .length;
                        // Loop only when we have more slides than the current slidesPerView
                        const latestSlidesPerView = window.innerWidth >= 768 ? 2 : 1;
                        const shouldLoop = updatedSlides > latestSlidesPerView;

                        window.latestSwiper = new Swiper(".latestProductSwiper", {
                            loop: shouldLoop,
                            slidesPerView: 1,
                            spaceBetween: 15,
                            speed: 1000,
                            autoplay: {
                                delay: 3000,
                                disableOnInteraction: false,
                                pauseOnMouseEnter: true,
                            },
                            breakpoints: {
                                0: {
                                    slidesPerView: 1,
                                    spaceBetween: 10
                                },
                                768: {
                                    slidesPerView: 2,
                                    spaceBetween: 15
                                },
                            },
                        });
                    }

                })
                .catch(() => {
                    lgContainer.innerHTML = sliderContainer.innerHTML = `
                <div class="col-12 text-center text-danger py-5">
                    Failed to load products
                </div>
            `;
                });
        });

    });
</script>
