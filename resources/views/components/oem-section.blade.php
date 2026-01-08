<section class="oem-trust-section py-5">
    <div class="container">
        <h2 class="text-center mb-5 section-title fade-left">Why OEMs Trust <span>Mr Biomed Tech</span> </h2>

        <div class="row g- justify-content-center mx-5">
            <!-- CARD-->
            @foreach ($oems as $item)
                <div class="col-lg-4 col-md-6 animate-card justify-content-center">
                    <div class="oem-card">
                        <div class="oem-img-box">
                            <img src="{{ asset('storage/oem_contents/' . $item->image) }}"
                                alt="{{ $item->image_alt ?? '' }}" class="oem-img img-fluid">
                            <h4 class="oem-card-title">{{ $item->title ?? '' }}</h4>
                        </div>

                        <div class="oem-desc">{!! $item->description !!}</div>
                        {{-- <p class="oem-desc">
                                We provide top-notch medical equipment that meets international standards.
                            </p>

                            <ul class="oem-list">
                                <li>ISO certified products</li>
                                <li>Durability guaranteed</li>
                                <li>Trusted by hospitals</li>
                            </ul> --}}
                    </div>
                </div>
            @endforeach

            <div class="text-center mt-5">
                <a href="{{ route('contact-us') }}">
                    <button class="btn-lgg">Talk to Expert</button>
                </a>
            </div>
        </div>
    </div>
</section>
