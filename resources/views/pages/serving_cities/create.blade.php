<x-default-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        @if (isset($data->id) && !empty($data->id))
                            <h3 class="fw-bolder mb-0">{{ __('Edit') }}</h3>
                        @else
                            <h3 class="fw-bolder mb-0">{{ __('Create') }}</h3>
                        @endif
                        <a href="{{ route('admin.serving-cities.list') }}" class="btn btn-light btn-md">
                            <i class="bi bi-arrow-left me-2"></i>{{ __('Back to List') }}
                        </a>
                    </div>
                </div>

                @php
                    $url = isset($data->id)
                        ? route('admin.serving-cities.update', $data->id)
                        : route('admin.serving-cities.store');
                @endphp

                <div class="card-body p-5">
                    <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($data->id)
                            @method('PUT')
                        @endisset

                        <div class="row">

                            {{-- ================= HERO SECTION ================= --}}
                            <div class="col-lg-6 mb-4">
                                <label class="form-label fw-semibold required">Hero Title</label>
                                <input type="text" name="hero_title"
                                    class="form-control @error('hero_title') is-invalid @enderror"
                                    value="{{ old('hero_title', $data->hero_title ?? '') }}" required>
                                @error('hero_title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label class="form-label fw-semibold">Hero Subtitle</label>
                                <input type="text" name="hero_subtitle"
                                    class="form-control @error('hero_subtitle') is-invalid @enderror"
                                    value="{{ old('hero_subtitle', $data->hero_subtitle ?? '') }}">
                                @error('hero_subtitle')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label class="form-label fw-semibold required">Slug</label>
                                <input type="text" name="slug"
                                    class="form-control @error('slug') is-invalid @enderror"
                                    value="{{ old('slug', $data->slug ?? '') }}" required>
                                @error('slug')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ================= STATUS ================= --}}
                            <div class="col-lg-6 mb-4">
                                <label class="form-label fw-semibold">Active</label>
                                <select name="is_active" class="form-select">
                                    <option value="1"
                                        {{ old('is_active', $data->is_active ?? 1) == 1 ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="0"
                                        {{ old('is_active', $data->is_active ?? 1) == 0 ? 'selected' : '' }}>No
                                    </option>
                                </select>
                            </div>

                            <hr class="my-4">

                            {{-- ================= CITY & AREA SECTION ================= --}}
                            <div class="col-lg-4 mb-4">
                                <label class="form-label fw-semibold required">City</label>

                                <select name="city_name" class="form-select @error('city_name') is-invalid @enderror"
                                    required>
                                    <option value="">Select City</option>
                                    @foreach (city_labels() as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('city_name', $data->city_name ?? '') === $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('city_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-4 mb-4">
                                <label class="form-label fw-semibold required">Area Name</label>

                                <input type="text" name="area_name"
                                    class="form-control @error('area_name') is-invalid @enderror"
                                    value="{{ old('area_name', $data->area_name ?? '') }}" required>

                                @error('area_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-4 mb-4">
                                <label class="form-label fw-semibold">Area Show on Header</label>
                                <select name="show_on_header" class="form-select">
                                    <option value="1"
                                        {{ old('show_on_header', $data->show_on_header ?? 1) == 1 ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="0"
                                        {{ old('show_on_header', $data->show_on_header ?? 1) == 0 ? 'selected' : '' }}>
                                        No
                                    </option>
                                </select>
                            </div>


                            <div class="col-lg-6 mb-4">
                                <label class="form-label fw-semibold">City Image</label>
                                <input type="file" name="city_image" id="city_image"
                                    class="form-control @error('city_image') is-invalid @enderror">
                                @if (!empty($data->city_image))
                                    <img src="{{ asset('storage/cities/' . $data->city_image) }}" width="100"
                                        class="mt-2">
                                @endif
                                @error('city_image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label class="form-label fw-semibold">City Image Alt</label>
                                <input type="text" name="city_image_alt"
                                    class="form-control @error('city_image_alt') is-invalid @enderror"
                                    value="{{ old('city_image_alt', $data->city_image_alt ?? '') }}">
                                @error('city_image_alt')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            {{-- ================= CONTENT SECTION ================= --}}
                            <div class="col-lg-12 mb-4">
                                <label class="form-label fw-semibold">Content Title</label>
                                <input type="text" name="content_title"
                                    class="form-control @error('content_title') is-invalid @enderror"
                                    value="{{ old('content_title', $data->content_title ?? '') }}">
                                @error('content_title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label class="form-label fw-semibold">Gallery Images</label>
                                <input type="file" id="gallery_images" name="gallery_images[]" multiple
                                    class="form-control @error('gallery_images.*') is-invalid @enderror">

                                @if (isset($data->gallery_images) && $data->gallery_images)
                                    @php
                                        $galleryImages = json_decode($data->gallery_images, true);
                                    @endphp

                                    @if (is_array($galleryImages))
                                        <div class="d-flex flex-wrap mt-2" id="gallery-images-wrapper">
                                            @foreach ($galleryImages as $img)
                                                <div class="text-center me-2 mb-2 gallery-image-item"
                                                    data-img="{{ $img }}">
                                                    <img src="{{ asset('storage/cities/gallery/' . $img) }}"
                                                        alt="Gallery" class="img-thumbnail" width="80">
                                                    <br>
                                                    <span class="text-danger city-gallery-image"
                                                        style="cursor:pointer; font-size:0.85rem;">
                                                        Remove
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endif

                                @if ($errors->has('gallery_images.*'))
                                    <div class="text-danger mt-1">
                                        {{ $errors->first('gallery_images.*') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label class="form-label fw-semibold">Image Alt</label>
                                <input type="text" name="image_alt"
                                    class="form-control @error('image_alt') is-invalid @enderror"
                                    value="{{ old('image_alt', $data->image_alt ?? '') }}">
                                @error('image_alt')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12 mb-4">
                                <label class="form-label fw-semibold">Content Description</label>
                                <textarea name="content_description" id="content_description"
                                    class="form-control ckeditor @error('content_description') is-invalid @enderror" rows="5">{{ old('content_description', $data->content_description ?? '') }}</textarea>
                                @error('content_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            {{-- ================= HOW WE SERVE ================= --}}
                            <div class="col-lg-6 mb-4">
                                <label class="form-label fw-semibold">Serve Heading</label>
                                <input type="text" name="serve_heading"
                                    class="form-control @error('serve_heading') is-invalid @enderror"
                                    value="{{ old('serve_heading', $data->serve_heading ?? '') }}">
                                @error('serve_heading')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12 mb-4">
                                <label class="form-label fw-semibold">Serve Description</label>
                                <textarea name="serve_description" id="serve_description"
                                    class="form-control ckeditor @error('serve_description') is-invalid @enderror" rows="5">{{ old('serve_description', $data->serve_description ?? '') }}</textarea>
                                @error('serve_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            {{-- ================= SEO ================= --}}
                            <div class="col-lg-6 mb-4">
                                <label class="form-label fw-semibold">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control"
                                    value="{{ old('meta_title', $data->meta_title ?? '') }}">
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label class="form-label fw-semibold">Meta Keywords</label>
                                <input type="text" name="meta_keywords" class="form-control"
                                    value="{{ old('meta_keywords', $data->meta_keywords ?? '') }}">
                            </div>

                            <div class="col-lg-12 mb-4">
                                <label class="form-label fw-semibold">Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $data->meta_description ?? '') }}</textarea>
                            </div>

                        </div>

                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                        <div class="text-end">
                            <button class="btn btn-primary">
                                {{ isset($data->id) ? 'Update' : 'Create' }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // Thumbnail validation
                const thumbnailInput = document.getElementById('city_image');
                if (thumbnailInput) {
                    if (!document.getElementById('thumbnail_error')) {
                        let thumbError = document.createElement('div');
                        thumbError.id = 'thumbnail_error';
                        thumbError.classList.add('text-danger', 'mt-1');
                        thumbnailInput.parentNode.appendChild(thumbError);
                    }

                    thumbnailInput.addEventListener('change', function() {
                        validateFile(thumbnailInput, 'thumbnail_error');
                    });
                }

                // Gallery images validation
                const galleryInput = document.getElementById('gallery_images');
                if (galleryInput) {
                    if (!document.getElementById('gallery_images_error')) {
                        let galleryError = document.createElement('div');
                        galleryError.id = 'gallery_images_error';
                        galleryError.classList.add('text-danger', 'mt-1');
                        galleryInput.parentNode.appendChild(galleryError);
                    }

                    galleryInput.addEventListener('change', function() {
                        validateFile(galleryInput, 'gallery_images_error');
                    });
                }

            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Attach click event to all remove-gallery-image elements
                document.querySelectorAll('.city-gallery-image').forEach(span => {
                    span.addEventListener('click', function() {
                        const container = this.closest('.gallery-image-item');
                        const imgName = container.getAttribute('data-img');
                        const id = "{{ $data->id ?? 0 }}";

                        if (!id) return;

                        // Confirmation dialog
                        if (confirm(`Are you sure you want to remove this image?`)) {
                            // Send AJAX request to remove image
                            fetch("{{ route('admin.serving-cities.remove-gallery-image') }}", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        id: id,
                                        image: imgName
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        container.remove(); // Remove image from DOM
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
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editors = [{
                        id: 'content_description',
                        uploadDir: 'city/ckeditor'
                    },
                    {
                        id: 'serve_description',
                        uploadDir: 'how_we_serve/ckeditor'
                    }
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
