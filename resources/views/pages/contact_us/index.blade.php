<x-default-layout>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h3 class="fw-bolder mb-0">{{ __('Contact US Page') }}</h3>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('admin-contact-us.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                        <div class="row g-4">

                            {{-- ================= Hero Section ================= --}}
                            <div class="col-12">
                                <h4 class="fw-bold">Hero Section</h4>
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold required">Hero Title</label>
                                <input type="text" name="hero_title"
                                    class="form-control form-control-lg @error('hero_title') is-invalid @enderror"
                                    value="{{ old('hero_title', $data->hero_title ?? '') }}" required>
                                @error('hero_title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">Hero Subtitle</label>
                                <textarea name="hero_subtitle" rows="3"
                                    class="form-control form-control-lg @error('hero_subtitle') is-invalid @enderror">{{ old('hero_subtitle', $data->hero_subtitle ?? '') }}</textarea>
                                @error('hero_subtitle')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ================= Map Section ================= --}}
                            <div class="col-12 mt-5">
                                <h4 class="fw-bold">Map Section</h4>
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">Map Iframe</label>
                                <textarea name="map_iframe" rows="4"
                                    class="form-control form-control-lg @error('map_iframe') is-invalid @enderror"
                                    placeholder="Paste Google Map iframe here">{{ old('map_iframe', $data->map_iframe ?? '') }}</textarea>
                                @error('map_iframe')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ================= What We Offer ================= --}}
                            <div class="col-12 mt-5">
                                <h4 class="fw-bold">What We Offer</h4>
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">Offer Heading</label>
                                <input type="text" name="offer_heading" class="form-control form-control-lg"
                                    value="{{ old('offer_heading', $data->offer_heading ?? '') }}">
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">Offer Description</label>
                                <textarea name="offer_description" rows="3" class="form-control form-control-lg">{{ old('offer_description', $data->offer_description ?? '') }}</textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="fw-bold mb-0">Offers</h5>
                                    <button type="button" class="btn btn-sm btn-primary" id="add-offer">
                                        + Add Offer
                                    </button>
                                </div>
                            </div>

                            <div class="col-12" id="offers-wrapper">
                                {{-- Edit Mode --}}
                                @if (!empty($data->offers))
                                    @foreach ($data->offers as $oIndex => $offer)
                                        @include('partials.contact-us-offer', [
                                            'index' => $oIndex,
                                            'offer' => $offer,
                                        ])
                                    @endforeach
                                @endif
                            </div>

                            {{-- ================= SEO ================= --}}
                            <div class="col-12 mt-5">
                                <h4 class="fw-bold">SEO Fields</h4>
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">Meta Title</label>
                                <input type="text" name="meta_title"
                                    class="form-control form-control-lg @error('meta_title') is-invalid @enderror"
                                    value="{{ old('meta_title', $data->meta_title ?? '') }}">
                                @error('meta_title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">Meta Keywords</label>
                                <input type="text" name="meta_keywords"
                                    class="form-control form-control-lg @error('meta_keywords') is-invalid @enderror"
                                    value="{{ old('meta_keywords', $data->meta_keywords ?? '') }}">
                                @error('meta_keywords')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">Meta Description</label>
                                <textarea name="meta_description" rows="3"
                                    class="form-control form-control-lg @error('meta_description') is-invalid @enderror">{{ old('meta_description', $data->meta_description ?? '') }}</textarea>
                                @error('meta_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end mt-4">
                            @if (isset($data->id) && $data->id)
                                <button type="submit" class="btn btn-primary">
                                    @include('partials/general/_button-indicator', [
                                        'label' => 'Update',
                                    ])
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary">
                                    @include('partials/general/_button-indicator', [
                                        'label' => 'Create',
                                    ])
                                </button>
                            @endif
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let offerIndex = {{ !empty($data->offers) ? count($data->offers) : 0 }};

            // ---------------- ADD OFFER ----------------
            document.getElementById('add-offer').addEventListener('click', function() {

                const html = `
                    <div class="card mt-4 offer-item" data-index="${offerIndex}">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>Offer</strong>
                            <button type="button" class="btn btn-sm btn-danger remove-offer">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>

                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Offer Title</label>
                                <input type="text"
                                    name="offers[${offerIndex}][title]"
                                    class="form-control">
                            </div>

                            <div class="bullets-wrapper"></div>

                            <button type="button" class="btn btn-sm btn-secondary add-bullet mt-2">
                                + Add Bullet
                            </button>
                        </div>
                    </div>`;

                document.getElementById('offers-wrapper')
                    .insertAdjacentHTML('beforeend', html);

                offerIndex++;
            });

            // ---------------- REMOVE OFFER ----------------
            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-offer')) {
                    if (confirm('Are you sure you want to remove this offer?')) {
                        e.target.closest('.offer-item').remove();
                    }
                }
            });

            // ---------------- ADD BULLET ----------------
            document.addEventListener('click', function(e) {
                if (e.target.closest('.add-bullet')) {

                    const offer = e.target.closest('.offer-item');
                    const oIndex = offer.dataset.index;
                    const bulletsWrapper = offer.querySelector('.bullets-wrapper');
                    const bIndex = bulletsWrapper.children.length;

                    bulletsWrapper.insertAdjacentHTML('beforeend', `
                        <div class="row g-2 align-items-center bullet-item mb-2">
                            <div class="col-md-5">
                                <input type="text"
                                    name="offers[${oIndex}][bullets][${bIndex}][text]"
                                    class="form-control"
                                    placeholder="Bullet text">
                            </div>
                            <div class="col-md-5">
                                <input type="url"
                                    name="offers[${oIndex}][bullets][${bIndex}][url]"
                                    class="form-control"
                                    placeholder="URL">
                            </div>
                            <div class="col-md-2 text-end">
                                <button type="button" class="btn btn-sm btn-outline-danger remove-bullet">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    `);
                }
            });

            // ---------------- REMOVE BULLET ----------------
            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-bullet')) {
                    if (confirm('Remove this bullet point?')) {
                        e.target.closest('.bullet-item').remove();
                    }
                }
            });
        </script>
    @endpush


</x-default-layout>
