@foreach ($sections as $section)
    @if (
        $section['items']->isNotEmpty() ||
            filled($section['shortDescription']) ||
            filled($section['headingData']['first_text'] ?? ''))
        <section class="xray-section py-5">
            <div class="container-fluid xray-box p-4 mt-5">
                <div class="container text-center mb-5">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <h2 class="main-heading fade-left">
                                {{ $section['headingData']['first_text'] ?? '' }}
                                <span>{{ $section['headingData']['second_text'] ?? '' }}</span>
                            </h2>
                            <p class="xray-desc fade-right">
                                {{ $section['shortDescription'] }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row g-4 justify-content-center">
                        <!-- Card -->
                        @foreach ($section['items'] as $item)
                            <div class="col-lg-3 col-md-6 animate-card">
                                <div class="xray-card p-3">
                                    <h3 class="xray-title reveal-lines">
                                        {{ plainBracketText($item->title) ?? '' }}
                                    </h3>

                                    <p class="xray-desc ">
                                        {{ \Illuminate\Support\Str::limit($item->short_description ?? '', 150) }}
                                    </p>

                                    {{-- <button class="xray-btn">Read More</button> --}}

                                    <!-- Dynamic URL based on section type -->
                                    <a href="{{ route('repair.service.detail', [
                                        'category' => $section['urlSegment'],
                                        'slug' => $item->slug,
                                    ]) }}"
                                        class="xray-btn ">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
    @endif
@endforeach
