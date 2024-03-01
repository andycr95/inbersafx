<div class="d-none" id="currentPath">login_page</div>

<section class="section px-4 pt-120 pb-120">

    <div class="row justify-content-center">
        <div class="col">
            <div class="login-area">

               {{--  <div class="text-center mb-3">
                    <img width="230px" src="https://ouch-cdn2.icons8.com/x1_3aZalX0XM1D2QhyZvb1i3pHVEnk56Nk7dHWARHfw/rs:fit:811:456/czM6Ly9pY29uczgu/b3VjaC1wcm9kLmFz/c2V0cy9zdmcvNjI1/LzcxMDI4Njk4LTk0/NDYtNGNlOC04NDU0/LTg3YTBjMWRlN2Y4/ZS5zdmc.png" alt="">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-auto">
                            <div class="input-group">
                                <button class="btn btn-outline-light" type="button" id="loginPageBtn">Login</button>
                                <button class="btn btn-outline-light" type="button" id="registerPageBtn">Signup</button>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <form class="action-form mt-50 loginForm" id="loginForm" action="{{ route('user.login') }}" method="post">
                    @csrf

                    {{-- <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="email" name="email" placeholder="@lang('enter email address')"
                                class="form-control text-warning" value="{{ old('email') }}">
                        </div>
                    </div><!-- form-group end --> --}}
                    
                    <span style="color: #FFFFFF; margin-bottom: 10px; font-size: 19px;">Login your account</span><br/>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" name="username" placeholder="@lang('Username')"
                                class="form-control text-warning" value="{{ old('username') }}">
                        </div>
                    </div><!-- form-group end -->


                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            {{-- <label class="label">@lang('Password')</label> --}}
                            <input type="password" name="password" placeholder="@lang('Password')"
                                class="form-control text-warning" value="{{ old('password') }}">
                        </div>
                    </div><!-- form-group end -->
                    
                    <p><font color="#f0b90b" id="registerPageBtn">Forgot your password?</font></p>

                    <button type="submit" class="btn login-btn w-100 mt-3 py-1 loginSubmitBtn">Login</button><br/>
                    {{-- <a class="btn sign-up-btn w-100 mt-1 py-1" href="{{route('user.register')}}">Sign Up</a> --}}
                    <p><span style="color: #838383; margin-top: 10px;">Don't have an account? <font color="#f0b90b" id="registerPageBtn">Create New One</font></span></p>
                </form>
            </div>
        </div>
    </div>

</section>

<!-- jquery -->
<script src="{{ asset('asset/theme3/frontend/js/jquery.min.js') }}"></script>
<!-- nav_script -->
@include('theme3.includes.auth.nav_script')
<script>
    $(document).on('submit', '#loginForm', function (e) {
        e.preventDefault();
        $('.loginSubmitBtn').html(BtnSPIN);
        var formData = new FormData($('#loginForm')[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('user.login') }}",
            data: formData,
            dataType: "json",
            contentType: false, // The content type used when sending data to the server.
            processData: false,
            success: function (res) {
                notifyMsg(res.msg, res.cls);
                $('.loginSubmitBtn').html('Login');
                if (res.cls === 'success') {
                    setTimeout(() => {
                        window.location.href = "{{route('user.dashboard')}}";
                    }, 1000);
                }
            },
            error: function (err) {
                $('.loginSubmitBtn').html('Login');
                let errors = err.responseJSON.errors;
                let result = '';
                $.each(errors, function (index, value) {
                    console.log(value);
                    result += value+'<br>'
                });

                notifyMsg(result, 'error')
            }
        });

    });
</script>

