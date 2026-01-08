{{-- resources/views/components/featured-blogs-section.blade.php --}}

@if ($featuredBlogs->count())
    <section class="featured-section container my-5">
        <h2 class="latest-blog-heading mb-4 text-center">
            Featured <span>Updates</span>
        </h2>

        <div class="row g-4 mt-4">
            @foreach ($featuredBlogs as $featuredBlog)
                <div class="col-lg-6">

                    <a href="{{ route('blog.detail', $featuredBlog->slug) }}" class="text-decoration-none">
                        <div class="featured-card d-flex">

                            <!-- Image -->
                            <img src="{{ $featuredBlog->image ? asset('storage/blog/images/' . $featuredBlog->image) : asset('frontend/images/placeholder.jpg') }}"
                                class="featured-img" alt="{{ $featuredBlog->image_alt_text ?? $featuredBlog->title }}">

                            <!-- Content -->
                            <div class="featured-content">

                                <!-- Category -->
                                @if ($featuredBlog->category)
                                    <div class="mb-2">
                                        <button class="cate-btn">{{ $featuredBlog->category->name }}</button>
                                    </div>
                                @endif

                                <!-- Title with Link -->
                                <h4 class="featured-title">
                                    <a href="{{ route('blog.detail', $featuredBlog->slug) }}"
                                        class="text-decoration-none text-dark">
                                        {{ \Illuminate\Support\Str::limit($featuredBlog->title ?? '', 70) }}
                                    </a>
                                </h4>

                                <!-- Description -->
                                <p class="featured-desc">
                                    {{ \Illuminate\Support\Str::limit($featuredBlog->short_description ?? '', 120) }}
                                </p>

                                <!-- Read Time -->
                                @if ($featuredBlog->read_time)
                                    <span class="read-time">{{ $featuredBlog->read_time }}</span>
                                @endif

                                <hr>

                                <!-- Footer -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="post-date">
                                        {{ $featuredBlog->updated_at?->format('d.M.Y') ?? '' }}
                                    </span>

                                    <div class="social-icons">
                                        @if (setting('facebook'))
                                            <a href="{{ setting('facebook') }}" target="_blank" aria-label="Facebook">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        @endif
                                        @if (setting('twitter'))
                                            <a href="{{ setting('twitter') }}" target="_blank" aria-label="Twitter">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        @endif

                                        @if (setting('linkedin'))
                                            <a href="{{ setting('linkedin') }}" target="_blank" aria-label="LinkedIn">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endif
