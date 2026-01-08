<x-default-layout>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h3 class="fw-bolder mb-0">{{ __('Location Page') }}</h3>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('admin-location-page.store') }}" method="post" enctype="multipart/form-data">
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


                            {{-- ================= Areas We Serve ================= --}}
                            <div class="col-12 mt-5">
                                <h4 class="fw-bold">Areas We Serve</h4>
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">Areas Title</label>
                                <input type="text" name="areas_title"
                                    class="form-control form-control-lg @error('areas_title') is-invalid @enderror"
                                    value="{{ old('areas_title', $data->areas_title ?? '') }}">
                                @error('areas_title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">Areas Description</label>
                                <textarea name="areas_description" rows="4"
                                    class="form-control form-control-lg @error('areas_description') is-invalid @enderror">{{ old('areas_description', $data->areas_description ?? '') }}</textarea>
                                @error('areas_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- ================= Major Cities ================= --}}
                            <div class="col-12 mt-5">
                                <h4 class="fw-bold">Major Cities Section</h4>
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">Cities Section Title</label>
                                <input type="text" name="cities_section_title"
                                    class="form-control form-control-lg @error('cities_section_title') is-invalid @enderror"
                                    value="{{ old('cities_section_title', $data->cities_section_title ?? '') }}">
                                @error('cities_section_title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- ================= How We Serve ================= --}}
                            <div class="col-12 mt-5">
                                <h4 class="fw-bold">How We Serve</h4>
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">Serve Heading</label>
                                <input type="text" name="serve_heading"
                                    class="form-control form-control-lg @error('serve_heading') is-invalid @enderror"
                                    value="{{ old('serve_heading', $data->serve_heading ?? '') }}">
                                @error('serve_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">Serve Description</label>
                                <textarea name="serve_description" id="serve_description" rows="4"
                                    class="form-control form-control-lg @error('serve_description') is-invalid @enderror">{{ old('serve_description', $data->serve_description ?? '') }}</textarea>
                                @error('serve_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
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
            document.addEventListener('DOMContentLoaded', function() {
                const editors = [{
                    id: 'serve_description',
                    uploadDir: 'how_we_serve/ckeditor'
                }];

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
