<section class="contact-section py-5">
    <div class="container">
        <div class="row g-3">

            <!-- Left Column -->
            <div class="col-lg-6 animate-card">
                <h2 class="contact-heading mb-3">Contact Us</h2>

                <p class="contact-desc mb-4">
                    Want to learn more about how you can maximize the potential of your healthcare facility by enlisting
                    biomedical equipment services from Mr Biomed Tech? We offer support all across Texas. Call, email,
                    or visit us to discuss rentals, repairs, purchasing, or equipment disposition today.
                </p>

                <div class="contact-info mb-3">
                    <i class="bi bi-telephone-fill contact-icon"></i>
                    <a href="tel:{{ cleanPhone(setting('phone')) }}" class="contact-text">
                        {{ setting('phone') }}
                    </a>
                </div>

                <div class="contact-info mb-3">
                    <i class="bi bi-envelope-fill contact-icon"></i>
                    <a href="mailto:{{ setting('email') }}" class="contact-text">
                        {{ setting('email') }}
                    </a>
                </div>

                <div class="contact-info mb-4">
                    <i class="bi bi-geo-alt-fill contact-icon"></i>
                    <span class="contact-text">{{ setting('address') }}</span>
                </div>

                <h5 class="tech-heading mb-3">
                    Technicians dispatched from throughout Texas
                </h5>

                @foreach ($area_names as $item)
                    <div class="contact-info">
                        <i class="bi bi-check-lg contact-icon"></i>
                        <span class="contact-textt">
                            {{ $item->area_name ?? '' }}
                        </span>
                    </div>
                @endforeach
            </div>

            <!-- Right Column -->
            <div class="col-lg-6 animate-card">
                <div class="form-wrapper p-4">
                    <h3 class="form-heading mb-3">
                        Do You Want Quick Chat?
                    </h3>

                    <p class="form-desc mb-4">
                        Our Texas-based biomedical technicians are ready to answer your questions, provide you with
                        quotes, or schedule a consultation. Let's have a conversation. We’re on call 24/7 and can get
                        you in touch with a team member right away!
                    </p>

                    <form class="contact-us-form" action="{{ route('contact.us.form') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <input type="text" name="name" class="form-control formm-input"
                                placeholder="Enter Name" value="{{ old('name') }}">
                            <span class="text-danger error-text name_error"></span>

                        </div>

                        <div class="mb-3">
                            <input type="email" name="email" class="form-control formm-input"
                                placeholder="Enter Email" value="{{ old('email') }}">
                            <span class="text-danger error-text email_error"></span>

                        </div>

                        <!-- State & City -->
                        <div class="d-flex gap-3 mb-2">
                            <div class="mb-3">
                                <select name="state" class="form-select formm-select" name="state" id="form_state">
                                    <option value="">{{ __('Select State') }}</option>

                                    @foreach ($footerStates ?? [] as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <select class="form-select formm-select" id="form_city" name="city">
                                    <option>Select City</option>
                                </select>
                                <span class="text-danger error-text city_error"></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <select name="service" class="form-select formmm-select">
                                <option value="" disabled selected>Services Dropdown</option>
                                @foreach (getServicesList() as $service)
                                    <option value="{{ $service }}">{{ $service }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text service_error"></span>
                        </div>

                        <div class="mb-3">
                            <textarea name="message" class="form-control formm-text" rows="4" placeholder="Enter Message">{{ old('message') }}</textarea>
                            <span class="text-danger error-text message_error"></span>

                        </div>

                        <div class="form-group mb-3">
                            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                            <div class="g-recaptcha w-100" id="contactFormCaptcha"
                                data-sitekey="{{ config('services.recaptcha.sitekey') }}">
                            </div>
                            <span class="text-danger error-text g-recaptcha-response_error"></span>
                        </div>

                        <button type="submit" class="btn submit-btn">
                            Request Submit
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>
