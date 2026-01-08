<section class="latest-updates py-5">
    <div class="container">
        <h2 class="text-center latest-blog-heading mb-4">
            Latest <span>Updates</span>
        </h2>

        <div class="category-slider-wrapper mt-5">
            <button class="cat-bttn prev-btn">&#10094;</button>
            <div class="category-slider">
                <div class="cat-item active" data-slug="all">All Blogs</div>
                @foreach ($categories as $category)
                    <div class="cat-item" data-slug="{{ $category->slug }}">{{ $category->name }}</div>
                @endforeach
            </div>
            <button class="cat-bttn next-btn">&#10095;</button>
        </div>
    </div>

    <div class="container mt-5">
        <div id="blogs-container" class="row g-4">
            @include('partials.blog-cards', ['blogs' => $blogs])
        </div>

        <div class="mt-4" id="blogs-pagination-container">
            {{ $blogs->links('vendor.pagination.blogs-pagination') }}
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.blogTabsInitialized) return;
        window.blogTabsInitialized = true;

        const container = document.getElementById('blogs-container');
        const paginationContainer = document.getElementById('blogs-pagination-container');
        const filterUrl = "{{ route('blogs.filter') }}";
        let activeSlug = 'all';

        function fetchBlogs(slug, page = 1) {
            activeSlug = slug;
            container.innerHTML = `
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary"></div>
                <p class="mt-2">Loading blogs...</p>
            </div>
        `;

            fetch(`${filterUrl}?slug=${slug}&page=${page}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    container.innerHTML = data.html;
                    paginationContainer.innerHTML = data.pagination;
                })
                .catch(() => {
                    container.innerHTML = `
                <div class="col-12 text-center text-danger py-5">
                    Failed to load blogs.
                </div>
            `;
                });
        }

        /* FIX: Pagination Event Delegation */
        paginationContainer.addEventListener('click', function(e) {
            const link = e.target.closest('.page-link');
            if (!link) return;

            e.preventDefault();

            const page = link.dataset.page;
            if (page) {
                fetchBlogs(activeSlug, page);
            }
        });

        /* Category click */
        document.querySelectorAll('.cat-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.cat-item').forEach(i => i.classList.remove(
                    'active'));
                this.classList.add('active');
                fetchBlogs(this.dataset.slug, 1);
            });
        });
    });
</script>
