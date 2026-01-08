@if (isset($blogs) && $blogs->count() > 0)
    <section class="recent-news-section py- mb-5">
        <div class="container text-center">
            <h2 class="section-title text-white mb-3">Recent News</h2>
            <p class="section-desc  mb-5">
                Stay informed with the latest updates, innovations, and industry insights in biomedical equipment and healthcare technology.
            </p>
        </div>

        <div class="container">
            <div class="row g-4">
                @foreach ($blogs as $item)
                    <div class="col-lg-3 col-md-6 col-sm-12 animate-card">
                        <div class="news-card bg-white   ">
                            <img src="{{ $item->image ? asset('storage/blog/images/' . $item->image) : '' }}"
                                class="img-fluid w-100" alt="{{ $item->image_alt_text ?? '' }}">
                            <div class="p-3">
                                <h5 class="news-title fw-bold mt-2 mb-2">{{ \Illuminate\Support\Str::limit($item->title ?? '', 50) }}</h5>
                                <p class="news-desc small text-muted mb-3">
                                    {{ \Illuminate\Support\Str::limit($item->short_description ?? '', 120) }}
                                </p>

                                {{-- <p class="news-desc small text-muted mb-3">
                                    Understand the critical importance of robust cybersecurity measures in modern
                                    healthcare.
                                    Understand the critical importance of robust cybersecurity measures in modern
                                    healthcare.
                                </p> --}}
                                <a href="{{ route('blog.detail', $item->slug) }}"
                                    class="read-more-link d-flex align-items-center justify-content-start text-decoration-none">
                                    Read More <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
