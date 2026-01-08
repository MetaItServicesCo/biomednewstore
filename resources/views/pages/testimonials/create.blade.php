<x-default-layout>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        @if (isset($data->id) && !empty($data->id))
                            <h3 class="fw-bolder mb-0">{{ __('Edit Testimonial') }}</h3>
                        @else
                            <h3 class="fw-bolder mb-0">{{ __('Create Testimonial') }}</h3>
                        @endif
                        <a href="{{ route('admin.testimonials.list') }}" class="btn btn-light btn-md">
                            <i class="bi bi-arrow-left me-2"></i>{{ __('Back to List') }}
                        </a>
                    </div>
                </div>

                @php
                    $url = isset($data->id)
                        ? route('admin.testimonials.update', $data->id)
                        : route('admin.testimonials.store');
                @endphp

                <div class="card-body p-5">
                    <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($data->id))
                            @method('PUT')
                        @endif
                        <div class="row">

                            <div class="col-lg-6 mb-4">
                                <label for="image" class="form-label fw-semibold required">{{ __('Image') }}</label>
                                <input type="file" id="image" name="image"
                                    class="form-control form-control-lg @error('image') is-invalid @enderror">
                                @if (isset($data->image) && $data->image)
                                    <img src="{{ asset('storage/testimonials/' . $data->image) }}" alt="image"
                                        class="img-image mt-2" width="100">
                                @endif
                                @error('image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="image_alt" class="form-label fw-semibold required">{{ __('Image Alt') }}</label>
                                <input type="text" id="image_alt" name="image_alt"
                                    class="form-control form-control-lg @error('image_alt') is-invalid @enderror"
                                    value="{{ old('image_alt', $data->image_alt ?? '') }}">
                                @error('image_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="rating"
                                    class="form-label fw-semibold required">{{ __('Rating') }}</label>

                                <select name="rating" id="rating"
                                    class="form-select form-select-lg @error('rating') is-invalid @enderror">

                                    <option value="">Select Rating</option>

                                    <option value="1"
                                        {{ old('rating', $data->rating ?? '') == 1 ? 'selected' : '' }}>
                                        1 - Very Bad
                                    </option>

                                    <option value="2"
                                        {{ old('rating', $data->rating ?? '') == 2 ? 'selected' : '' }}>
                                        2 - Bad
                                    </option>

                                    <option value="3"
                                        {{ old('rating', $data->rating ?? '') == 3 ? 'selected' : '' }}>
                                        3 - Average
                                    </option>

                                    <option value="4"
                                        {{ old('rating', $data->rating ?? '') == 4 ? 'selected' : '' }}>
                                        4 - Good
                                    </option>

                                    <option value="5"
                                        {{ old('rating', $data->rating ?? '') == 5 ? 'selected' : '' }}>
                                        5 - Excellent
                                    </option>
                                </select>

                                @error('rating')
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
                                    class="form-label fw-semibold required">{{ __('Short Description') }}</label>
                                <textarea id="short_description" name="short_description"
                                    class="form-control form-control-lg @error('short_description') is-invalid @enderror" rows="3">{{ old('short_description', $data->short_description ?? '') }}</textarea>
                                @error('short_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                @include('partials/general/_button-indicator', [
                                    'label' => isset($data->id) ? 'Update' : 'Create',
                                ])
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
                const thumbnailInput = document.getElementById('thumbnail');
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
            });
        </script>
    @endpush

</x-default-layout>
