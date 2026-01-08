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
                        <a href="{{ route('admin-repair-service.sub-pages.list') }}" class="btn btn-light btn-md">
                            <i class="bi bi-arrow-left me-2"></i>{{ __('Back to List') }}
                        </a>
                    </div>
                </div>

                @php
                    $url = isset($data->id)
                        ? route('admin-repair-service.sub-pages.update', $data->id)
                        : route('admin-repair-service.sub-pages.store');
                @endphp

                <div class="card-body p-5">
                    <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($data->id))
                            @method('PUT')
                        @endif
                        <div class="row">

                            <!-- Select Page Category  -->
                            <div class="col-lg-6 mb-4">
                                <label for="page_category"
                                    class="form-label fw-semibold required">{{ __('Page Category') }}</label>

                                <select name="page_category" id="page_category" data-control="select2"
                                    class="form-select form-select-lg @error('page_category') is-invalid @enderror"
                                    required>

                                    <option value="">{{ __('Select Page Category') }}</option>
                                    <option value="repair-service"
                                        {{ old('page_category', $data->page_category ?? '') == 'repair-service' ? 'selected' : '' }}>
                                        {{ __('Repairing Services') }} </option>
                                    <option value="x-ray"
                                        {{ old('page_category', $data->page_category ?? '') == 'x-ray' ? 'selected' : '' }}>
                                        {{ __('X Ray') }} </option>
                                    <option value="c-arm"
                                        {{ old('page_category', $data->page_category ?? '') == 'c-arm' ? 'selected' : '' }}>
                                        {{ __('C Arm') }} </option>
                                </select>

                                @error('page_category')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Title -->
                            <div class="col-lg-6 mb-4">
                                <label for="title"
                                    class="form-label fw-semibold required">{{ __('Title') }}</label>
                                <input type="text" id="title" name="title"
                                    class="form-control form-control-lg @error('title') is-invalid @enderror"
                                    value="{{ old('title', $data->title ?? '') }}" required>
                                @error('title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Slug -->
                            <div class="col-lg-6 mb-4">
                                <label for="slug"
                                    class="form-label fw-semibold required">{{ __('Slug') }}</label>
                                <input type="text" id="slug" name="slug"
                                    class="form-control form-control-lg @error('slug') is-invalid @enderror"
                                    value="{{ old('slug', $data->slug ?? '') }}" required>
                                @error('slug')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Is Active -->
                            <div class="col-lg-6 mb-4">
                                <label for="is_active" class="form-label fw-semibold">{{ __('Active') }}</label>
                                <select name="is_active" id="is_active"
                                    class="form-select form-select-lg @error('is_active') is-invalid @enderror">
                                    <option value="1"
                                        {{ old('is_active', $data->is_active ?? 1) == 1 ? 'selected' : '' }}>
                                        {{ __('Yes') }}</option>
                                    <option value="0"
                                        {{ old('is_active', $data->is_active ?? 1) == 0 ? 'selected' : '' }}>
                                        {{ __('No') }}</option>
                                </select>
                                @error('is_active')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Short Description -->
                            <div class="col-lg-12 mb-4">
                                <label for="short_description"
                                    class="form-label fw-semibold">{{ __('Short Description') }}</label>
                                <textarea id="short_description" name="short_description"
                                    class="form-control form-control-lg @error('short_description') is-invalid @enderror" rows="3">{{ old('short_description', $data->short_description ?? '') }}</textarea>
                                @error('short_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="mt-5 mb-5">

                            <!-- Content Title -->
                            <div class="col-lg-12 mb-4">
                                <label for="content_title"
                                    class="form-label fw-semibold required">{{ __('Content Title') }}</label>
                                <input type="text" id="content_title" name="content_title"
                                    class="form-control form-control-lg @error('content_title') is-invalid @enderror"
                                    value="{{ old('content_title', $data->content_title ?? '') }}" required>
                                @error('content_title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Thumbnail -->
                            <div class="col-lg-6 mb-4">
                                <label for="content_thumbnail"
                                    class="form-label fw-semibold">{{ __('Thumbnail Image') }}</label>
                                <input type="file" id="content_thumbnail" name="content_thumbnail"
                                    class="form-control form-control-lg @error('content_thumbnail') is-invalid @enderror">
                                @if (isset($data->content_thumbnail) && $data->content_thumbnail)
                                    <img src="{{ asset('storage/repair-pages/' . $data->content_thumbnail) }}"
                                        alt="content_thumbnail" class="img-content_thumbnail mt-2" width="100">
                                @endif
                                @error('content_thumbnail')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="content_image_alt"
                                    class="form-label fw-semibold">{{ __('Image Alt') }}</label>
                                <input type="text" id="content_image_alt" name="content_image_alt"
                                    class="form-control form-control-lg @error('content_image_alt') is-invalid @enderror"
                                    value="{{ old('content_image_alt', $data->content_image_alt ?? '') }}">
                                @error('content_image_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gallery Images -->
                            <div class="col-lg-12 mb-4">
                                <label for="gallery_images"
                                    class="form-label fw-semibold">{{ __('Gallery Images') }}</label>
                                <input type="file" id="gallery_images" name="gallery_images[]"
                                    class="form-control form-control-lg @error('gallery_images') is-invalid @enderror"
                                    multiple>
                                @if (isset($data->gallery_images) && $data->gallery_images)
                                    @php
                                        $galleryImages = json_decode($data->gallery_images, true);
                                    @endphp

                                    @if (is_array($galleryImages))
                                        <div class="d-flex flex-wrap mt-2" id="gallery-images-wrapper">
                                            @foreach ($galleryImages as $img)
                                                <div class="text-center me-2 mb-2 gallery-image-item"
                                                    data-img="{{ $img }}">
                                                    <img src="{{ asset('storage/repair-pages/gallery/' . $img) }}"
                                                        alt="Gallery" class="img-thumbnail" width="80">
                                                    <br>
                                                    <span class="text-danger remove-reapir-sub-page-gallery-image"
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


                            <!-- Description -->
                            <div class="col-lg-12 mb-4">
                                <label for="content_description"
                                    class="form-label fw-semibold">{{ __('Description') }}</label>
                                <textarea id="content_description" name="content_description"
                                    class="ckeditor form-control form-control-lg @error('content_description') is-invalid @enderror" rows="5">{{ old('content_description', $data->content_description ?? '') }}</textarea>
                                @error('content_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <hr class="mt-5 mb-5">

                            <h3 class="fw-bolder mb-5">{{ __('How we Serve') }}</h3>

                            <div class="col-lg-12 mb-4">
                                <label for="serve_heading" class="form-label fw-semibold">{{ __('Heading') }}</label>
                                <input type="text" id="serve_heading" name="serve_heading"
                                    class="form-control form-control-lg @error('serve_heading') is-invalid @enderror"
                                    value="{{ old('serve_heading', $data->serve_heading ?? '') }}">
                                @error('serve_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-lg-12 mb-4">
                                <label for="serve_description"
                                    class="form-label fw-semibold">{{ __('Description') }}</label>
                                <textarea id="serve_description" name="serve_description"
                                    class="ckeditor form-control form-control-lg @error('serve_description') is-invalid @enderror" rows="5">{{ old('serve_description', $data->serve_description ?? '') }}</textarea>
                                @error('serve_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="mt-5 mb-5">

                            <h3 class="fw-bolder mb-5">{{ __('Benefits') }}</h3>

                            <div class="col-lg-12 mb-4">
                                <label for="benefits_heading"
                                    class="form-label fw-semibold">{{ __('Heading') }}</label>
                                <input type="text" id="benefits_heading" name="benefits_heading"
                                    class="form-control form-control-lg @error('benefits_heading') is-invalid @enderror"
                                    value="{{ old('benefits_heading', $data->benefits_heading ?? '') }}">
                                @error('benefits_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-lg-12 mb-4">
                                <label for="benefits_description"
                                    class="form-label fw-semibold">{{ __('Description') }}</label>
                                <textarea id="benefits_description" name="benefits_description"
                                    class="ckeditor form-control form-control-lg @error('benefits_description') is-invalid @enderror" rows="5">{{ old('benefits_description', $data->benefits_description ?? '') }}</textarea>
                                @error('benefits_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="mt-5 mb-5">
                            <h3 class="fw-bolder mb-5">{{ __('Common Challenges We Solve') }}</h3>

                            <!-- Image -->
                            <div class="col-lg-6 mb-4">
                                <label for="challenges_image"
                                    class="form-label fw-semibold">{{ __('Image') }}</label>
                                <input type="file" id="challenges_image" name="challenges_image"
                                    class="form-control form-control-lg @error('challenges_image') is-invalid @enderror">
                                @if (isset($data->challenges_image) && $data->challenges_image)
                                    <img src="{{ asset('storage/repair-pages/' . $data->challenges_image) }}"
                                        alt="challenges_image" class="img-challenges_image mt-2" width="100">
                                @endif
                                @error('challenges_image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="challenges_image_alt"
                                    class="form-label fw-semibold">{{ __('Image Alt') }}</label>
                                <input type="text" id="challenges_image_alt" name="challenges_image_alt"
                                    class="form-control form-control-lg @error('challenges_image_alt') is-invalid @enderror"
                                    value="{{ old('challenges_image_alt', $data->challenges_image_alt ?? '') }}">
                                @error('challenges_image_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-lg-12 mb-4">
                                <label for="challenges_description"
                                    class="form-label fw-semibold">{{ __('Description') }}</label>
                                <textarea id="challenges_description" name="challenges_description"
                                    class="ckeditor form-control form-control-lg @error('challenges_description') is-invalid @enderror"
                                    rows="5">{{ old('challenges_description', $data->challenges_description ?? '') }}</textarea>
                                @error('challenges_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="mt-5 mb-5">

                            <h3 class="fw-bolder mb-5">{{ __('CTA Section') }}</h3>

                            <!-- Thumbnail -->
                            <div class="col-lg-6 mb-4">
                                <label for="cta_thumbnail"
                                    class="form-label fw-semibold">{{ __('Thumbnail Image') }}</label>
                                <input type="file" id="cta_thumbnail" name="cta_thumbnail"
                                    class="form-control form-control-lg @error('cta_thumbnail') is-invalid @enderror">
                                @if (isset($data->cta_thumbnail) && $data->cta_thumbnail)
                                    <img src="{{ asset('storage/repair-pages/' . $data->cta_thumbnail) }}"
                                        alt="cta_thumbnail" class="img-cta_thumbnail mt-2" width="100">
                                @endif
                                @error('cta_thumbnail')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="cta_image_alt"
                                    class="form-label fw-semibold">{{ __('Image Alt') }}</label>
                                <input type="text" id="cta_image_alt" name="cta_image_alt"
                                    class="form-control form-control-lg @error('cta_image_alt') is-invalid @enderror"
                                    value="{{ old('cta_image_alt', $data->cta_image_alt ?? '') }}">
                                @error('cta_image_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-lg-12 mb-4">
                                <label for="cta_description"
                                    class="form-label fw-semibold">{{ __('Description') }}</label>
                                <textarea id="cta_description" name="cta_description"
                                    class="ckeditor form-control form-control-lg @error('cta_description') is-invalid @enderror" rows="5">{{ old('cta_description', $data->cta_description ?? '') }}</textarea>
                                @error('cta_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <hr class="mt-5 mb-5">

                            <h3 class="fw-bolder mb-5">{{ __('SEO Section') }}</h3>
                            <!-- SEO -->
                            <div class="col-lg-6 mb-4">
                                <label for="meta_title" class="form-label fw-semibold">{{ __('Meta Title') }}</label>
                                <input type="text" id="meta_title" name="meta_title"
                                    class="form-control form-control-lg @error('meta_title') is-invalid @enderror"
                                    value="{{ old('meta_title', $data->meta_title ?? '') }}">
                                @error('meta_title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="meta_keywords"
                                    class="form-label fw-semibold">{{ __('Meta Keywords') }}</label>
                                <input type="text" id="meta_keywords" name="meta_keywords"
                                    class="form-control form-control-lg @error('meta_keywords') is-invalid @enderror"
                                    value="{{ old('meta_keywords', $data->meta_keywords ?? '') }}">
                                @error('meta_keywords')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12 mb-4">
                                <label for="meta_description"
                                    class="form-label fw-semibold">{{ __('Meta Description') }}</label>
                                <textarea id="meta_description" name="meta_description"
                                    class="form-control form-control-lg @error('meta_description') is-invalid @enderror" rows="3">{{ old('meta_description', $data->meta_description ?? '') }}</textarea>
                                @error('meta_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                        <div class="d-flex justify-content-end mt-4">
                            @if (isset($data->id) && $data->id)
                                @can('write repair service sub page')
                                    <button type="submit" class="btn btn-primary">
                                        @include('partials/general/_button-indicator', [
                                            'label' => 'Update',
                                        ])
                                    </button>
                                @endcan
                            @else
                                @can('create repair service sub page')
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
                // Attach click event to all remove-gallery-image elements
                document.querySelectorAll('.remove-reapir-sub-page-gallery-image').forEach(span => {
                    span.addEventListener('click', function() {
                        const container = this.closest('.gallery-image-item');
                        const imgName = container.getAttribute('data-img');
                        const id = "{{ $data->id ?? 0 }}";

                        if (!id) return;

                        // Confirmation dialog
                        if (confirm(`Are you sure you want to remove this image?`)) {
                            // Send AJAX request to remove image
                            fetch("{{ route('admin-repair-service.sub-pages.remove-gallery-image') }}", {
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
                        uploadDir: 'repair-pages/ckeditor'
                    },
                    {
                        id: 'serve_description',
                        uploadDir: 'repair-pages/ckeditor'
                    },
                    {
                        id: 'benefits_description',
                        uploadDir: 'repair-pages/ckeditor'
                    },
                    {
                        id: 'challenges_description',
                        uploadDir: 'repair-pages/ckeditor'
                    },
                    {
                        id: 'cta_description',
                        uploadDir: 'repair-pages/ckeditor'
                    },
                    // Add more editors here if needed
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
