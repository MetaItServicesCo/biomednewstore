<x-default-layout>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h3 class="fw-bolder mb-0">{{ __('Repair Services Main Page') }}</h3>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('admin-repair-service-page.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                        <div class="row g-4">
                            <!-- Main Heading -->
                            <div class="col-lg-12">
                                <label for="main_heading"
                                    class="form-label fw-semibold required">{{ __('Main Heading') }}</label>
                                <input type="text" name="main_heading" id="main_heading"
                                    class="form-control form-control-lg @error('main_heading') is-invalid @enderror"
                                    value="{{ old('main_heading', $data->main_heading ?? '') }}" required>
                                @error('main_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Main Short Description -->
                            <div class="col-lg-12">
                                <label for="main_short_description"
                                    class="form-label fw-semibold">{{ __('Main Short Description') }}</label>
                                <textarea name="main_short_description" id="main_short_description" rows="3"
                                    class="form-control form-control-lg @error('main_short_description') is-invalid @enderror">{{ old('main_short_description', $data->main_short_description ?? '') }}</textarea>
                                @error('main_short_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Banner Heading -->
                            <div class="col-lg-12">
                                <label for="banner_heading"
                                    class="form-label fw-semibold">{{ __('Banner Heading') }}</label>
                                <input type="text" name="banner_heading" id="banner_heading"
                                    class="form-control form-control-lg @error('banner_heading') is-invalid @enderror"
                                    value="{{ old('banner_heading', $data->banner_heading ?? '') }}">
                                @error('banner_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Banner Short Description -->
                            <div class="col-lg-12">
                                <label for="banner_short_description"
                                    class="form-label fw-semibold">{{ __('Banner Short Description') }}</label>
                                <textarea name="banner_short_description" id="banner_short_description" rows="3"
                                    class="form-control form-control-lg @error('banner_short_description') is-invalid @enderror">{{ old('banner_short_description', $data->banner_short_description ?? '') }}</textarea>
                                @error('banner_short_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Banner Image -->
                            <div class="col-lg-6">
                                <label for="banner_image"
                                    class="form-label fw-semibold">{{ __('Banner Image/Video') }}</label>
                                <input type="file" name="banner_image" id="banner_image"
                                    class="form-control form-control-lg @error('banner_image') is-invalid @enderror">
                                @if (!empty($data->banner_image))
                                    <img src="{{ asset('storage/repair_services/' . $data->banner_image) }}"
                                        alt="{{ $data->banner_image_alt ?? '' }}" class="mt-2"
                                        style="max-height:80px;">
                                @endif
                                @error('banner_image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Banner Image Alt -->
                            <div class="col-lg-6">
                                <label for="banner_image_alt"
                                    class="form-label fw-semibold">{{ __('Banner Image Alt') }}</label>
                                <input type="text" name="banner_image_alt" id="banner_image_alt"
                                    class="form-control form-control-lg @error('banner_image_alt') is-invalid @enderror"
                                    value="{{ old('banner_image_alt', $data->banner_image_alt ?? '') }}">
                                @error('banner_image_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Repair Service Heading -->
                            <div class="col-lg-12">
                                <label for="repair_service_heading"
                                    class="form-label fw-semibold">{{ __('Repair Service Heading') }}</label>
                                <input type="text" name="repair_service_heading" id="repair_service_heading"
                                    class="form-control form-control-lg @error('repair_service_heading') is-invalid @enderror"
                                    value="{{ old('repair_service_heading', $data->repair_service_heading ?? '') }}">
                                @error('repair_service_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label for="repair_service_short_description"
                                    class="form-label fw-semibold">{{ __('Repair Short Description') }}</label>
                                <textarea name="repair_service_short_description" id="repair_service_short_description" rows="3"
                                    class="form-control form-control-lg @error('repair_service_short_description') is-invalid @enderror">{{ old('repair_service_short_description', $data->repair_service_short_description ?? '') }}</textarea>
                                @error('repair_service_short_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- X Ray Heading -->
                            <div class="col-lg-12">
                                <label for="x_ray_heading"
                                    class="form-label fw-semibold">{{ __('X-Ray Heading') }}</label>
                                <input type="text" name="x_ray_heading" id="x_ray_heading"
                                    class="form-control form-control-lg @error('x_ray_heading') is-invalid @enderror"
                                    value="{{ old('x_ray_heading', $data->x_ray_heading ?? '') }}">
                                @error('x_ray_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label for="x_ray_short_description"
                                    class="form-label fw-semibold">{{ __('X-Ray Short Description') }}</label>
                                <textarea name="x_ray_short_description" id="x_ray_short_description" rows="3"
                                    class="form-control form-control-lg @error('x_ray_short_description') is-invalid @enderror">{{ old('x_ray_short_description', $data->x_ray_short_description ?? '') }}</textarea>
                                @error('x_ray_short_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- C-Arm Heading -->
                            <div class="col-lg-12">
                                <label for="c_arm_heading"
                                    class="form-label fw-semibold">{{ __('C-Arm Heading') }}</label>
                                <input type="text" name="c_arm_heading" id="c_arm_heading"
                                    class="form-control form-control-lg @error('c_arm_heading') is-invalid @enderror"
                                    value="{{ old('c_arm_heading', $data->c_arm_heading ?? '') }}">
                                @error('c_arm_heading')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label for="c_arm_short_description"
                                    class="form-label fw-semibold">{{ __('C-Arm Short Description') }}</label>
                                <textarea name="c_arm_short_description" id="c_arm_short_description" rows="3"
                                    class="form-control form-control-lg @error('c_arm_short_description') is-invalid @enderror">{{ old('c_arm_short_description', $data->c_arm_short_description ?? '') }}</textarea>
                                @error('c_arm_short_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- SEO Fields -->
                            <div class="col-lg-6">
                                <label for="meta_title" class="form-label fw-semibold">{{ __('Meta Title') }}</label>
                                <input type="text" name="meta_title" id="meta_title"
                                    class="form-control form-control-lg @error('meta_title') is-invalid @enderror"
                                    value="{{ old('meta_title', $data->meta_title ?? '') }}">
                                @error('meta_title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label for="meta_keywords"
                                    class="form-label fw-semibold">{{ __('Meta Keywords') }}</label>
                                <input type="text" name="meta_keywords" id="meta_keywords"
                                    class="form-control form-control-lg @error('meta_keywords') is-invalid @enderror"
                                    value="{{ old('meta_keywords', $data->meta_keywords ?? '') }}">
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
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end mt-4">
                            @if (isset($data->id) && $data->id)
                                @can('write repair service')
                                    <button type="submit" class="btn btn-primary">
                                        @include('partials/general/_button-indicator', [
                                            'label' => 'Update',
                                        ])
                                    </button>
                                @endcan
                            @else
                                @can('create repair service')
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
    @endpush

</x-default-layout>
