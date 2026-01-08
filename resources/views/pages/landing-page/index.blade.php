<x-default-layout>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h3 class="fw-bolder mb-0">{{ __('Landing Page') }}</h3>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('admin-landing-page.storeOrUpdate') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                        <div class="row g-4">
                            <!-- Main Heading -->
                            <div class="col-lg-12">
                                <label for="hero_heading"
                                    class="form-label fw-semibold required">{{ __('Main Heading') }}</label>
                                <input type="text" name="hero_heading" id="hero_heading"
                                    class="form-control form-control-lg @error('hero_heading') is-invalid @enderror"
                                    value="{{ old('hero_heading', $data->hero_heading ?? '') }}" required>
                                @error('hero_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Main Short Description -->
                            <div class="col-lg-12">
                                <label for="hero_sd"
                                    class="form-label fw-semibold">{{ __('Main Short Description') }}</label>
                                <textarea name="hero_sd" id="hero_sd" rows="3"
                                    class="form-control form-control-lg @error('hero_sd') is-invalid @enderror">{{ old('hero_sd', $data->hero_sd ?? '') }}</textarea>
                                @error('hero_sd')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gallery Images -->
                            <div class="col-lg-6 mb-4">
                                <label for="hero_slider_images"
                                    class="form-label fw-semibold">{{ __('Slider Images') }}</label>
                                <input type="file" id="hero_slider_images" name="hero_slider_images[]"
                                    class="form-control form-control-lg @error('hero_slider_images') is-invalid @enderror"
                                    multiple>
                                @if (isset($data->hero_slider_images) && is_array($data->hero_slider_images))
                                    <div class="d-flex flex-wrap mt-2" id="hero-slider-images-wrapper">
                                        @foreach ($data->hero_slider_images as $img)
                                            <div class="text-center me-2 mb-2 hero-slider-image-item"
                                                data-img="{{ $img }}">
                                                <img src="{{ asset('storage/landing-page/hero-slider/' . $img) }}"
                                                    alt="slider" class="img-thumbnail" width="80">
                                                <br>
                                                <span class="text-danger remove-hero-slider-image"
                                                    style="cursor:pointer; font-size:0.85rem;">
                                                    Remove
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if ($errors->has('hero_slider_images.*'))
                                    <div class="text-danger mt-1">
                                        {{ $errors->first('hero_slider_images.*') }}
                                    </div>
                                @endif

                            </div>

                            <div class="col-lg-6">
                                <label for="hero_image_alt"
                                    class="form-label fw-semibold">{{ __('Image Alt') }}</label>
                                <input type="text" name="hero_image_alt" id="hero_image_alt"
                                    class="form-control form-control-lg @error('hero_image_alt') is-invalid @enderror"
                                    value="{{ old('hero_image_alt', $data->hero_image_alt ?? '') }}">
                                @error('hero_image_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="mt-5 mb-5">

                            <h3 class="fw-bolder mb-5">{{ __('Main Content') }}</h3>

                            <div class="col-lg-12">
                                <label for="content_heading"
                                    class="form-label fw-semibold required">{{ __('Heading') }}</label>
                                <input type="text" name="content_heading" id="content_heading"
                                    class="form-control form-control-lg @error('content_heading') is-invalid @enderror"
                                    value="{{ old('content_heading', $data->content_heading ?? '') }}" required>
                                @error('content_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-lg-12">
                                <label for="content_description"
                                    class="form-label fw-semibold">{{ __('Description') }}</label>
                                <textarea name="content_description" id="content_description" rows="3"
                                    class="form-control form-control-lg @error('content_description') is-invalid @enderror">{{ old('content_description', $data->content_description ?? '') }}</textarea>
                                @error('content_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gallery Images -->
                            <div class="col-lg-6 mb-4">
                                <label for="content_slider_images"
                                    class="form-label fw-semibold">{{ __('Slider Images') }}</label>
                                <input type="file" id="content_slider_images" name="content_slider_images[]"
                                    class="form-control form-control-lg @error('content_slider_images') is-invalid @enderror"
                                    multiple>
                                @if (isset($data->content_slider_images) && is_array($data->content_slider_images))
                                    <div class="d-flex flex-wrap mt-2" id="content-slider-images-wrapper">
                                        @foreach ($data->content_slider_images as $img)
                                            <div class="text-center me-2 mb-2 content-slider-image-item"
                                                data-img="{{ $img }}">
                                                <img src="{{ asset('storage/landing-page/content-slider/' . $img) }}"
                                                    alt="slider" class="img-thumbnail" width="80">
                                                <br>
                                                <span class="text-danger remove-content-slider-image"
                                                    style="cursor:pointer; font-size:0.85rem;">
                                                    Remove
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if ($errors->has('content_slider_images.*'))
                                    <div class="text-danger mt-1">
                                        {{ $errors->first('content_slider_images.*') }}
                                    </div>
                                @endif

                            </div>

                            <div class="col-lg-6">
                                <label for="content_image_alt"
                                    class="form-label fw-semibold">{{ __('Image Alt') }}</label>
                                <input type="text" name="content_image_alt" id="content_image_alt"
                                    class="form-control form-control-lg @error('content_image_alt') is-invalid @enderror"
                                    value="{{ old('content_image_alt', $data->content_image_alt ?? '') }}">
                                @error('content_image_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="mt-5 mb-5">

                            <h3 class="fw-bolder mb-5">{{ __('SEO Section') }}</h3>

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
                            @if (isset($data) && $data->id)
                                @can('write landing page')
                                    <button type="submit" class="btn btn-primary">
                                        @include('partials/general/_button-indicator', [
                                            'label' => 'Update',
                                        ])
                                    </button>
                                @endcan
                            @else
                                @can('create landing page')
                                    <button type="submit" class="btn btn-primary">
                                        @include('partials/general/_button-indicator', [
                                            'label' => 'Create',
                                        ])
                                    </button>
                                @endcan
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
                // Slider images validation
                // Slider images validation
                const heroInput = document.getElementById('hero_slider_images');
                if (heroInput) {
                    if (!document.getElementById('hero_images_error')) {
                        let heroError = document.createElement('div');
                        heroError.id = 'hero_images_error';
                        heroError.classList.add('text-danger', 'mt-1');
                        heroInput.parentNode.appendChild(heroError);
                    }

                    heroInput.addEventListener('change', function() {
                        validateFile(heroInput, 'hero_images_error');
                    });
                }

                const contentInput = document.getElementById('content_slider_images');
                if (contentInput) {
                    if (!document.getElementById('content_images_error')) {
                        let contentError = document.createElement('div');
                        contentError.id = 'content_images_error';
                        contentError.classList.add('text-danger', 'mt-1');
                        contentInput.parentNode.appendChild(contentError);
                    }

                    contentInput.addEventListener('change', function() {
                        validateFile(contentInput, 'content_images_error'); // Fixed here
                    });
                }

                ClassicEditor
                    .create(document.querySelector('#content_description'), {
                        ckfinder: {
                            uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}&dir=landing-page/ckeditor"
                        }
                    })
                    .then(editor => {
                        console.log(`CKEditor initialized for #content_description`);
                    })
                    .catch(error => console.error(error));

            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function attachRemoveHandler(selector, containerClass, path) {
                    document.querySelectorAll(selector).forEach(span => {
                        span.addEventListener('click', function() {
                            const container = this.closest('.' + containerClass);
                            if (!container) return;

                            const imgName = container.getAttribute('data-img');
                            const landingPageId = "{{ $data->id ?? 0 }}";

                            if (!landingPageId) return;

                            if (confirm('Are you sure you want to remove this image?')) {
                                fetch("{{ route('admin-landing-page.remove-slider-image') }}", {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            landing_page_id: landingPageId,
                                            image: imgName,
                                            column: containerClass.includes('hero') ?
                                                'hero_slider_images' :
                                                'content_slider_images',
                                            path: path
                                        })
                                    })
                                    .then(res => res.json())
                                    .then(data => {
                                        if (data.success) {
                                            container.remove();
                                            toastr.success(data.message ||
                                                'Image removed successfully');
                                        } else {
                                            toastr.error(data.message || 'Something went wrong');
                                        }
                                    })
                                    .catch(err => {
                                        console.error(err);
                                        toastr.error('Error removing image');
                                    });
                            }
                        });
                    });
                }

                // Attach remove handlers with correct container classes
                attachRemoveHandler('.remove-hero-slider-image', 'hero-slider-image-item', 'landing-page/hero-slider');
                attachRemoveHandler('.remove-content-slider-image', 'content-slider-image-item',
                    'landing-page/content-slider');
            });
        </script>
    @endpush

</x-default-layout>
