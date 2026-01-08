<x-default-layout>
    <div class="container-fluid">
        <h2>General Settings</h2>

        <form action="{{ route('admin-general.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- General -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header p-5 rounded-top">
                            <div class="d-flex w-100 justify-content-between align-items-center">
                                <h3 class="fw-bolder mb-0">{{ __('General') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Site Name</label>
                                <input type="text" name="site_name" class="form-control"
                                    value="{{ setting('site_name') }}">
                            </div>
                            <div class="mb-3">
                                <label>Logo</label>
                                <input type="file" name="site_logo" class="form-control">
                                @if (setting('site_logo'))
                                    <img src="{{ asset('storage/' . setting('site_logo')) }}" width="150"
                                        class="mt-2">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label>Favicon</label>
                                <input type="file" name="favicon" class="form-control">
                                @if (setting('favicon'))
                                    <img src="{{ asset('storage/' . setting('favicon')) }}" width="50"
                                        class="mt-2">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header p-5 rounded-top">
                            <div class="d-flex w-100 justify-content-between align-items-center">
                                <h3 class="fw-bolder mb-0">{{ __('Contact Info') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ setting('phone') }}">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ setting('email') }}">
                            </div>
                            <div class="mb-3">
                                <label>WhatsApp</label>
                                <input type="text" name="whatsapp" class="form-control"
                                    value="{{ setting('whatsapp') }}">
                            </div>
                            <div class="mb-3">
                                <label>Address</label>
                                <textarea name="address" class="form-control">{{ setting('address') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Links -->
            <div class="card mb-4">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h3 class="fw-bolder mb-0">{{ __('Social Links') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Facebook</label>
                            <input type="url" name="facebook" class="form-control"
                                value="{{ setting('facebook') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Instagram</label>
                            <input type="url" name="instagram" class="form-control"
                                value="{{ setting('instagram') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Twitter / X</label>
                            <input type="url" name="twitter" class="form-control" value="{{ setting('twitter') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>LinkedIn</label>
                            <input type="url" name="linkedin" class="form-control"
                                value="{{ setting('linkedin') }}">
                        </div>
                    </div>
                </div>
            </div>


            <div class="d-flex justify-content-end mt-4">
                @php
                    // Check karo kya koi setting already exist karti hai?
                    $hasSettings = \App\Models\GeneralSetting::count() > 0;
                @endphp
                @if($hasSettings)
                    @can('write general settings')
                        <button type="submit" class="btn btn-primary">
                            @include('partials/general/_button-indicator', [
                                'label' => 'Update',
                            ])
                        </button>
                    @endcan
                @else
                    @can('create general settings')
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

    @push('scripts')
    @endpush

</x-default-layout>
