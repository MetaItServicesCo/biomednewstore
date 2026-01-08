<x-default-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        @if (isset($data->id) && !empty($data->id))
                            <h3 class="fw-bolder mb-0">{{ __('Edit Links') }}</h3>
                        @else
                            <h3 class="fw-bolder mb-0">{{ __('Create Links') }}</h3>
                        @endif
                        <a href="{{ route('admin.importent-links.list') }}" class="btn btn-light btn-md">
                            <i class="bi bi-arrow-left me-2"></i>{{ __('Back to List') }}
                        </a>
                    </div>
                </div>

                @php
                    $url = isset($data->id)
                        ? route('admin.importent-links.update', $data->id)
                        : route('admin.importent-links.store');
                @endphp

                <div class="card-body p-5">
                    <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($data->id))
                            @method('PUT')
                        @endif
                        <div class="row">

                            <div class="col-lg-12 mb-4">
                                <label for="for_page" class="form-label fw-semibold required">{{ __('For Page') }}</label>
                                <select name="for_page" id="for_page"
                                    class="form-select form-select-lg @error('for_page') is-invalid @enderror">

                                    <option value="privacy_policy"
                                        {{ old('for_page', $data->for_page ?? '') == 'privacy_policy' ? 'selected' : '' }}>
                                        {{ __('Privacy Policy') }}
                                    </option>

                                    <option value="terms_conditions"
                                        {{ old('for_page', $data->for_page ?? '') == 'terms_conditions' ? 'selected' : '' }}>
                                        {{ __('Terms & Conditions') }}
                                    </option>

                                    <option value="disclaimer"
                                        {{ old('for_page', $data->for_page ?? '') == 'disclaimer' ? 'selected' : '' }}>
                                        {{ __('Disclaimer') }}
                                    </option>

                                </select>

                                @error('for_page')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Title -->
                            <div class="col-lg-12 mb-4">
                                <label for="title"
                                    class="form-label fw-semibold required">{{ __('Title') }}</label>
                                <input type="text" id="title" name="title"
                                    class="form-control form-control-lg @error('title') is-invalid @enderror"
                                    value="{{ old('title', $data->title ?? '') }}" required>
                                @error('title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12 mb-4">
                                <label for="subtitle" class="form-label fw-semibold">{{ __('Sub Title') }}</label>
                                <textarea id="subtitle" name="subtitle" class="form-control form-control-lg @error('subtitle') is-invalid @enderror"
                                    rows="3">{{ old('subtitle', $data->subtitle ?? '') }}</textarea>
                                @error('subtitle')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="col-lg-6 mb-4">
                                <label for="button_text" class="form-label fw-semibold">{{ __('Button Text') }}</label>
                                <input type="text" id="button_text" name="button_text"
                                    class="form-control form-control-lg @error('button_text') is-invalid @enderror"
                                    value="{{ old('button_text', $data->button_text ?? '') }}">
                                @error('button_text')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="icon" class="form-label fw-semibold">{{ __('Button Icon') }}</label>
                                <input type="text" id="icon" name="icon"
                                    class="form-control form-control-lg @error('icon') is-invalid @enderror"
                                    value="{{ old('icon', $data->icon ?? '') }}">
                                @error('icon')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
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
                            @endif
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    @endpush

</x-default-layout>
