<x-default-layout>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h3 class="fw-bolder mb-0">{{ __('Rental Services') }}</h3>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('admin-rental-service-page.store') }}" method="post"
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
                                <label for="main_heading" class="form-label fw-semibold">{{ __('Heading') }}</label>
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
                                    class="form-label fw-semibold">{{ __('Description') }}</label>
                                <textarea name="main_description" id="main_description" rows="5"
                                    class="form-control form-control-lg @error('main_description') is-invalid @enderror">{{ old('main_description', $data->main_description ?? '') }}</textarea>
                                @error('main_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Main Image -->
                            <div class="col-lg-6">
                                <label for="main_image" class="form-label fw-semibold">{{ __('Image') }}</label>
                                <input type="file" name="main_image" id="main_image"
                                    class="form-control form-control-lg @error('main_image') is-invalid @enderror">
                                @if (!empty($data->main_image))
                                    <img src="{{ asset('storage/rental_services/' . $data->main_image) }}"
                                        class="mt-2" style="max-height:80px;">
                                @endif
                                @error('main_image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Main Image Alt -->
                            <div class="col-lg-6">
                                <label for="main_image_alt"
                                    class="form-label fw-semibold">{{ __('Image Alt') }}</label>
                                <input type="text" name="main_image_alt" id="main_image_alt"
                                    class="form-control form-control-lg @error('main_image_alt') is-invalid @enderror"
                                    value="{{ old('main_image_alt', $data->main_image_alt ?? '') }}">
                                @error('main_image_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Equipment Heading -->
                            <div class="col-lg-12">
                                <label for="equipment_heading"
                                    class="form-label fw-semibold">{{ __('Equipment Heading') }}</label>
                                <input type="text" name="equipment_heading" id="equipment_heading"
                                    class="form-control form-control-lg @error('equipment_heading') is-invalid @enderror"
                                    value="{{ old('equipment_heading', $data->equipment_heading ?? '') }}">
                                @error('equipment_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Equipment List -->
                            <div class="col-lg-12">
                                <label for="equipment_list"
                                    class="form-label fw-semibold">{{ __('Equipment List') }}</label>
                                <textarea name="equipment_list" id="equipment_list" rows="4"
                                    class="form-control form-control-lg @error('equipment_list') is-invalid @enderror">{{ old('equipment_list', $data->equipment_list ?? '') }}</textarea>
                                @error('equipment_list')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Why Rent Heading -->
                            <div class="col-lg-12">
                                <label for="why_rent_heading"
                                    class="form-label fw-semibold">{{ __('Why Rent Heading') }}</label>
                                <input type="text" name="why_rent_heading" id="why_rent_heading"
                                    class="form-control form-control-lg @error('why_rent_heading') is-invalid @enderror"
                                    value="{{ old('why_rent_heading', $data->why_rent_heading ?? '') }}">
                                @error('why_rent_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Why Rent List -->
                            <div class="col-lg-12">
                                <label for="why_rent_list"
                                    class="form-label fw-semibold">{{ __('Why Rent List') }}</label>
                                <textarea name="why_rent_list" id="why_rent_list" rows="4"
                                    class="form-control form-control-lg @error('why_rent_list') is-invalid @enderror">{{ old('why_rent_list', $data->why_rent_list ?? '') }}</textarea>
                                @error('why_rent_list')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Meta Title -->
                            <div class="col-lg-12">
                                <label for="meta_title" class="form-label fw-semibold">{{ __('Meta Title') }}</label>
                                <input type="text" name="meta_title" id="meta_title"
                                    class="form-control form-control-lg @error('meta_title') is-invalid @enderror"
                                    value="{{ old('meta_title', $data->meta_title ?? '') }}">
                                @error('meta_title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Meta Keywords -->
                            <div class="col-lg-12">
                                <label for="meta_keywords"
                                    class="form-label fw-semibold">{{ __('Meta Keywords') }}</label>
                                <textarea name="meta_keywords" id="meta_keywords" rows="2"
                                    class="form-control form-control-lg @error('meta_keywords') is-invalid @enderror">{{ old('meta_keywords', $data->meta_keywords ?? '') }}</textarea>
                                @error('meta_keywords')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Meta Description -->
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
                const image = document.getElementById('main_image');
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
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editors = [{
                        id: 'equipment_list',
                        uploadDir: 'rental_services/ckeditor'
                    },
                    {
                        id: 'why_rent_list',
                        uploadDir: 'rental_services/ckeditor'
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
