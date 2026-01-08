<x-default-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        @if (isset($data->id) && !empty($data->id))
                            <h3 class="fw-bolder mb-0">{{ __('Edit OEMs') }}</h3>
                        @else
                            <h3 class="fw-bolder mb-0">{{ __('Create OEMs') }}</h3>
                        @endif
                        <a href="{{ route('admin-oems.index') }}" class="btn btn-light btn-md">
                            <i class="bi bi-arrow-left me-2"></i>{{ __('Back to OEMs List') }}
                        </a>
                    </div>
                </div>

                @php
                    $url = isset($data->id) ? route('admin-oems.update', $data->id) : route('admin-oems.store');
                @endphp

                <div class="card-body p-5">
                    <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($data->id))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $data->title ?? '') }}">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control"
                                    value="{{ old('slug', $data->slug ?? '') }}">
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Order</label>
                                <input type="number" name="order" class="form-control"
                                    value="{{ old('order', $data->order ?? 1) }}">
                                @error('order')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                @if (isset($data->image) && $data->image)
                                    <img src="{{ asset('storage/oem_contents/' . $data->image) }}" width="120"
                                        class="mt-2 mb-2">
                                @endif
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Image Alt</label>
                                <input type="text" name="image_alt" class="form-control"
                                    value="{{ old('image_alt', $data->image_alt ?? '') }}">
                                @error('image_alt')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" class="form-control"
                                    value="{{ old('meta_title', $data->meta_title ?? '') }}">
                                @error('meta_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Meta Keywords</label>
                                <input type="text" name="meta_keywords" class="form-control"
                                    value="{{ old('meta_keywords', $data->meta_keywords ?? '') }}">
                                @error('meta_keywords')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control">{{ old('meta_description', $data->meta_description ?? '') }}</textarea>
                                @error('meta_description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label>Description</label>
                                <textarea name="description" id="oems_description" class="form-control">{{ old('description', $data->description ?? '') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>



                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                        <div class="d-flex justify-content-end mt-4">
                            @if (isset($data->id) && $data->id)
                                @can('write oem')
                                    <button type="submit" class="btn btn-primary">
                                        @include('partials/general/_button-indicator', [
                                            'label' => 'Update',
                                        ])
                                    </button>
                                @endcan
                            @else
                                @can('create oem')
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // image validation
                const image = document.getElementById('image');
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
                ClassicEditor
                    .create(document.querySelector('#oems_description'), {
                        ckfinder: {
                            uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}&dir=oem_contents/ckeditor"
                        }
                    })
                    .then(editor => {
                        console.log(`CKEditor initialized for #oems_description`);
                    })
                    .catch(error => console.error(error));
            });
        </script>
    @endpush

</x-default-layout>
