<x-default-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        @if (isset($data->id) && !empty($data->id))
                            <h3 class="fw-bolder mb-0">{{ __('Edit Brand') }}</h3>
                        @else
                            <h3 class="fw-bolder mb-0">{{ __('Create Brand') }}</h3>
                        @endif
                        <a href="{{ route('admin.brand-we-carry.list') }}" class="btn btn-light btn-md">
                            <i class="bi bi-arrow-left me-2"></i>{{ __('Back to List') }}
                        </a>
                    </div>
                </div>

                @php
                    $url = isset($data->id)
                        ? route('admin.brand-we-carry.update', $data->id)
                        : route('admin.brand-we-carry.store');
                @endphp

                <div class="card-body p-5">
                    <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($data->id))
                            @method('PUT')
                        @endif

                        <div class="row">

                            <!-- Company Name -->
                            <div class="col-lg-12 mb-4">
                                <label for="company_name"
                                    class="form-label fw-semibold required">{{ __('Company Name') }}</label>
                                <input type="text" id="company_name" name="company_name"
                                    class="form-control form-control-lg @error('company_name') is-invalid @enderror"
                                    value="{{ old('company_name', $data->company_name ?? '') }}" required>
                                @error('company_name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Website -->
                            <div class="col-lg-12 mb-4">
                                <label for="website" class="form-label fw-semibold">{{ __('Website') }}</label>
                                <input type="url" id="website" name="website"
                                    class="form-control form-control-lg @error('website') is-invalid @enderror"
                                    value="{{ old('website', $data->website ?? '') }}">
                                @error('website')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Logo -->
                            <div class="col-lg-6 mb-4">
                                <label for="logo" class="form-label fw-semibold">{{ __('Logo') }}</label>
                                <input type="file" id="logo" name="logo"
                                    class="form-control form-control-lg @error('logo') is-invalid @enderror">
                                @if (!empty($data->logo))
                                    <img src="{{ asset('storage/brands-we-carry/' . $data->logo) }}" class="mt-2"
                                        style="max-height:80px;">
                                @endif
                                @error('logo')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Logo Alt -->
                            <div class="col-lg-6 mb-4">
                                <label for="logo_alt" class="form-label fw-semibold">{{ __('Logo Alt') }}</label>
                                <input type="text" id="logo_alt" name="logo_alt"
                                    class="form-control form-control-lg @error('logo_alt') is-invalid @enderror"
                                    value="{{ old('logo_alt', $data->logo_alt ?? '') }}">
                                @error('logo_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>



                        </div>

                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                        <div class="d-flex justify-content-end mt-4">
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

                // image validation
                const image = document.getElementById('logo');
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
    @endpush
</x-default-layout>
