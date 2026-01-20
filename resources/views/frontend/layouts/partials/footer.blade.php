<style>
    @import url('https://fonts.googleapis.com/css2?family=Saira+Stencil+One&display=swap');

    html,
    body {
        overflow-x: hidden;
        width: 100%;
    }

    * {
        box-sizing: border-box;
    }

    /* Baaqi CSS yahan se shuru karein */
    .custom-footer {
        background: linear-gradient(to right, #006A9E 55%, #7DAAC0);
        position: relative;
        padding-top: 80px;
        color: white;
        margin-top: 100px
    }

    .contact-container {
        background-color: white;
        padding: 20px 40px;
        margin: 0 auto;
        width: 90%;
        max-width: 1200px;
        /* height: 112px; */
        position: absolute;
        top: -50px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        border: 1px solid #000000;
        border-radius: 21px;
        /* box-shadow: 0 5px 14px #E9A426; */
        height: 112px;
        border: 1px solid #0071A8;
        transition: all 0.5s ease-in-out;
    }

    .contact-container:hover {
        transform: translateX(-50%) scale(1.03);
    }


    .contact-left h3 {
        font-size: 32px;
        color: #000000;
        font-weight: 400;
        font-family: 'Saira Stencil One', sans-serif;
        letter-spacing: 0.52em;
        line-height: 132%;
    }

    .contact-left p {
        font-size: 16px;
        font-weight: 700;
        color: #0071A8 !important;
    }

    .contact-right p {
        font-size: 20px;
        font-weight: 300;
        color: #000000;
    }

    .quote-button {
        background-color: #0071A8;
        color: white;
        font-weight: 400;
        border: none;
        /* padding: 10px 20px; */
        transition: background-color 0.3s;
        box-shadow: 0px 4px 4px #00000040;
        font-family: 'Saira Stencil One', sans-serif;
        font-size: 24px;
    }

    .quote-button:hover {
        background-color: #d19421;
        color: white;
    }

    .footer-main-content {
        padding-top: 20px;
    }

    .footer-main-content .Field {
        font-size: 32px;
        font-weight: 700;
        color: #FFFFFF;
        font-family: 'Saira', sans-serif;

    }

    /* .quick-chat-form input,
    .quick-chat-form select,
    .quick-chat-form textarea {
        border: 1px solid #7DAAC0;
        color: #0000004D;
        background-color: white;
        font-size: 14px;
        font-weight: 700;
    } */

    .footer-input {
        width: 100%;
        max-width: 427px;
        height: 23px;
        border-radius: 4px;
        color: #0000004D !important;
        font-family: 'Saira', sans-serif;
        font-weight: 700;
        font-size: 14px;
        line-height: 137%;

    }

    .footer-select {
        max-width: 210px;
        width: 100%;
        height: 29px;
        border-radius: 4px;
        color: #0000004D !important;
        font-family: 'Saira', sans-serif;
        font-weight: 700;
        font-size: 14px;
        line-height: 137%;
    }

    .footer-area {
        width: 100%;
        max-width: 427px;
        color: #0000004D !important;
        font-family: 'Saira', sans-serif;
        font-weight: 700;
        font-size: 14px;
        line-height: 137%;

    }

    .footer-input::placeholder,
    .footer-area::placeholder {
        color: #0000004D !important;
        /* opacity: 1; */
    }

    .request-submit-button {
        background-color: #ffffff;
        width: 100%;
        /* Default width 100% (responsive) */
        max-width: 427px;
        height: 25px;
        border-radius: 4px;
        color: #0000004D !important;
        font-family: 'Saira', sans-serif;
        font-weight: 700;
        font-size: 20px;
        line-height: 137%;
        border: none;

        position: relative;
        overflow: hidden;
        z-index: 1;
        transition: color 0.7s ease-in-out;
    }

    .request-submit-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;

        background-color: #055787;
        border-radius: 4px;

        transform-origin: left;
        transform: scaleX(0);

        transition: transform 0.7s ease-in-out;
        z-index: -1;
    }

    .request-submit-button:hover {
        color: #ffffff !important;
    }

    .request-submit-button:hover::before {
        /* Hover hone par, scale ko 100% kar dein */
        transform: scaleX(1);
    }



    /* Social Icons */
    .social-icons {
        background-color: #ffffff;
        display: flex;
        /* 🔥 IMPORTANT */
        align-items: center;
        /* vertical center */
        justify-content: center;
        /* horizontal center */
        gap: 14px;
        /* space between icons */
        border-radius: 5px;
        width: 228px;
        height: 48px;
    }


    .social-icons a {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #E9A426;
        text-decoration: none;
    }



    .social-icons i {
        font-size: 24px;
        color: #E9A426 !important;

    }

    .social-icons i:hover {
        transform: scale(1.3) !important;
    }

    .sepparator {
        width: 2px;
        height: 41px;
        background-color: #0071A8;
    }



    /* Footer Links and Copyright */
    .footer-links-copyright {
        margin-top: -16px;
    }

    .footer-links a:hover {
        color: #E9A426 !important;
    }

    .footer-links a {
        color: #ffffff !important;
        font-size: 14px;
        font-weight: 600;
    }

    .location-link {
        color: #FFFFFF;
    }

    /* Responsive adjustments for the overlapping container */
    @media (max-width: 768px) {
        .contact-container {
            padding: 20px;
            top: -45px;
            /* Move further up on small screens to accommodate stacking */
            height: 99px;
        }

        .custom-footer {
            /* padding-top: 120px; */
        }

        .quote-button {

            font-size: 15px;
        }

        .contact-right p {
            font-size: 14px;

        }

        .contact-left h3 {
            font-size: 29px;

        }

        .contact-left p {
            font-size: 14px;

        }

        .xray-title {
            font-size: 22px !important;
        }

        .xray-desc {
            font-size: 16px !important;
        }

        .xray-btn {

            left: 35% !important;
        }

        .custom-card .card-content-box {

            height: 184px;
        }

        .custom-card {

            height: 380px;
            /* width: 90%; */
            margin-top: 35px;
        }
    }

    @media (max-width: 767px) {
        .contact-container {
            padding: 10px !important;
            top: -45px;

            height: 115px;
        }

        .custom-footer {
            /* padding-top: 120px; */
        }

        .quote-button {

            font-size: 12px !important;
        }

        .contact-right p {
            font-size: 15px !important;

        }

        .contact-left h3 {
            font-size: 25px !important;

        }

        .contact-left p {
            font-size: 10px !important;

        }

        .footer-logo {

            height: 155px;
            width: 155px;
        }

        .custom-card {

            width: 100% !important;
        }

        .custom-card img {
            height: 300px !important;
        }

        .news-card img {
            /* height: 100% !important; */

        }

        .footer-main-content .Field {
            font-size: 28px !important;

        }
    }

    .footer-logo {
        border-top-left-radius: 40px;
        border-bottom-right-radius: 40px;
        height: 184px;
        width: 184px;
        margin-left: 29px;
    }

    .footer-p {
        font-size: 20px;
        font-weight: 300;
    }

    .footer-h4 {
        font-size: 32px;
        font-weight: 700;
        color: #FFFFFF;
        font-family: 'Saira ', sans-serif;
    }

    .footer-p {
        font-size: 16px;
        font-weight: 400;
        color: #FFFFFF;
    }

    .location-list p {
        font-size: 16px;
        font-weight: 700;
        color: #FFFFFF;
    }

    .Rate {
        font-size: 20px !important;
        font-weight: 700 !important;
        color: #000000 !important;
    }

    .review-link {
        font-size: 20px;
        font-weight: 700;
        color: #ffffff;
        text-decoration: none;
    }

    .review-link span {
        font-size: 20px;
        font-weight: 700;
        color: #E9A426;
    }

    .copyright {
        font-size: 14px;
        font-weight: 400;
        color: #FFFFFF;
    }

    .footer-links-wrapper {
        display: inline-block;
        border-bottom: 2px solid #E9A426;

        margin-bottom: 15px;
    }

    .footer-links .separator {
        color: #E9A426;
        font-size: 1em;
        font-weight: bold;
    }

    /* ======= animation ============ */
    .rotate-text {
        font-weight: 700;
        color: #ffffff;
        display: inline-block;
        letter-spacing: 1px;
    }

    .letter {
        opacity: 0;
        display: inline-block;
        animation: letterFade 0.09s forwards;
    }

    @keyframes letterFade {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>



<footer class="custom-footer" id="footerSection">
    <div class="contact-container shadow-custom ">
        <div class="d-flex justify-content-between align-items-center w-100 flex-column flex-md-row">
            <div class="contact-left mb-3 mb-md-0 text-center text-md-start">
                <h3 class=" mb-1">GET IN TOUCH</h3>
                <p class="mb-0 ">We’re here to help with equipment, parts, and biomedical support—when you need it.</p>
            </div>
            <div class="contact-right">
                <p class="mb-0">Click Here To <a href="javascript:void(0)" class="btn quote-button ms-2"
                        data-open-get-quote>Get A Quote</a></p>
            </div>
        </div>
    </div>

    <div class="container footer-main-content">
        <div class="row pt- pb-4">
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="logo-placeholder text-white fw-bold fs-4 mb-3">

                    @if (setting('site_logo'))
                        <img src="{{ asset('storage/' . setting('site_logo')) }}" alt="{{ setting('site_name') }}"
                            class="footer-logo">
                    @else
                        <img src="{{ asset('frontend/images/logo.png') }}" height="" alt="Mr. Biomed Tech Services"
                            class="footer-logo">
                    @endif

                </div>
                {{-- Social Icons - Only show if link exists --}}

                <div class="social-icons mb-3">

                    @if (setting('facebook'))
                        <a href="{{ setting('facebook') }}" target="_blank">
                            <i class="fab fa-facebook-f fa-lg"></i>
                        </a>
                    @endif

                    @if (setting('facebook') && (setting('instagram') || setting('linkedin') || setting('twitter')))
                        <span class="sepparator"></span>
                    @endif

                    @if (setting('instagram'))
                        <a href="{{ setting('instagram') }}" target="_blank">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                    @endif

                    @if (setting('instagram') && (setting('linkedin') || setting('twitter')))
                        <span class="sepparator"></span>
                    @endif

                    @if (setting('linkedin'))
                        <a href="{{ setting('linkedin') }}" target="_blank">
                            <i class="fab fa-linkedin-in fa-lg"></i>
                        </a>
                    @endif

                    @if (setting('linkedin') && setting('twitter'))
                        <span class="sepparator"></span>
                    @endif

                    @if (setting('twitter'))
                        <a href="{{ setting('twitter') }}" target="_blank">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                    @endif

                </div>

                {{-- Address --}}
                @if (setting('address'))
                    <p class="footer-p"><i class="fas fa-map-marker-alt me-2 text-white"></i> {{ setting('address') }}
                    </p>
                @endif
                {{-- Phone --}}
                @if (setting('phone'))
                    <p class="footer-p"><i class="fas fa-phone-alt me-2 text-white"></i> <a
                            href="tel:{{ cleanPhone(setting('phone')) }}"
                            class="text-white text-decoration-none hover-primary">
                            {{ setting('phone') }}
                        </a>
                    </p>
                @endif

                {{-- Email --}}
                @if (setting('email'))
                    <p class="footer-p"><i class="fas fa-envelope me-2 text-white"></i> <a
                            href="mailto:{{ setting('email') }}" class="text-white text-decoration-none hover-primary">
                            {{ setting('email') }}
                        </a>
                    </p>
                @endif
            </div>

            <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                <h4 class="footer-h4 mb-2">
                    Do You Want
                    <span class="rotate-text"></span>
                </h4>

                <p class="footer-p">Fill out the form and our team will contact you as soon as possible.
                </p>
                <form class="contact-us-form" id="footerContactUsForm" action="{{ route('contact.us.form') }}"
                    method="POST">
                    @csrf

                    <div class="mb-2">
                        <input type="text" name="name" class="form-control footer-input" placeholder="Full Name"
                            value="{{ old('name') }}">
                        <span class="text-danger error-text name_error"></span>
                    </div>

                    <div class="mb-2">
                        <input type="email" name="email" class="form-control footer-input"
                            placeholder="Email Address" value="{{ old('email') }}">
                        <span class="text-danger error-text email_error"></span>
                    </div>

                    <div class="d-flex gap-1 mb-2">
                        <div>
                            <select name="state" id="footer_state" class="form-select footer-select">
                                <option value="">Select State</option>
                                @foreach ($footerStates ?? [] as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text state_error"></span>
                        </div>
                        <div>
                            <select class="form-select footer-select" id="footer_city" name="city">
                                <option value="">Select City</option>
                            </select>
                            <span class="text-danger error-text city_error"></span>
                        </div>
                    </div>

                    <div class="mb-2">
                        <select name="service" class="form-select footer-select">
                            <option value="" disabled selected>Services Dropdown</option>
                            @foreach (getServicesList() as $service)
                                <option value="{{ $service }}">{{ $service }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text service_error"></span>
                    </div>

                    <div class="mb-3">
                        <textarea name="message" class="form-control footer-area" rows="3" placeholder="How Can I Help You?">{{ old('message') }}</textarea>
                        <span class="text-danger error-text message_error"></span>
                    </div>

                    <div class="form-group mb-3">
                        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                        <div class="g-recaptcha w-100" id="footerCaptcha"
                            data-sitekey="{{ config('services.recaptcha.sitekey') }}">
                        </div>
                        <span class="text-danger error-text g-recaptcha-response_error"></span>
                    </div>

                    <button type="submit" class="request-submit-button">Request Submit</button>
                </form>
            </div>

            <div class="col-lg-4 ps-5">
                <h4 class="Field mb-3 pb-2">Field Service Location</h4>
                <div class="row location-list mb-4">
                    @php
                        // Areas ko 2 columns me divide kar rahe hain
                        $chunks = ($servingAreas ?? collect())->chunk(ceil(($servingAreas?->count() ?? 0) / 2));
                    @endphp

                    @foreach ($chunks as $chunk)
                        <div class="col-6">
                            @foreach ($chunk as $area)
                                <p class="mb-1">
                                    <a href="{{ route('location.detail', $area->slug) }}"
                                        class="text-decoration-none location-link">
                                        {{ $area->area_name }}
                                    </a>
                                </p>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <h4 class="Rate mb-3 pb-2 ">Rate The Company</h4>
                <div class="d-flex align-items-center mb-2 ">
                    <div class="stars me-">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star-half-alt text-warning"></i>
                    </div>
                    <span class="text-white fw-bold fs-5">4.3</span>
                </div>
                <a href="#" class="review-link ">Leave Us a Review On
                    <span>Google</span> </a>
            </div>
        </div>
    </div>

    <div class="footer-links-copyright">
        <div class="container text-center ">
            <div class="footer-links-wrapper">
                <div class="footer-links mb-1">
                    <a href="{{ rtrim(env('BIO_MED_WEBSITE'), '/') }}/BioMed-Service" class="text-decoration-none mx-2">Mr Biomed
                        Service</a><span class="separator">|</span>
                    <a href="{{ rtrim(env('BIO_MED_WEBSITE'), '/') }}/locations" class="text-decoration-none mx-2">Locations</a><span
                        class="separator">|</span>
                    {{-- <a href="#" class="text-decoration-none mx-2">Product Store</a><span
                        class="separator">|</span> --}}
                    <a href="{{ rtrim(env('BIO_MED_WEBSITE'), '/') }}/about" class="text-decoration-none mx-2">About Mbmts</a><span
                        class="separator">|</span>
                    <a href="{{ rtrim(env('BIO_MED_WEBSITE'), '/') }}/blogs" class="text-decoration-none mx-2">Blog</a><span
                        class="separator">|</span>
                    {{-- <a href="#" class="text-decoration-none mx-2">Career</a><span class="separator">|</span> --}}
                    <a href="{{ rtrim(env('BIO_MED_WEBSITE'), '/') }}/terms-and-conditions" class="text-decoration-none mx-2">Terms & Conditions</a><span
                        class="separator">|</span>
                    <a href="{{ rtrim(env('BIO_MED_WEBSITE'), '/') }}/privacy-policy" class="text-decoration-none mx-2">Privacy Policy</a><span
                        class="separator">|</span>
                    <a href="{{ rtrim(env('BIO_MED_WEBSITE'), '/') }}/disclaimer" class="text-decoration-none mx-2">Disclaimer</a><span
                        class="separator">|</span>
                    <a href="{{ route('feedback') }}" class="text-decoration-none mx-2">FeedBack</a><span
                        class="separator">|</span>
                    <a href="{{ rtrim(env('BIO_MED_WEBSITE'), '/') }}/faqs" class="text-decoration-none mx-2">FAQs</a>
                </div>
            </div>
            <p class="copyright mb-0 t">
                Copyright © {{ date('Y') }} | {{ setting('site_name', 'Mr Biomed Tech Services') }} ® | All right
                reserved
            </p>
        </div>
    </div>
</footer>
<script>
    const words = [
        "Quick Chat?",
        "Support?",
        "Help?",
        "Guidance?",
        "Assistance?"
    ];

    const colors = [
        "#fff", // white
        "#00e5ff", // cyan
        "#ff5e5e", // red
        "#8aff8a", // light green
        "#d28bff" // purple
    ];

    let index = 0;
    const rotatingText = document.querySelector(".rotate-text");

    function animateLetters(word, color) {
        rotatingText.innerHTML = "";

        [...word].forEach((letter, i) => {
            const span = document.createElement("span");
            span.textContent = letter;
            span.classList.add("letter");
            span.style.animationDelay = (i * 100) + "ms"; // ✅ fix here
            span.style.color = color;
            rotatingText.appendChild(span);
        });
    }

    function rotateWord() {
        animateLetters(words[index], colors[index]);
        index = (index + 1) % words.length;
    }

    // Initial call
    rotateWord();

    // Rotate every 2.5 seconds
    setInterval(rotateWord, 2500);
</script>



{{-- <script>
    const words = [
        "Quick Chat?",
        "Support?",
        "Help?",
        "Guidance?",
        "Assistance?"
    ];

    let index = 0;
    const rotatingText = document.querySelector(".rotate-text");

    function animateLetters(word) {
        rotatingText.innerHTML = ""; 

        [...word].forEach((letter, i) => {
            const span = document.createElement("span");
            span.textContent = letter;
            span.classList.add("letter");
            span.style.animationDelay = (i * 60) + "ms";
            rotatingText.appendChild(span);
        });
    }

    function rotateWord() {
        animateLetters(words[index]);
        index = (index + 1) % words.length;
    }

    rotateWord(); 
    setInterval(rotateWord, 2500); 
</script> --}}
