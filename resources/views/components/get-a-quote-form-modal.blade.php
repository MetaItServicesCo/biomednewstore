<div class="buy-form-overlay" id="getAQuoteFormOverlay">
    <div class="buy-form-box">
        <span class="close-form text-danger">&times;</span>

        <h3>Get A <span>Quote</span></h3>

        <form class="buy-form" id="getAQuoteForm" method="POST" action="{{ route('get-a-quote.submit') }}">
            @csrf
            <div>
                <input type="text" name="name" placeholder="Full Name" required>
                <span class="text-danger error-text name_error"></span>
            </div>
            <div>
                <input type="email" name="email" placeholder="Email Address" required>
                <span class="text-danger error-text email_error"></span>
            </div>

            <div>
                <input type="tel" name="phone" placeholder="Phone" required>
                <span class="text-danger error-text phone_error"></span>
            </div>
            <div>
                <select name="state" id="get_quote_form_state" required>
                    <option value="">Select State</option>
                    @foreach (getPriorityStates() as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger error-text state_error"></span>
            </div>

            <div>
                <select name="city" id="get_quote_form_city">
                    <option value="">Select City</option>
                </select>
                <span class="text-danger error-text city_error"></span>
            </div>

            <div>
                <textarea name="message" placeholder="Message" required></textarea>
                <span class="text-danger error-text message_error"></span>
            </div>

            <div class="col-12">
                <div class="g-recaptcha" id="getQuoteCaptcha" data-sitekey="{{ config('services.recaptcha.sitekey') }}"></div>
                <span class="text-danger error-text g-recaptcha-response_error"></span>
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
</div>
