<style>
    .category-slider-wrapper {
        max-width: 100%;
        /* overflow: hidden; */
        z-index: 1;
    }

    .category-slider {
        overflow: hidden;
        max-width: 1020px;
        /* 5 items only */
        margin: 0 auto;
        /* center slider */
    }


    .category-slider .row {
        flex-wrap: nowrap;
        transition: transform 0.4s ease;
    }

    /* Prev / Next buttons */
    .cat-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: none;
        background: #005884;
        color: #fff;
        font-size: 8px;
        cursor: pointer;
        z-index: 999;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease-in-out;
        cursor: pointer;
    }

    .cat-nav:hover {
        background: #004a6f;
    }

    .cat-nav.prev {
        left: 90px;
    }

    .cat-nav.next {
        right: 90px;
    }


    .cat-btn.active {
        background: #005884;
        color: #fff;
    }

    @media(max-width: 768px) {
        .cat-nav.next {
            right: -36px;
        }

        .cat-nav.prev {
            left: -36px;
        }
    }

    @media(max-width: 767px) {
        .cat-nav.next {
            right: -15px;
        }

        .cat-nav.prev {
            left: -15px;
        }

        .category-slider {
            overflow: hidden;
            max-width: 288px !important;
            margin: 0 auto;
        }
    }
</style>

<section class="best-selling-section mt-5 py-3">

    <div class="container">

        <h2 class="section-title mb-4">
            Best <span>Selling</span> Medical Equipment Essentials
        </h2>

        <!-- Search -->
        <div class="search-wrapper mb-4">
            <input type="text" id="bestSearchInput" class="search-input" placeholder="Search the store">
            <button class="search-btn">
                <i class="bi bi-search"></i>
            </button>
        </div>

        <!-- Category Buttons -->
        <div class="category-slider-wrapper position-relative mb-4">

            <!-- PREV -->
            <button class="cat-nav prev">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <!-- SLIDER -->
            <div class="category-slider">
                <div class="row g-2-4 flex-nowrap ">

                    <!-- ALL -->
                    <div class="col-auto">
                        <button class="cat-btn active" data-slug="all">All</button>
                    </div>

                    @foreach ($categories as $category)
                        <div class="col-auto">
                            <button class="cat-btn" data-slug="{{ $category->slug }}">
                                {{ $category->name }}
                            </button>
                        </div>
                    @endforeach

                </div>
            </div>

            <!-- NEXT -->
            <button class="cat-nav next">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

    </div>

    <!-- Products -->
    <section class="best-products mt-4">
        <div class="container">
            <div class="row g-4 justify-content-center" id="best-products-container">
                @include('partials.best-products', ['products' => $initialProducts])
            </div>

            <div class="text-center mt-5">
                <button class="all-products-btn">All Products</button>
            </div>
        </div>
    </section>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        if (window.bestSellingInitialized) return;
        window.bestSellingInitialized = true;

        const filterUrl = "{{ route('best.products.filter') }}";
        const container = document.getElementById('best-products-container');
        const searchInput = document.getElementById('bestSearchInput');

        function loadProducts(params = {}) {

            container.innerHTML = `
            <div class="col-12 text-center py-5">
                <div class="spinner-border"></div>
                <p class="mt-2">Loading...</p>
            </div>
        `;

            const query = new URLSearchParams(params).toString();

            fetch(`${filterUrl}?${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    container.innerHTML = data.html;

                    // Remove animation on AJAX load
                    container.querySelectorAll('.animate-card').forEach(card => {
                        card.classList.remove('animate-card');
                    });
                })
                .catch(() => {
                    container.innerHTML = `
                <div class="col-12 text-center text-danger py-5">
                    Failed to load products
                </div>
            `;
                });
        }

        // Category click
        document.querySelectorAll('.cat-btn').forEach(btn => {
            btn.addEventListener('click', function() {

                document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove(
                    'active'));
                this.classList.add('active');

                loadProducts({
                    category: this.dataset.slug,
                    search: searchInput.value
                });
            });
        });

        // Search
        // searchInput.addEventListener('keyup', function() {
        //     const activeCat = document.querySelector('.cat-btn.active').dataset.slug;
        //     loadProducts({
        //         category: activeCat,
        //         search: this.value
        //     });
        // });

        document.querySelector('.search-btn').addEventListener('click', function() {

            const activeCat = document.querySelector('.cat-btn.active')?.dataset.slug || 'all';

            loadProducts({
                category: activeCat,
                search: searchInput.value.trim()
            });
        });

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const sliderRow = document.querySelector('.category-slider .row');
        const items = document.querySelectorAll('.category-slider .col-auto');
        const prevBtn = document.querySelector('.cat-nav.prev');
        const nextBtn = document.querySelector('.cat-nav.next');

        let currentIndex = 0;
        let visibleItems = 6;

        function updateVisibleItems() {
            const width = window.innerWidth;
            if (width < 576) visibleItems = 2;
            else if (width < 768) visibleItems = 2;
            else if (width < 992) visibleItems = 3;
            else visibleItems = 6;
        }

        function updateSlider() {
            const itemWidth = items[0].offsetWidth + 24;
            const maxIndex = Math.max(items.length - visibleItems, 0);
            if (currentIndex > maxIndex) currentIndex = maxIndex;
            sliderRow.style.transform = `translateX(-${currentIndex * itemWidth}px)`;

            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex >= maxIndex;
        }

        nextBtn.addEventListener('click', () => {
            currentIndex++;
            updateSlider();
        });

        prevBtn.addEventListener('click', () => {
            currentIndex--;
            updateSlider();
        });

        window.addEventListener('resize', () => {
            updateVisibleItems();
            updateSlider();
        });

        updateVisibleItems();
        updateSlider();
    });
</script>
