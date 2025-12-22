<div id="donate-popup" class="donate-popup">
    <div class="close-donate theme-btn"><span class="fa fa-close"></span></div>
    <div class="popup-inner">
        <div class="container">
            <div class="donate-form-area">
                <div class="section-title center">
                    <h2>Donation Information</h2>
                </div>
                
                <form action="{{ route('donation.checkout') }}" method="POST" class="donate-form default-form">
                    @csrf
                    <input type="hidden" name="currency" id="donation-currency" value="USD">
                    
                    <h3>Donor Information</h3>
                    <div class="form-bg">
                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <p>Your Name <span style="color: red;">*</span></p>
                                    <input type="text" name="name" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <p>Email <span style="color: red;">*</span></p>
                                    <input type="email" name="email" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <p>Address <span style="color: red;">*</span></p>
                                    <input type="text" name="address" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <p>Select Country <span style="color: red;">*</span></p>
                                    <select name="country" id="donation-country" class="form-control">
                                        @foreach($activeCountries as $country)
                                            <option value="{{ $country->id }}" 
                                                data-currency-code="{{ $country->currency_code }}" 
                                                data-currency-symbol="{{ $country->currency_symbol }}"
                                                data-min-phone="{{ $country->min_phone_length }}"
                                                data-max-phone="{{ $country->max_phone_length }}"
                                                {{ ($settings['default_country'] ?? '') == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <p>Phone Number <span style="color: red;">*</span></p>
                                    <input type="text" name="phone" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4>How much would you like to donate:</h4>
                    <ul class="chicklet-list clearfix">
                        <li>
                            <input type="radio" id="donate-amount-1" name="amount" value="1000" />
                            <label for="donate-amount-1" data-amount="1000">$1000</label>
                        </li>
                        <li>
                            <input type="radio" id="donate-amount-2" name="amount" value="2000" checked="checked" />
                            <label for="donate-amount-2" data-amount="2000">$2000</label>
                        </li>
                        <li>
                            <input type="radio" id="donate-amount-3" name="amount" value="3000" />
                            <label for="donate-amount-3" data-amount="3000">$3000</label>
                        </li>
                        <li>
                            <input type="radio" id="donate-amount-4" name="amount" value="4000" />
                            <label for="donate-amount-4" data-amount="4000">$4000</label>
                        </li>
                        <li>
                            <input type="radio" id="donate-amount-5" name="amount" value="5000" />
                            <label for="donate-amount-5" data-amount="5000">$5000</label>
                        </li>
                        <li class="other-amount">
                            <div class="input-container" data-message="Every dollar you donate helps end hunger.">
                                <span>Or</span><input type="text" id="other-amount" name="custom_amount" placeholder="Other Amount" maxlength="10" />
                            </div>
                        </li>
                    </ul>

                    <ul class="payment-option">
                        <li>
                            <h4>Choose your payment method:</h4>
                        </li>
                        <li>
                            <div class="checkbox">
                                <label>
                                    <input name="payment_method" type="radio" value="paypal" checked>
                                    <span>Paypal</span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <label>
                                    <input name="payment_method" type="radio" value="offline">
                                    <span>Offline Donation</span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <label>
                                    <input name="payment_method" type="radio" value="credit_card">
                                    <span>Credit Card</span>
                                </label>
                            </div>
                        </li>
                    </ul>

                    <div class="center"><button class="thm-btn" type="submit">Donate Now</button></div>
                </form>
                
                <script>
                    const amountInput = document.getElementById('other-amount');

                    // Prevent invalid keystrokes
                    amountInput.addEventListener('keypress', function(e) {
                        // Allow digits and dot only
                        if (!/[\d\.]/.test(e.key)) {
                            e.preventDefault();
                            return;
                        }
                        // Allow only one dot
                        if (e.key === '.' && this.value.includes('.')) {
                            e.preventDefault();
                        }
                    });

                    // Sanitize input (handles paste and typing)
                    amountInput.addEventListener('input', function(e) {
                        let value = this.value;

                        // Remove any non-numeric characters except dot
                        value = value.replace(/[^0-9.]/g, '');

                        // Ensure only one dot
                        const parts = value.split('.');
                        if (parts.length > 2) {
                            value = parts[0] + '.' + parts.slice(1).join('');
                        }

                        // Limit to 2 decimal places
                        if (parts.length > 1 && parts[1].length > 2) {
                            value = parts[0] + '.' + parts[1].substring(0, 2);
                        }

                        this.value = value;
                    });
                </script>
            </div>
        </div>
    </div>
</div>
