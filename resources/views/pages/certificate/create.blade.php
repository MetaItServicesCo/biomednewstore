<x-default-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">

                <!-- Header -->
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        @if (isset($data->id) && !empty($data->id))
                            <h3 class="fw-bolder mb-0">{{ __('Edit Certification') }}</h3>
                        @else
                            <h3 class="fw-bolder mb-0">{{ __('Create Certification') }}</h3>
                        @endif

                        <a href="{{ route('admin.company-certification.list') }}" class="btn btn-light btn-md">
                            <i class="bi bi-arrow-left me-2"></i>{{ __('Back to List') }}
                        </a>
                    </div>
                </div>

                @php
                    $url = isset($data->id)
                        ? route('admin.company-certification.update', $data->id)
                        : route('admin.company-certification.store');
                @endphp

                <!-- Body -->
                <div class="card-body p-5">
                    <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($data->id))
                            @method('PUT')
                        @endif

                        <div class="row">

                            <!-- Title -->
                            <div class="col-lg-12 mb-4">
                                <label for="title" class="form-label fw-semibold required">{{ __('Title') }}</label>
                                <input type="text" id="title" name="title"
                                    class="form-control form-control-lg @error('title') is-invalid @enderror"
                                    value="{{ old('title', $data->title ?? '') }}" required>
                                @error('title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Certificate Image -->
                            <div class="col-lg-6 mb-4">
                                <label for="certificate" class="form-label fw-semibold">{{ __('Certificate Image') }}</label>
                                <input type="file" id="certificate" name="certificate"
                                    class="form-control form-control-lg @error('certificate') is-invalid @enderror">

                                @if (!empty($data->certificate))
                                    <img src="{{ asset('storage/company-certifications/' . $data->certificate) }}"
                                        class="mt-2" style="max-height: 80px;">
                                @endif

                                @error('certificate')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Certificate Alt -->
                            <div class="col-lg-6 mb-4">
                                <label for="certificate_alt" class="form-label fw-semibold">{{ __('Image Alt Text') }}</label>
                                <input type="text" id="certificate_alt" name="certificate_alt"
                                    class="form-control form-control-lg @error('certificate_alt') is-invalid @enderror"
                                    value="{{ old('certificate_alt', $data->certificate_alt ?? '') }}">

                                @error('certificate_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                        <!-- Submit -->
                        <div class="d-flex justify-content-end mt-4">
                            @if (isset($data->id) && $data->id)
                                <button type="submit" class="btn btn-primary">
                                    @include('partials/general/_button-indicator', ['label' => 'Update'])
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary">
                                    @include('partials/general/_button-indicator', ['label' => 'Create'])
                                </button>
                            @endif
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')

        {{-- Image validation --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const images = ['certificate'];

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

    @endpush

</x-default-layout>
