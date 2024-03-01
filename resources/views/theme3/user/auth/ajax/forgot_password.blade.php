<section class="auth-section">
        <div class="auth-wrapper">
           

            <div class="auth-body-part">
                <div class="auth-form-wrapper">
                    <h3 class="text-center mb-4">{{ __('Request For Reset Password') }}</h3>
                    <form action="{{ route('user.forgot.password') }}" method="POST">
                       
                        <div class="mb-3">
                            <label>{{ __('Email Address') }} <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" id="email"
                            placeholder="{{ __('Enter Email') }}">
                        </div>
                       
                        
                        <button type="submit" id="recaptcha" class="btn main-btn w-100">{{ __('Send Verification Code') }}</button>
                    </form>
                </div>
            </div>
           
        </div>
        <div class="auth-thumb-area" style="background-image: url('{{ asset('asset/theme3/images/bg/plan.jpg') }}')">
            <div class="auth-thumb">
                <img src="{{ getFile('frontendlogin', @$general->frontend_login_image) }}" alt="image">
            </div>
        </div>
    </section>

