<x-default-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        @if (isset($data->id) && !empty($data->id))
                            <h3 class="fw-bolder mb-0">{{ __('Edit Blog') }}</h3>
                        @else
                            <h3 class="fw-bolder mb-0">{{ __('Create Blog') }}</h3>
                        @endif
                        <a href="{{ route('admin-blogs.list') }}" class="btn btn-light btn-md">
                            <i class="bi bi-arrow-left me-2"></i>{{ __('Back to blog List') }}
                        </a>
                    </div>
                </div>

                @php
                    $url = isset($data->id) ? route('admin-blogs.update', $data->id) : route('admin-blogs.store');
                @endphp

                <div class="card-body p-5">
                    <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($data->id))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <!-- Blog Title -->
                            <div class="col-lg-12 mb-4">
                                <label for="title"
                                    class="form-label fw-semibold required">{{ __('Blog Title') }}</label>
                                <input type="text" id="title" name="title"
                                    class="form-control form-control-lg @error('title') is-invalid @enderror"
                                    value="{{ old('title', $data->title ?? '') }}" required>
                                @error('title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Blog Slug -->
                            <div class="col-lg-12 mb-4">
                                <label for="slug"
                                    class="form-label fw-semibold required">{{ __('Blog slug') }}</label>
                                <input type="text" id="slug" name="slug"
                                    class="form-control form-control-lg @error('slug') is-invalid @enderror"
                                    value="{{ old('slug', $data->slug ?? '') }}" required>
                                @error('slug')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="col-lg-6 mb-4">
                                <label for="category_id"
                                    class="form-label fw-semibold required">{{ __('Category') }}</label>
                                <select name="category_id" id="category_id" data-control="select2"
                                    class="form-select form-select-lg @error('category_id') is-invalid @enderror"
                                    required>
                                    <option value="">{{ __('Select Category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $data->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
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

                            <!-- Type -->
                            <div class="col-lg-6 mb-4">
                                <label for="type" class="form-label fw-semibold">{{ __('Type') }}</label>
                                <select name="type" id="type"
                                    class="form-select form-select-lg @error('type') is-invalid @enderror">

                                    <option value="">{{ __('Select Type') }}</option>

                                    <option value="featured"
                                        {{ old('type', $data->type ?? '') == 'featured' ? 'selected' : '' }}>
                                        {{ __('Featured') }}
                                    </option>

                                    <option value="bio-medical"
                                        {{ old('type', $data->type ?? '') == 'bio-medical' ? 'selected' : '' }}>
                                        {{ __('Bio Medical') }}
                                    </option>

                                </select>

                                @error('type')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="read_time"
                                    class="form-label fw-semibold">{{ __('Read Time') }}</label>
                                <input type="text" id="read_time" name="read_time"
                                    class="form-control form-control-lg @error('read_time') is-invalid @enderror"
                                    value="{{ old('read_time', $data->read_time ?? '') }}">
                                @error('read_time')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div class="col-lg-6 mb-4">
                                <label for="image" class="form-label fw-semibold">{{ __('Image') }}</label>
                                <input type="file" id="image" name="image"
                                    class="form-control form-control-lg @error('image') is-invalid @enderror">
                                @if (isset($data->image) && $data->image)
                                    <img src="{{ asset('storage/blog/images/' . $data->image) }}" alt="image"
                                        class="img-image mt-2" width="100">
                                @endif
                                @error('image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="image_alt_text"
                                    class="form-label fw-semibold">{{ __('Image Alt') }}</label>
                                <input type="text" id="image_alt_text" name="image_alt_text"
                                    class="form-control form-control-lg @error('image_alt_text') is-invalid @enderror"
                                    value="{{ old('image_alt_text', $data->image_alt_text ?? '') }}">
                                @error('image_alt_text')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Short Description -->
                            <div class="col-lg-12 mb-4">
                                <label for="description"
                                    class="form-label fw-semibold">{{ __('Short Description') }}</label>
                                <textarea id="short_description" name="short_description"
                                    class="ckeditor form-control form-control-lg @error('short_description') is-invalid @enderror" rows="5">{{ old('short_description', $data->short_description ?? '') }}</textarea>
                                @error('short_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-lg-12 mb-4">
                                <label for="description" class="form-label fw-semibold">{{ __('Description') }}</label>
                                <textarea id="blog_description" name="description"
                                    class="ckeditor form-control form-control-lg @error('description') is-invalid @enderror" rows="5">{{ old('description', $data->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>


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
                                @can('write blogs')
                                    <button type="submit" class="btn btn-primary">
                                        @include('partials/general/_button-indicator', [
                                            'label' => 'Update',
                                        ])
                                    </button>
                                @endcan
                            @else
                                @can('create blogs')
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

                // image validation
                const image = document.getElementById('image');
                if (image) {
                    if (!document.getElementById('image_error')) {
                        let thumbError = document.createElement('div');
                        thumbError.id = 'image_error';
                        thumbError.classList.add('text-danger', 'mt-1');
                        image.parentNode.appendChild(thumbError);
                    }

                    image.addEventListener('change', function() {
                        validateFile(image, 'image_error');
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                ClassicEditor
                    .create(document.querySelector('#blog_description'), {
                        ckfinder: {
                            uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}&dir=blog/ckeditor"
                        }
                    })
                    .then(editor => {
                        console.log(`CKEditor initialized for #blog_description`);
                    })
                    .catch(error => console.error(error));
            });
        </script>
    @endpush

</x-default-layout>
