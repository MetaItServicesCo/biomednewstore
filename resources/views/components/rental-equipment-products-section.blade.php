<div class="row pb-3 pt-0 mt-0">
    <h3 class="rental-heading fade-left">Rental <span>Equipment</span> </h3>

    <div class="product-filter-tabs  d-flex justify-content-center flex-wrap gap-2 mt-4">

        @foreach ($staticCategories as $tab)
            <button class="filter-btn {{ $loop->first ? 'active' : 'text-dark' }}" data-filter="{{ $tab['slug'] }}">
                {{ $tab['label'] }}
            </button>
        @endforeach
    </div>
</div>
<section class="rental-section bg-white ">
    <div class="container">
        <div id="rental-products-container" class="row">
            @if (!empty($initialProducts) && $initialProducts->count())
                @include('partials.rental-products', ['products' => $initialProducts])
            @else
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No rental products available.</p>
                </div>
            @endif
        </div>
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const filterUrl = "{{ route('rentals.filter') }}";
        const wrapper = document.querySelector('.product-filter-tabs');
        const container = document.getElementById('rental-products-container');

        if (!wrapper || !container) return;

        wrapper.addEventListener('click', function(e) {

            const btn = e.target.closest('button.filter-btn');
            if (!btn) return;

            const slug = btn.dataset.filter; // ✅ SAFE

            if (!slug) {
                console.error('Slug missing', btn);
                return;
            }

            wrapper.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('active');
                b.classList.add('text-dark');
            });

            btn.classList.add('active');
            btn.classList.remove('text-dark');

            container.innerHTML = `
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary"></div>
                <p class="mt-3">Loading products...</p>
            </div>
        `;

            fetch(`${filterUrl}?slug=${slug}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
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
                    container.innerHTML = `<p class="text-danger text-center">Failed to load</p>`;
                });

        });

    });
</script>
