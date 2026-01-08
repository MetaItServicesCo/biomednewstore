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
                        <a href="{{ route('admin.what-we-do.list') }}" class="btn btn-light btn-md">
                            <i class="bi bi-arrow-left me-2"></i>{{ __('Back to List') }}
                        </a>
                    </div>
                </div>

                @php
                    $url = isset($data->id)
                        ? route('admin.what-we-do.update', $data->id)
                        : route('admin.what-we-do.store');
                @endphp

                <div class="card-body p-5">
                    <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($data->id))
                            @method('PUT')
                        @endif
                        <div class="row">

                            <!-- =======================
                                SECTION 1 & 2 for JSON data
                            ======================== -->
                            @for ($i = 1; $i <= 2; $i++)
                                <div class="col-12 mb-4">
                                    <div class="p-3 border rounded">
                                        <h5>{{ $i == 1 ? 'Section Top' : 'Section Bottom' }}</h5>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <label class="form-label fw-semibold required">Title</label>
                                                <input type="text" name="sections[{{ $i }}][title]"
                                                    class="form-control form-control-lg"
                                                    value="{{ old('sections.' . $i . '.title', $data->sections[$i]['title'] ?? '') }}"
                                                    required>
                                            </div>

                                            <div class="col-lg-6 mb-4">
                                                <label class="form-label fw-semibold required">Slug</label>
                                                <input type="text" name="sections[{{ $i }}][slug]"
                                                    class="form-control form-control-lg"
                                                    value="{{ old('sections.' . $i . '.slug', $data->sections[$i]['slug'] ?? '') }}"
                                                    required>
                                            </div>

                                            <div class="col-12 mb-4">
                                                <label class="form-label fw-semibold">Description</label>
                                                <textarea id="description_{{ $i }}" name="sections[{{ $i }}][description]" rows="5"
                                                    class="form-control form-control-lg">{{ old('sections.' . $i . '.description', $data->sections[$i]['description'] ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor

                            <!-- =======================
                                SECTION 2
                                Image + Image ALT
                            ======================== -->
                            <div class="col-12 mb-4">
                                <div class="p-3 border rounded">

                                    <div class="row">

                                        <div class="col-lg-6 mb-4">
                                            <label for="bg_image"
                                                class="form-label fw-semibold">{{ __('BG Image') }}</label>
                                            <input type="file" id="bg_image" name="bg_image"
                                                class="form-control form-control-lg @error('bg_image') is-invalid @enderror">
                                            @if (!empty($data->bg_image))
                                                <img src="{{ asset('storage/what-we-do/' . $data->bg_image) }}"
                                                    class="mt-2" style="max-height:80px;">
                                            @endif
                                            @error('bg_image')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6 mb-4">
                                            <label for="bg_image_alt"
                                                class="form-label fw-semibold">{{ __('Image Alt') }}</label>
                                            <input type="text" id="bg_image_alt" name="bg_image_alt"
                                                class="form-control form-control-lg @error('bg_image_alt') is-invalid @enderror"
                                                value="{{ old('bg_image_alt', $data->bg_image_alt ?? '') }}">
                                            @error('bg_image_alt')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>


                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

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
                // image validation example
                const images = ['bg_image'];
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
                        id: 'description_1',
                        uploadDir: 'what-we-do/ckeditor'
                    },
                    {
                        id: 'description_2',
                        uploadDir: 'what-we-do/ckeditor'
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
