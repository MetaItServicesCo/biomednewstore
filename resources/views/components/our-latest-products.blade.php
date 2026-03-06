@php

    $tabs = [
        ['label' => 'All', 'type' => 'all'],
        ['label' => 'Products', 'type' => 'product'],
        ['label' => 'Parts', 'type' => 'part'],
    ];
@endphp

@php
    $categories = $latestProductCategories ?? [];
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
            <div class="row g-4 d-none d-lg-flex" id="latest-products-containe">
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
        const container = section?.querySelector('#latest-products-container');
        const showMoreContainer = section?.querySelector('#show-more-container');
        const showMoreBtn = section?.querySelector('#show-more-btn');
        const filterUrl = "{{ route('latest.products.filter') }}";

        if (!section || !tabsWrapper || !container) return;

        let allProducts = []; // Store all fetched products
        let currentType = 'all'; // Current active type
        let showingAll = false; // Track if showing all or limited

        // Function to render products
        function renderProducts(products, limit = null) {
            const productsToShow = limit ? products.slice(0, limit) : products;

            if (productsToShow.length === 0) {
                container.innerHTML = `
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No products found.</p>
                    </div>
                `;
                showMoreContainer.style.display = 'none';
                return;
            }

            let html = '';
            productsToShow.forEach(product => {
                html += createProductCard(product);
            });
            container.innerHTML = html;

            // Show/hide "Show More" button
            if (products.length > 4) {
                showMoreContainer.style.display = 'block';
                if (limit && limit < products.length) {
                    showMoreBtn.innerHTML = '<i class="bi bi-chevron-down"></i>';
                    showingAll = false;
                } else {
                    showMoreBtn.innerHTML = '<i class="bi bi-chevron-up"></i>';
                    showingAll = true;
                }
            } else {
                showMoreContainer.style.display = 'none';
            }
        }

        // Function to create product card HTML
        function createProductCard(product) {
            const discountBadge = product.discount_percent > 0 ?
                `<span class="discount-badge">${product.discount_percent}% OFF</span>` :
                '';

            const thumbnail = product.thumbnail ?
                `{{ asset('storage/products/thumbnails/') }}/${product.thumbnail}` :
                '';

            const stars = generateStars(product.rating || 0);

            const shortDesc = product.short_description ?
                (product.short_description.length > 35 ?
                    product.short_description.substring(0, 35) + '...' :
                    product.short_description) :
                '';

            const oldPrice = product.price > 0 ?
                `<span class="old-price text-decoration-line-through text-muted small">$${Number(product.price).toFixed(2)}</span>` :
                '';

            const newPrice = product.sale_price > 0 ?
                `<span class="new-price fw-bolder fs-5 text-primary">$${Number(product.sale_price).toFixed(2)}</span>` :
                '';

            const productUrl = `{{ url('/category') }}/${product.slug || ''}`;

            return `
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="custom-card shadow-sm position-relative">
                        <a href="${productUrl}" class="stretched-link product-card-link"></a>
                        ${discountBadge}
                        <div class="card-image-box">
                            <img src="${thumbnail}" alt="${product.image_alt || ''}" class="img-fluid">
                        </div>
                        <div class="card-content-box p-3 pt-2">
                            <div class="stars p- pt-2 pb-0">
                                ${stars}
                            </div>
                            <h5 class="product-title fw-bold">${product.name || ''}</h5>
                            <p class="card-text small mb-3">${shortDesc}</p>
                            <div class="price-action-row d-flex justify-content-between align-items-center">
                                ${oldPrice}
                                ${newPrice}
                                <button type="button" class="btn buy-now-btn btn-sm">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // Function to generate star rating HTML
        function generateStars(rating) {
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    stars += '<i class="bi bi-star-fill gold"></i>';
                } else {
                    stars += '<i class="bi bi-star-fill"></i>';
                }
            }
            return stars;
        }

        // Initial check for show more button
        const initialProducts = @json($initialProducts ?? []);
        allProducts = initialProducts;

        if (initialProducts.length > 4) {
            showMoreContainer.style.display = 'block';
            showMoreBtn.innerHTML = '<i class="bi bi-chevron-down"></i>';
            showingAll = false;
        }

        // Show More/Less button click
        if (showMoreBtn) {
            showMoreBtn.addEventListener('click', function() {
                if (showingAll) {
                    renderProducts(allProducts, 4);
                } else {
                    renderProducts(allProducts, 8);
                }
            });
        }

        // Tab click handler
        tabsWrapper.addEventListener('click', function(e) {
            const btn = e.target.closest('button.filter-btn');
            if (!btn) return;

            const type = btn.dataset.type;
            if (!type) return;

            currentType = type;

            // Active state
            tabsWrapper.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('active');
            });
            btn.classList.add('active');

            // Loader
            container.innerHTML = `
                <div class="col-12 text-center py-5">
                    <div class="spinner-border"></div>
                    <p class="mt-2">Loading...</p>
                </div>
            `;
            showMoreContainer.style.display = 'none';

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
                    allProducts = data.products || [];
                    renderProducts(allProducts, 4);
                })
                .catch(() => {
                    container.innerHTML = `
                        <div class="col-12 text-center text-danger py-5">
                            Failed to load products
                        </div>
                    `;
                    showMoreContainer.style.display = 'none';
                });
        });

    });
</script>
