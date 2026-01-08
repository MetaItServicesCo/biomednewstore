@props([
    'faqs' => collect(),
    'heading' => 'Frequently Asked Questions',
    'subheading' => 'About Our Profile?',
    'subtext' => 'We provide sales, rental, and repair services for medical equipment with ISO certified',
    'image' => 'frontend/images/hero-main-img.png',
    'visible' => 4, // default: first 4 show
    'btnMore' => 'See More',
    'btnLess' => 'Show Less',
])

{{-- Do NOT show section if faqs is empty --}}
@if (isset($faqs) && $faqs->count() > 0)

    <section class="faqs-section py-5" data-visible="{{ $visible }}" data-btn-more="{{ $btnMore }}"
        data-btn-less="{{ $btnLess }}">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Column: FAQs -->
                <div class="col-lg-6">
                    <h2 class="faqs-heading">{{ $heading }}</h2>

                    <div class="mt-4">
                        <h5 class="faqs-subheading">{{ $subheading }}</h5>
                        <p class="faq-para">
                            {{ $subtext }}
                        </p>
                    </div>

                    <div class="faqs-list">
                        @foreach ($faqs as $item)
                            <div class="faq-item">
                                <div class="faq-title">
                                    {{ $item->question ?? '' }}
                                    <i class="bi bi-chevron-down faq-icon"></i>
                                </div>
                                <div class="faq-content">
                                    {{ $item->answer ?? '' }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($faqs->count() > $visible)
                        <button type="button" class="btn-see-more">
                            {{ $btnMore }}
                        </button>
                    @endif
                </div>

                <!-- Right Column: Image -->
                <div class="col-lg-6 text-center">
                    <img src="{{ asset($image) }}" alt="FAQ Image" class="faq-img img-fluid">
                </div>
            </div>
        </div>
    </section>
@endif
