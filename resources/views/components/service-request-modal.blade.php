<div class="service-modal-overlay" id="serviceModal">
    <div class="service-modal-box">

        <span class="service-modal-close">&times;</span>

        <!-- Heading -->
        <h2 class="service-modal-heading">Service Request</h2>

        <!-- Form  -->
        <form class="service-form" id="serviceRequestForm" action="{{ route('service.request.submit') }}" method="POST">
            @csrf

            <div class="row g-2">

                <!-- Full Name -->
                <div class="col-md-6 col-6">
                    <input type="text" name="name" class="form-control form-control-sm" placeholder="Full Name"
                        required>
                    <span class="text-danger error-text name_error"></span>
                </div>

                <!-- Email -->
                <div class="col-md-6 col-6">
                    <input type="email" name="email" class="form-control form-control-sm"
                        placeholder="Email Address" required>
                    <span class="text-danger error-text email_error"></span>
                </div>

                <!-- Phone -->
                <div class="col-md-6 col-6">
                    <input type="tel" name="phone" class="form-control form-control-sm" placeholder="Phone Number"
                        required>
                    <span class="text-danger error-text phone_error"></span>
                </div>

                <!-- Company -->
                <div class="col-md-6 col-6">
                    <input type="text" name="company" class="form-control form-control-sm"
                        placeholder="Company / Hospital Name">
                    <span class="text-danger error-text company_error"></span>
                </div>

                <!-- Services -->
                <div class="col-md-6 col-6">
                    <select name="service" class="form-select form-select-sm" required>
                        <option value="" disabled selected>Select Service</option>
                        @foreach (getServicesList() as $service)
                            <option value="{{ $service }}">{{ $service }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger error-text service_error"></span>
                </div>

                <!-- Preferred Contact -->
                <div class="col-md-6 col-6">
                    <label class="form-label mb-1">Preferred Contact</label>
                    <div class="radio-group d-flex gap-3">
                        <label class="form-check form-check-inline m-0">
                            <input class="form-check-input" type="radio" name="preferred_contact" value="email"
                                required checked>
                            <span>Email</span>
                        </label>
                        <label class="form-check form-check-inline m-0">
                            <input class="form-check-input" type="radio" name="preferred_contact" value="phone"
                                required>
                            <span>Phone</span>
                        </label>
                    </div>
                    <span class="text-danger error-text preferred_contact_error"></span>
                </div>

                <!-- Equipment Category (Full Width) -->
                <div class="col-12">
                    <label class="form-label mb-1">Equipment Category</label>
                    <div class="checkbox-group d-flex flex-wrap gap-2">
                        @foreach ($all_categories as $category)
                            <label class="form-check form-check-inline m-0">
                                <input class="form-check-input" type="checkbox" name="categories[]"
                                    value="{{ $category->slug }}">
                                <span>{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    <span class="text-danger error-text categories_error"></span>
                </div>

                <!-- Message (Full Width) -->
                <div class="col-12">
                    <textarea name="message" rows="3" class="form-control form-control-sm" placeholder="Message / Details" required></textarea>
                    <span class="text-danger error-text message_error"></span>
                </div>


                <!-- Recaptcha -->
                <div class="col-12">
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.sitekey') }}"></div>
                    <span class="text-danger error-text g-recaptcha-response_error"></span>
                </div>

                <!-- Submit -->
                <div class="col-12">
                    <button type="submit" class="service-submit-btn w-100">
                        Submit Request
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>
