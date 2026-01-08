<x-default-layout>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <!-- Begin::Card -->
            <div class="card">
                <!-- Begin::Card Header -->
                <div class="card-header py-3">
                    <h3 class="card-title text-dark">{{ __('Change Password') }}</h3>
                    <p class="text-muted fs-7 mb-0">{{ __('Enter your details to change your password.') }}</p>
                </div>
                <!-- End::Card Header -->

                <!-- Begin::Card Body -->
                <div class="card-body">
                    <form action="{{ route('update-password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Begin::Old Password -->
                        <div class="mb-7">
                            <label class="form-label fw-bold text-dark">{{ __('Old Password') }}</label>
                            <input type="password" name="old_password"
                                class="form-control @error('old_password') is-invalid @enderror"
                                placeholder="{{ __('Enter your old Password') }}" required>
                            @error('old_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!-- End::Old Password -->

                        <!-- Begin::New Password -->
                        <div class="mb-7">
                            <label class="form-label fw-bold text-dark">{{ __('New Password') }}</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="{{ __('Enter new password') }}" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!-- End::New Password -->

                        <!-- Begin::Confirm Password -->
                        <div class="mb-7">
                            <label class="form-label fw-bold text-dark">{{ __('Confirm Password') }}</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="{{ __('Confirm new password') }}" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!-- End::Confirm Password -->

                        <!-- Begin::Submit -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-sm ">
                                {{ __('Change Password') }}
                            </button>
                        </div>
                        <!-- End::Submit -->
                    </form>
                </div>
                <!-- End::Card Body -->
            </div>
            <!-- End::Card -->
        </div>
    </div>
</x-default-layout>
