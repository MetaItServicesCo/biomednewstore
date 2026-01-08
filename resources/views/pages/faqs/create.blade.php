<x-default-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        @if (isset($data->id) && !empty($data->id))
                            <h3 class="fw-bolder mb-0">{{ __('Edit FAQ') }}</h3>
                        @else
                            <h3 class="fw-bolder mb-0">{{ __('Create FAQ') }}</h3>
                        @endif
                        <a href="{{ route('admin-faqs.index') }}" class="btn btn-light btn-md">
                            <i class="bi bi-arrow-left me-2"></i>{{ __('Back to FAQ List') }}
                        </a>
                    </div>
                </div>

                @php
                    $url = isset($data->id) ? route('admin-faqs.update', $data->id) : route('admin-faqs.store');
                @endphp

                <div class="card-body p-5">
                    <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($data->id))
                            @method('PUT')
                        @endif
                        <div class="row">

                            <!-- Pages -->
                            <div class="col-lg-12 mb-4">
                                <label for="page_name"
                                    class="form-label fw-semibold required">{{ __('Pages') }}</label>

                                <select name="page_name" id="page_name" class="form-control form-select"
                                    @error('page_name') is-invalid @enderror data-control="select2" required>
                                    <option value="" disabled selected>Select Page</option>
                                    @foreach ($pages as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ old('page_name', $data->page_name ?? '') == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('page_name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>



                            <!-- Question -->
                            <div class="col-lg-12 mb-4">
                                <label for="question"
                                    class="form-label fw-semibold required">{{ __('Question') }}</label>
                                <input type="text" id="question" name="question"
                                    class="form-control form-control-lg @error('question') is-invalid @enderror"
                                    value="{{ old('question', $data->question ?? '') }}" required>
                                @error('question')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Answer -->
                            <div class="col-lg-12 mb-4">
                                <label for="answer"
                                    class="form-label fw-semibold required">{{ __('Answer') }}</label>
                                <textarea id="answer" name="answer" class="form-control form-control-lg @error('answer') is-invalid @enderror"
                                    rows="3" required>{{ old('answer', $data->answer ?? '') }}</textarea>
                                @error('answer')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                        <div class="d-flex justify-content-end mt-4">
                            @if (isset($data->id) && $data->id)
                                @can('write faq')
                                    <button type="submit" class="btn btn-primary">
                                        @include('partials/general/_button-indicator', [
                                            'label' => 'Update',
                                        ])
                                    </button>
                                @endcan
                            @else
                                @can('create faq')
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
