<x-default-layout>

    @section('title')
        {{ __('Contact Us Inquiry Details') }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Inquiry Information') }}</h3>
            <div class="card-toolbar">
                <a href="{{ route('admin.contact-us.form.list') }}" class="btn btn-sm btn-light">
                    {!! getIcon('arrow-left', 'fs-2') !!}
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-7">
                <label class="col-lg-4 fw-bold text-muted">{{ __('Name') }}</label>
                <div class="col-lg-8">
                    <span class="fw-bolder fs-6 text-gray-800">{{ $inquiry->name }}</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 fw-bold text-muted">{{ __('Email') }}</label>
                <div class="col-lg-8">
                    <a href="mailto:{{ $inquiry->email }}" class="fw-bolder fs-6 text-gray-800 text-hover-primary">
                        {{ $inquiry->email }}
                    </a>
                </div>
            </div>

            @if($inquiry->phone)
            <div class="row mb-7">
                <label class="col-lg-4 fw-bold text-muted">{{ __('Phone') }}</label>
                <div class="col-lg-8">
                    <span class="fw-bolder fs-6 text-gray-800">{{ $inquiry->phone }}</span>
                </div>
            </div>
            @endif

            <div class="row mb-7">
                <label class="col-lg-4 fw-bold text-muted">{{ __('State') }}</label>
                <div class="col-lg-8">
                    <span class="fw-bolder fs-6 text-gray-800">{{ $inquiry->state->name ?? 'N/A' }}</span>
                </div>
            </div>

            @if($inquiry->city)
            <div class="row mb-7">
                <label class="col-lg-4 fw-bold text-muted">{{ __('City') }}</label>
                <div class="col-lg-8">
                    <span class="fw-bolder fs-6 text-gray-800">{{ $inquiry->city->name ?? 'N/A' }}</span>
                </div>
            </div>
            @endif

            @if($inquiry->service)
            <div class="row mb-7">
                <label class="col-lg-4 fw-bold text-muted">{{ __('Service') }}</label>
                <div class="col-lg-8">
                    <span class="fw-bolder fs-6 text-gray-800">{{ $inquiry->service }}</span>
                </div>
            </div>
            @endif

            <div class="row mb-7">
                <label class="col-lg-4 fw-bold text-muted">{{ __('Message') }}</label>
                <div class="col-lg-8">
                    <span class="fw-bolder fs-6 text-gray-800">{{ $inquiry->message }}</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 fw-bold text-muted">{{ __('Submitted At') }}</label>
                <div class="col-lg-8">
                    <span class="fw-bolder fs-6 text-gray-800">{{ $inquiry->created_at->format('M d, Y h:i A') }}</span>
                </div>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-end">
            <button type="button" class="btn btn-danger" onclick="event.preventDefault(); 
                if(confirm('Are you sure you want to delete this inquiry?')) {
                    document.getElementById('delete-inquiry-form').submit();
                }">
                {!! getIcon('trash', 'fs-2') !!}
                {{ __('Delete') }}
            </button>

            <form id="delete-inquiry-form" action="{{ route('admin.contact-us.form.destroy', $inquiry->id) }}" 
                method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

</x-default-layout>
