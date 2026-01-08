<x-default-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        @if (isset($data->id) && !empty($data->id))
                            <h3 class="fw-bolder mb-0">{{ __('Edit Blog Comment') }}</h3>
                        @else
                            <h3 class="fw-bolder mb-0">{{ __('Create Blog Comment') }}</h3>
                        @endif
                        <a href="{{ route('admin-blogs-comment.list') }}" class="btn btn-light btn-md">
                            <i class="bi bi-arrow-left me-2"></i>{{ __('Back to blog List') }}
                        </a>
                    </div>
                </div>

                @php
                    $url = isset($data->id)
                        ? route('admin-blogs-comment.update', $data->id)
                        : route('admin-blogs-comment.store');
                @endphp

                <div class="card-body p-5">
                    <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($data->id))
                            @method('PUT')
                        @endif
                        <div class="row">

                            <div class="col-lg-6 mb-4">
                                <label for="name"
                                    class="form-label fw-semibold required">{{ __('Name') }}</label>
                                <input type="text" id="name" name="name"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    value="{{ old('name', $data->name ?? '') }}" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="email"
                                    class="form-label fw-semibold required">{{ __('Email') }}</label>
                                <input type="text" id="email" name="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    value="{{ old('email', $data->email ?? '') }}" required>
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="blog_title" class="form-label fw-semibold">{{ __('Blog Title') }}</label>
                                <input type="text" id="blog_title"
                                    class="form-control form-control-lg @error('blog_title') is-invalid @enderror"
                                    value="{{ old('blog_title', plainBracketText($data->blog?->title ?? '')) }}" readonly>
                                @error('blog_title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="status"
                                    class="form-label fw-semibold required">{{ __('Status') }}</label>
                                <select name="status" id="status"
                                    class="form-select form-select-lg @error('status') is-invalid @enderror">
                                    <option value="pending"
                                        {{ old('status', $data->status ?? '') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="approved"
                                        {{ old('status', $data->status ?? '') == 'approved' ? 'selected' : '' }}>
                                        Approved</option>
                                    <option value="rejected"
                                        {{ old('status', $data->status ?? '') == 'rejected' ? 'selected' : '' }}>
                                        Rejected</option>
                                </select>
                                @error('status')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12 mb-4">
                                <label for="comment"
                                    class="form-label fw-semibold required">{{ __('Comment') }}</label>
                                <textarea name="comment" id="comment" rows="5"
                                    class="form-control form-control-lg @error('comment') is-invalid @enderror" placeholder="Enter comment" required>{{ old('comment', $data->comment ?? '') }}</textarea>
                                @error('comment')
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
                                </button>
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
