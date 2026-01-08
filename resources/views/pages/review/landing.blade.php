<x-default-layout>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h3 class="fw-bolder mb-0">{{ __('Review Landing Page') }}</h3>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('admin.reviews.store') }}" method="post" enctype="multipart/form-data">
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

                            {{-- ================= Main Content Section ================= --}}
                            <div class="col-12 mt-5">
                                <h4 class="fw-bold">Main Content Section</h4>
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">Main Heading</label>
                                <input type="text" name="main_heading"
                                    class="form-control form-control-lg @error('main_heading') is-invalid @enderror"
                                    value="{{ old('main_heading', $data->main_heading ?? '') }}">
                                @error('main_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">Main Description</label>
                                <textarea name="main_description" id="main_description" rows="5"
                                    class="form-control form-control-lg @error('main_description') is-invalid @enderror">{{ old('main_description', $data->main_description ?? '') }}</textarea>
                                @error('main_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">Main Image</label>
                                <input type="file" name="main_image"
                                    class="form-control form-control-lg @error('main_image') is-invalid @enderror">
                                @error('main_image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                @if (!empty($data->main_image))
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/reviews/main/' . $data->main_image) }}"
                                            height="80">
                                    </div>
                                @endif
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">Main Image Alt</label>
                                <input type="text" name="main_image_alt"
                                    class="form-control form-control-lg @error('main_image_alt') is-invalid @enderror"
                                    value="{{ old('main_image_alt', $data->main_image_alt ?? '') }}">
                                @error('main_image_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ================= CTA / Banner Section ================= --}}
                            <div class="col-12 mt-5">
                                <h4 class="fw-bold">CTA / Banner Section</h4>
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">CTA Title</label>
                                <input type="text" name="cta_title"
                                    class="form-control form-control-lg @error('cta_title') is-invalid @enderror"
                                    value="{{ old('cta_title', $data->cta_title ?? '') }}">
                                @error('cta_title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">CTA Description</label>
                                <textarea name="cta_description" rows="4"
                                    class="form-control form-control-lg @error('cta_description') is-invalid @enderror">{{ old('cta_description', $data->cta_description ?? '') }}</textarea>
                                @error('cta_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">CTA Logo</label>
                                <input type="file" name="cta_logo"
                                    class="form-control form-control-lg @error('cta_logo') is-invalid @enderror">
                                @error('cta_logo')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                @if (!empty($data->cta_logo))
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/reviews/cta/' . $data->cta_logo) }}"
                                            height="80">
                                    </div>
                                @endif
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">CTA Logo Alt</label>
                                <input type="text" name="cta_logo_alt"
                                    class="form-control form-control-lg @error('cta_logo_alt') is-invalid @enderror"
                                    value="{{ old('cta_logo_alt', $data->cta_logo_alt ?? '') }}">
                                @error('cta_logo_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ================= Testimonials Section ================= --}}
                            <div class="col-12 mt-5">
                                <h4 class="fw-bold">Testimonials Section</h4>
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">Testimonial Heading</label>
                                <input type="text" name="testimonial_heading"
                                    class="form-control form-control-lg @error('testimonial_heading') is-invalid @enderror"
                                    value="{{ old('testimonial_heading', $data->testimonial_heading ?? '') }}">
                                @error('testimonial_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">Testimonial Subheading</label>
                                <textarea name="testimonial_subheading" rows="3"
                                    class="form-control form-control-lg @error('testimonial_subheading') is-invalid @enderror">{{ old('testimonial_subheading', $data->testimonial_subheading ?? '') }}</textarea>
                                @error('testimonial_subheading')
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
                    id: 'main_description',
                    uploadDir: 'reviews/ckeditor'
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
