<x-default-layout>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h3 class="fw-bolder mb-0">{{ __('BioMed Services') }}</h3>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('admin-biomed-service-page.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                        @php
                            // for dynamic sections
                            $serviceCards = old('service_cards', $data->service_cards ?? []);
                            $serviceImages = old('service_images', $data->service_images ?? []);

                        @endphp

                        <div class="row g-4">
                            <!-- Main Heading -->
                            <div class="col-lg-12">
                                <label for="hero_title"
                                    class="form-label fw-semibold required">{{ __('Main Heading') }}</label>
                                <input type="text" name="hero_title" id="hero_title"
                                    class="form-control form-control-lg @error('hero_title') is-invalid @enderror"
                                    value="{{ old('hero_title', $data->hero_title ?? '') }}" required>
                                @error('hero_title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Main Short Description -->
                            <div class="col-lg-12">
                                <label for="hero_subtitle"
                                    class="form-label fw-semibold">{{ __('Main Short Description') }}</label>
                                <textarea name="hero_subtitle" id="hero_subtitle" rows="3"
                                    class="form-control form-control-lg @error('hero_subtitle') is-invalid @enderror">{{ old('hero_subtitle', $data->hero_subtitle ?? '') }}</textarea>
                                @error('hero_subtitle')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Intro Heading -->
                            <div class="col-lg-12">
                                <label for="intro_heading"
                                    class="form-label fw-semibold">{{ __('Intro Heading') }}</label>
                                <input type="text" name="intro_heading" id="intro_heading"
                                    class="form-control form-control-lg @error('intro_heading') is-invalid @enderror"
                                    value="{{ old('intro_heading', $data->intro_heading ?? '') }}">
                                @error('intro_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Intro Description -->
                            <div class="col-lg-12">
                                <label for="intro_text"
                                    class="form-label fw-semibold">{{ __('Intro Description') }}</label>
                                <textarea name="intro_text" id="intro_text" rows="3"
                                    class="form-control form-control-lg @error('intro_text') is-invalid @enderror">{{ old('intro_text', $data->intro_text ?? '') }}</textarea>
                                @error('intro_text')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Intro Image 1 -->
                            <div class="col-lg-6">
                                <label for="intro_image_1"
                                    class="form-label fw-semibold">{{ __('Intro Image Top') }}</label>
                                <input type="file" name="intro_image_1" id="intro_image_1"
                                    class="form-control form-control-lg @error('intro_image_1') is-invalid @enderror">
                                @if (!empty($data->intro_image_1))
                                    <img src="{{ asset('storage/biomed_services/' . $data->intro_image_1) }}"
                                        class="mt-2" style="max-height:80px;">
                                @endif
                                @error('intro_image_1')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Intro Image 1 Alt -->
                            <div class="col-lg-6">
                                <label for="intro_image_1_alt"
                                    class="form-label fw-semibold">{{ __('Image Alt') }}</label>
                                <input type="text" name="intro_image_1_alt" id="intro_image_1_alt"
                                    class="form-control form-control-lg @error('intro_image_1_alt') is-invalid @enderror"
                                    value="{{ old('intro_image_1_alt', $data->intro_image_1_alt ?? '') }}">
                                @error('intro_image_1_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Intro Image 2 -->
                            <div class="col-lg-6">
                                <label for="intro_image_2"
                                    class="form-label fw-semibold">{{ __('Intro Image Bottom') }}</label>
                                <input type="file" name="intro_image_2" id="intro_image_2"
                                    class="form-control form-control-lg @error('intro_image_2') is-invalid @enderror">
                                @if (!empty($data->intro_image_2))
                                    <img src="{{ asset('storage/biomed_services/' . $data->intro_image_2) }}"
                                        class="mt-2" style="max-height:80px;">
                                @endif
                                @error('intro_image_2')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Intro Image 2 Alt -->
                            <div class="col-lg-6">
                                <label for="intro_image_2_alt"
                                    class="form-label fw-semibold">{{ __('Image Alt') }}</label>
                                <input type="text" name="intro_image_2_alt" id="intro_image_2_alt"
                                    class="form-control form-control-lg @error('intro_image_2_alt') is-invalid @enderror"
                                    value="{{ old('intro_image_2_alt', $data->intro_image_2_alt ?? '') }}">
                                @error('intro_image_2_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Product Heading -->
                            <div class="col-lg-12">
                                <label for="product_heading"
                                    class="form-label fw-semibold">{{ __('Product Heading') }}</label>
                                <input type="text" name="product_heading" id="product_heading"
                                    class="form-control form-control-lg @error('product_heading') is-invalid @enderror"
                                    value="{{ old('product_heading', $data->product_heading ?? '') }}">
                                @error('product_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Banner Heading -->
                            <div class="col-lg-12">
                                <label for="banner_heading"
                                    class="form-label fw-semibold">{{ __('Banner Heading') }}</label>
                                <input type="text" name="banner_heading" id="banner_heading"
                                    class="form-control form-control-lg @error('banner_heading') is-invalid @enderror"
                                    value="{{ old('banner_heading', $data->banner_heading ?? '') }}">
                                @error('banner_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Banner Description -->
                            <div class="col-lg-12">
                                <label for="banner_text"
                                    class="form-label fw-semibold">{{ __('Banner Description') }}</label>
                                <textarea name="banner_text" id="banner_text" rows="3"
                                    class="form-control form-control-lg @error('banner_text') is-invalid @enderror">{{ old('banner_text', $data->banner_text ?? '') }}</textarea>
                                @error('banner_text')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Service Heading -->
                            <div class="col-lg-12">
                                <label for="service_heading"
                                    class="form-label fw-semibold">{{ __('Service Heading') }}</label>
                                <input type="text" name="service_heading" id="service_heading"
                                    class="form-control form-control-lg @error('service_heading') is-invalid @enderror"
                                    value="{{ old('service_heading', $data->service_heading ?? '') }}">
                                @error('service_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Services Description -->
                            <div class="col-lg-12">
                                <label for="service_sd"
                                    class="form-label fw-semibold">{{ __('Services Description') }}</label>
                                <textarea name="service_sd" id="service_sd" rows="3"
                                    class="form-control form-control-lg @error('service_sd') is-invalid @enderror">{{ old('service_sd', $data->service_sd ?? '') }}</textarea>
                                @error('service_sd')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- SERVICE CARDS (dynamic) --}}
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                                    <h4 class="fw-bold mb-0">{{ __('Service Cards') }}</h4>
                                    <button type="button" class="btn btn-sm btn-light-primary"
                                        id="addServiceCardBtn">
                                        + {{ __('Add more') }}
                                    </button>
                                </div>

                                <div id="serviceCardsWrapper">
                                    @php
                                        $cardIndex = 0;
                                    @endphp

                                    @forelse($serviceCards as $idx => $card)
                                        @php $cardIndex = $idx; @endphp
                                        <div class="service-card-item border rounded-3 p-4 mb-3 position-relative"
                                            data-index="{{ $idx }}">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-light-danger position-absolute top-0 end-0 m-2 service-card-remove"
                                                title="{{ __('Remove') }}">
                                                &times;
                                            </button>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">
                                                    {{ __('Service Card Heading') }}
                                                </label>
                                                <input type="text"
                                                    name="service_cards[{{ $idx }}][heading]"
                                                    class="form-control form-control-lg"
                                                    value="{{ $card['heading'] ?? '' }}">
                                            </div>

                                            <div class="mb-0">
                                                <label class="form-label fw-semibold">
                                                    {{ __('Service Card Description') }}
                                                </label>
                                                <textarea name="service_cards[{{ $idx }}][description]" rows="3"
                                                    class="form-control form-control-lg">{{ $card['description'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    @empty
                                        {{-- no existing cards → JS se naya add ho jayega --}}
                                    @endforelse
                                </div>
                            </div>

                            {{-- SERVICE IMAGES (dynamic) --}}
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4 class="fw-bold mb-0">{{ __('Service Images') }}</h4>
                                    <button type="button" class="btn btn-sm btn-light-primary"
                                        id="addServiceImageBtn">
                                        + {{ __('Add image') }}
                                    </button>
                                </div>

                                <div id="serviceImagesWrapper">
                                    @php $imgIndex = 0; @endphp

                                    @forelse($serviceImages as $idx => $img)
                                        @php $imgIndex = $idx; @endphp
                                        <div class="service-image-item border rounded-3 p-4 mb-3 position-relative"
                                            data-index="{{ $idx }}">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-light-danger position-absolute top-0 end-0 m-2 service-image-remove"
                                                title="{{ __('Remove') }}">
                                                &times;
                                            </button>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">
                                                    {{ __('Image File') }}
                                                </label>
                                                <input type="file"
                                                    name="service_images[{{ $idx }}][file]"
                                                    class="form-control form-control-lg">

                                                @if (!empty($img['path']))
                                                    {{-- old record ka path --}}
                                                    <input type="hidden"
                                                        name="service_images[{{ $idx }}][existing_path]"
                                                        value="{{ $img['path'] }}">
                                                    <img src="{{ asset('storage/biomed_services/' . $img['path']) }}"
                                                        class="mt-2" style="max-height:80px;">
                                                @endif
                                            </div>

                                            <div class="mb-0">
                                                <label class="form-label fw-semibold">
                                                    {{ __('Image Alt Text') }}
                                                </label>
                                                <input type="text" name="service_images[{{ $idx }}][alt]"
                                                    class="form-control form-control-lg"
                                                    value="{{ $img['alt'] ?? '' }}">
                                            </div>
                                        </div>
                                    @empty
                                        {{-- jab koi image DB me na ho to JS se ek blank block add ho jayega --}}
                                    @endforelse
                                </div>

                            </div>

                            <!-- SEO Fields -->
                            <div class="col-lg-6">
                                <label for="meta_title" class="form-label fw-semibold">{{ __('Meta Title') }}</label>
                                <input type="text" name="meta_title" id="meta_title"
                                    class="form-control form-control-lg @error('meta_title') is-invalid @enderror"
                                    value="{{ old('meta_title', $data->meta_title ?? '') }}">
                                @error('meta_title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label for="meta_keywords"
                                    class="form-label fw-semibold">{{ __('Meta Keywords') }}</label>
                                <input type="text" name="meta_keywords" id="meta_keywords"
                                    class="form-control form-control-lg @error('meta_keywords') is-invalid @enderror"
                                    value="{{ old('meta_keywords', $data->meta_keywords ?? '') }}">
                                @error('meta_keywords')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label for="meta_description"
                                    class="form-label fw-semibold">{{ __('Meta Description') }}</label>
                                <textarea name="meta_description" id="meta_description" rows="3"
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
            document.addEventListener('DOMContentLoaded', function() {

                // ---------- SERVICE CARDS ----------
                const $serviceCardsWrapper = $('#serviceCardsWrapper');
                let serviceCardIndex = (function() {
                    const items = $serviceCardsWrapper.find('.service-card-item');
                    if (!items.length) return 0;

                    let max = 0;
                    items.each(function() {
                        const idx = parseInt($(this).data('index') || 0, 10);
                        if (idx > max) max = idx;
                    });
                    return max + 1;
                })();

                function addServiceCard(heading = '', description = '') {
                    const index = serviceCardIndex++;

                    const html = `
                        <div class="service-card-item border rounded-3 p-4 mb-3 position-relative" data-index="${index}">
                            <button type="button"
                                    class="btn btn-sm btn-icon btn-light-danger position-absolute top-0 end-0 m-2 service-card-remove"
                                    title="{{ __('Remove') }}">
                                &times;
                            </button>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">{{ __('Service Card Heading') }}</label>
                                <input type="text"
                                       name="service_cards[${index}][heading]"
                                       class="form-control form-control-lg"
                                       value="${heading}">
                            </div>

                            <div class="mb-0">
                                <label class="form-label fw-semibold">{{ __('Service Card Description') }}</label>
                                <textarea name="service_cards[${index}][description]"
                                          rows="3"
                                          class="form-control form-control-lg">${description}</textarea>
                            </div>
                        </div>
                    `;
                    $serviceCardsWrapper.append(html);
                }

                // If no cards pre-rendered, add one empty by default
                if (!$serviceCardsWrapper.find('.service-card-item').length) {
                    addServiceCard();
                }

                $('#addServiceCardBtn').on('click', function(e) {
                    e.preventDefault();
                    addServiceCard();
                });

                $serviceCardsWrapper.on('click', '.service-card-remove', function() {
                    $(this).closest('.service-card-item').remove();
                });

                // ---------- SERVICE IMAGES ----------
                const $serviceImagesWrapper = $('#serviceImagesWrapper');
                let serviceImageIndex = (function() {
                    const items = $serviceImagesWrapper.find('.service-image-item');
                    if (!items.length) return 0;

                    let max = 0;
                    items.each(function() {
                        const idx = parseInt($(this).data('index') || 0, 10);
                        if (idx > max) max = idx;
                    });
                    return max + 1;
                })();

                function addServiceImage(existingPath = '', alt = '') {
                    const index = serviceImageIndex++;

                    const previewHtml = existingPath ?
                        `<input type="hidden" name="service_images[${index}][existing_path]" value="${existingPath}">
                           <img src="{{ asset('storage/biomed_services') }}/${existingPath}" class="mt-2" style="max-height:80px;">` :
                        '';

                    const html = `
                        <div class="service-image-item border rounded-3 p-4 mb-3 position-relative" data-index="${index}">
                            <button type="button"
                                    class="btn btn-sm btn-icon btn-light-danger position-absolute top-0 end-0 m-2 service-image-remove"
                                    title="{{ __('Remove') }}">
                                &times;
                            </button>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">{{ __('Image File') }}</label>
                                <input type="file"
                                       name="service_images[${index}][file]"
                                       class="form-control form-control-lg">
                                ${previewHtml}
                            </div>

                            <div class="mb-0">
                                <label class="form-label fw-semibold">{{ __('Image Alt Text') }}</label>
                                <input type="text"
                                       name="service_images[${index}][alt]"
                                       class="form-control form-control-lg"
                                       value="${alt}">
                            </div>
                        </div>
                    `;
                    $serviceImagesWrapper.append(html);
                }

                // if no images exist, add one empty block
                if (!$serviceImagesWrapper.find('.service-image-item').length) {
                    addServiceImage();
                }

                $('#addServiceImageBtn').on('click', function(e) {
                    e.preventDefault();
                    addServiceImage();
                });

                $serviceImagesWrapper.on('click', '.service-image-remove', function() {
                    $(this).closest('.service-image-item').remove();
                });

            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editors = [{
                        id: 'intro_text',
                        uploadDir: 'biomed_services/ckeditor'
                    },

                ];

                editors.forEach(editorConfig => {
                    const el = document.querySelector(`#${editorConfig.id}`);
                    if (el) {
                        ClassicEditor
                            .create(el, {
                                ckfinder: {
                                    uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}&dir=" +
                                        editorConfig.uploadDir
                                }
                            })
                            .then(editorInstance => {
                                console.log(`CKEditor initialized for #${editorConfig.id}`);
                            })
                            .catch(error => console.error(`CKEditor error for #${editorConfig.id}:`, error));
                    }
                });
            });
        </script>
    @endpush

</x-default-layout>
