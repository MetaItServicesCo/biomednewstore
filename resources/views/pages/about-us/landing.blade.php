<x-default-layout>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h3 class="fw-bolder mb-0">{{ __('About Us') }}</h3>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('admin.about-us.main.storeOrUpdate') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                        <div class="row g-4">

                            <!-- Hero Title -->
                            <div class="col-lg-12">
                                <label for="hero_title"
                                    class="form-label fw-semibold required">{{ __('Hero Title') }}</label>
                                <input type="text" name="hero_title" id="hero_title"
                                    class="form-control form-control-lg @error('hero_title') is-invalid @enderror"
                                    value="{{ old('hero_title', $data->hero_title ?? '') }}" required>
                                @error('hero_title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Hero Subtitle -->
                            <div class="col-lg-12">
                                <label for="hero_subtitle"
                                    class="form-label fw-semibold">{{ __('Hero Subtitle') }}</label>
                                <textarea name="hero_subtitle" id="hero_subtitle" rows="3"
                                    class="form-control form-control-lg @error('hero_subtitle') is-invalid @enderror">{{ old('hero_subtitle', $data->hero_subtitle ?? '') }}</textarea>
                                @error('hero_subtitle')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Main Heading -->
                            <div class="col-lg-12">
                                <label for="main_heading"
                                    class="form-label fw-semibold">{{ __('Main Heading') }}</label>
                                <input type="text" name="main_heading" id="main_heading"
                                    class="form-control form-control-lg @error('main_heading') is-invalid @enderror"
                                    value="{{ old('main_heading', $data->main_heading ?? '') }}">
                                @error('main_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Main Description -->
                            <div class="col-lg-12">
                                <label for="main_description"
                                    class="form-label fw-semibold">{{ __('Main Description') }}</label>
                                <textarea name="main_description" id="main_description" rows="5"
                                    class="form-control form-control-lg @error('main_description') is-invalid @enderror">{{ old('main_description', $data->main_description ?? '') }}</textarea>
                                @error('main_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Stats -->
                            <div class="col-lg-6">
                                <label for="stats" class="form-label fw-semibold">{{ __('Stats') }}</label>
                                <input type="text" name="stats" id="stats"
                                    class="form-control form-control-lg @error('stats') is-invalid @enderror"
                                    value="{{ old('stats', $data->stats ?? '') }}">
                                @error('stats')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Stats Description -->
                            <div class="col-lg-6">
                                <label for="stats_description"
                                    class="form-label fw-semibold">{{ __('Stats Description') }}</label>
                                <textarea name="stats_description" id="stats_description" rows="3"
                                    class="form-control form-control-lg @error('stats_description') is-invalid @enderror">{{ old('stats_description', $data->stats_description ?? '') }}</textarea>
                                @error('stats_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image 1 -->
                            <div class="col-lg-6">
                                <label for="image_1" class="form-label fw-semibold">{{ __('Image 1') }}</label>
                                <input type="file" name="image_1" id="image_1"
                                    class="form-control form-control-lg @error('image_1') is-invalid @enderror">
                                @if (!empty($data->image_1))
                                    <img src="{{ asset('storage/about_us/' . $data->image_1) }}" class="mt-2"
                                        style="max-height:80px;">
                                @endif
                                @error('image_1')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image 1 Alt -->
                            <div class="col-lg-6">
                                <label for="image_1_alt" class="form-label fw-semibold">{{ __('Image 1 Alt') }}</label>
                                <input type="text" name="image_1_alt" id="image_1_alt"
                                    class="form-control form-control-lg @error('image_1_alt') is-invalid @enderror"
                                    value="{{ old('image_1_alt', $data->image_1_alt ?? '') }}">
                                @error('image_1_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image 2 -->
                            <div class="col-lg-6">
                                <label for="image_2" class="form-label fw-semibold">{{ __('Image 2') }}</label>
                                <input type="file" name="image_2" id="image_2"
                                    class="form-control form-control-lg @error('image_2') is-invalid @enderror">
                                @if (!empty($data->image_2))
                                    <img src="{{ asset('storage/about_us/' . $data->image_2) }}" class="mt-2"
                                        style="max-height:80px;">
                                @endif
                                @error('image_2')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image 2 Alt -->
                            <div class="col-lg-6">
                                <label for="image_2_alt" class="form-label fw-semibold">{{ __('Image 2 Alt') }}</label>
                                <input type="text" name="image_2_alt" id="image_2_alt"
                                    class="form-control form-control-lg @error('image_2_alt') is-invalid @enderror"
                                    value="{{ old('image_2_alt', $data->image_2_alt ?? '') }}">
                                @error('image_2_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Value Section Heading -->
                            <div class="col-lg-12">
                                <label for="value_section_heading"
                                    class="form-label fw-semibold">{{ __('Value Section Heading') }}</label>
                                <input type="text" name="value_section_heading" id="value_section_heading"
                                    class="form-control form-control-lg @error('value_section_heading') is-invalid @enderror"
                                    value="{{ old('value_section_heading', $data->value_section_heading ?? '') }}">
                                @error('value_section_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Value Section Description -->
                            <div class="col-lg-12">
                                <label for="value_section_description"
                                    class="form-label fw-semibold">{{ __('Value Section Description') }}</label>
                                <textarea name="value_section_description" id="value_section_description" rows="4"
                                    class="form-control form-control-lg @error('value_section_description') is-invalid @enderror">{{ old('value_section_description', $data->value_section_description ?? '') }}</textarea>
                                @error('value_section_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Value Section Image -->
                            <div class="col-lg-6">
                                <label for="value_section_image"
                                    class="form-label fw-semibold">{{ __('Value Section Image') }}</label>
                                <input type="file" name="value_section_image" id="value_section_image"
                                    class="form-control form-control-lg @error('value_section_image') is-invalid @enderror">
                                @if (!empty($data->value_section_image))
                                    <img src="{{ asset('storage/about_us/' . $data->value_section_image) }}"
                                        class="mt-2" style="max-height:80px;">
                                @endif
                                @error('value_section_image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Value Section Image Alt -->
                            <div class="col-lg-6">
                                <label for="value_section_image_alt"
                                    class="form-label fw-semibold">{{ __('Value Section Image Alt') }}</label>
                                <input type="text" name="value_section_image_alt" id="value_section_image_alt"
                                    class="form-control form-control-lg @error('value_section_image_alt') is-invalid @enderror"
                                    value="{{ old('value_section_image_alt', $data->value_section_image_alt ?? '') }}">
                                @error('value_section_image_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- SEO Fields -->
                            <div class="col-lg-12">
                                <label for="meta_title" class="form-label fw-semibold">{{ __('Meta Title') }}</label>
                                <input type="text" name="meta_title" id="meta_title"
                                    class="form-control form-control-lg @error('meta_title') is-invalid @enderror"
                                    value="{{ old('meta_title', $data->meta_title ?? '') }}">
                                @error('meta_title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label for="meta_keywords"
                                    class="form-label fw-semibold">{{ __('Meta Keywords') }}</label>
                                <textarea name="meta_keywords" id="meta_keywords" rows="2"
                                    class="form-control form-control-lg @error('meta_keywords') is-invalid @enderror">{{ old('meta_keywords', $data->meta_keywords ?? '') }}</textarea>
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

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary">
                                    @include('partials/general/_button-indicator', [
                                        'label' => isset($data->id) ? 'Update' : 'Create',
                                    ])
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // image validation example
                const images = ['image_1', 'image_2', 'value_section_image'];
                images.forEach(id => {
                    const imageInput = document.getElementById(id);
                    if (imageInput) {
                        const errorDivId = `${id}_error`;
                        if (!document.getElementById(errorDivId)) {
                            let errorDiv = document.createElement('div');
                            errorDiv.id = errorDivId;
                            errorDiv.classList.add('text-danger', 'mt-1');
                            imageInput.parentNode.appendChild(errorDiv);
                        }

                        imageInput.addEventListener('change', function() {
                            validateFile(imageInput, errorDivId);
                        });
                    }
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editors = [{
                        id: 'main_description',
                        uploadDir: 'about_us/ckeditor'
                    },
                    {
                        id: 'value_section_description',
                        uploadDir: 'about_us/ckeditor'
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
