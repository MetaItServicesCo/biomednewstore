@php
    $categories = $latestProductCategories ?? [];
@endphp

<section class="products-series-section py-5">
    <div class="container-fluid py-5 product-series-bg">
        <div class="container text-center">
            <p class="text-center  product-series-para  mb-3 fade-left">New From Mr Biomed Tech</p>
            <h2 class="text-center mb-5  product-section-heading fade-right">Our <span>Latest Products</span> </h2>

            <div class="product-filter-tabs mb-5 d-flex justify-content-center flex-wrap gap-2">

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
            <div class="row g-4" id="latest-products-container">
                @include('partials.latest-products', ['products' => $initialProducts])
            </div>
        </div>
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        // prevent double init
        if (window.latestProductsInitialized) return;
        window.latestProductsInitialized = true;

        const section = document.querySelector('.products-series-section');
        const tabsWrapper = section?.querySelector('.product-filter-tabs');
        const container = section?.querySelector('#latest-products-container');
        const filterUrl = "{{ route('latest.products.filter') }}";

        if (!section || !tabsWrapper || !container) return;

        // ✅ EVENT DELEGATION (SCOPED)
        tabsWrapper.addEventListener('click', function(e) {

            const btn = e.target.closest('button.filter-btn');
            if (!btn) return;

            const slug = btn.dataset.slug;
            if (!slug) return;

            // Active state only inside latest component
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

            fetch(`${filterUrl}?slug=${slug}`, {
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
                    container.innerHTML = data.html;

                    // remove animation on ajax load
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

        });

    });
</script>
