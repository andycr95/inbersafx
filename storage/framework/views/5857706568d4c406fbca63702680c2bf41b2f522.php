<div class="d-none" id="currentPath">register_page</div>

<section class="section px-4 pt-120 pb-120">

    <div class="row justify-content-center">
        <div class="col">
            <div class="login-area">

                

                <form class="action-form mt-50 loginForm" action="<?php echo e(route('user.register')); ?>" method="post">
                    
                    <span style="color: #FFFFFF; margin-bottom: 10px; font-size: 19px;">Sign Up to your account</span><br/>
                    
                    <?php echo csrf_field(); ?>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" name="username" id="username" placeholder="Username" class="form-control text-warning" value="<?php echo e(old('username')); ?>">
                            <small class="usernameCheck text-danger"></small>
                        </div>
                    </div><!-- form-group end -->


                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="email" name="email" id="email" placeholder="Email Address" class="form-control text-warning" value="<?php echo e(old('email')); ?>">
                            <small class="emailCheck text-danger"></small>
                        </div>
                    </div><!-- form-group end -->


                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="password" name="password" placeholder="Password"
                                class="form-control text-warning" value="<?php echo e(old('password')); ?>">
                        </div>
                    </div><!-- form-group end -->


                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                                class="form-control text-warning" value="<?php echo e(old('password_confirmation')); ?>">
                        </div>
                    </div><!-- form-group end -->

                    
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" name="reffered_by" id="reffer" placeholder="Reffer Code (Optional)" class="form-control text-warning" value="<?php echo e(request()->reffer); ?>">
                            <small class="refferCheck text-danger"></small>
                        </div>
                    </div><!-- form-group end -->
                    
                    
                    <p><span style="color:#838383;">By creating an account, I agree to XTrade's <a href="https://criptotrading.world/"><font color="#f0b90b">Terms of Service</font></a> and <a href="https://criptotrading.world/"><font color="#f0b90b">Privacy Policy</font></a><font color="#838383">.</font></span></p>
                    <button type="submit" class="btn login-btn w-100 mt-3 py-1">Sign Up</button><br/>
                    
                    <p><span style="color: #838383; margin-top: 10px;">Already registered? <font color="#f0b90b" id="loginPageBtn">Sign in to your account</font></span></p>
                </form>
            </div>
        </div>
    </div>

</section>

<!-- jquery -->
<script src="<?php echo e(asset('asset/theme3/frontend/js/jquery.min.js')); ?>"></script>

<script>
    // username check
    $(document).on('focusout', '#username', function (e) {
        e.preventDefault();
        let username = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo e(route('user.username.exist')); ?>",
            data: {
                _token:"<?php echo e(csrf_token()); ?>",
                username:username
            },
            success: function (res) {
                console.log(res);
                if (res.cls == 'success') {
                    $('.usernameCheck').html('username already exist!');
                } else {
                    $('.usernameCheck').html('');
                }
            }
        });
    });

    // email check
    $(document).on('focusout', '#email', function (e) {
        e.preventDefault();
        let email = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo e(route('user.email.exist')); ?>",
            data: {
                _token:"<?php echo e(csrf_token()); ?>",
                email:email
            },
            success: function (res) {
                console.log(res);
                if (res.cls == 'success') {
                    $('.emailCheck').html('email already exist!');
                } else {
                    $('.emailCheck').html('');
                }
            }
        });
    });

    // reffer check
    $(document).on('keyup', '#reffer', function (e) {
        e.preventDefault();
        let reffer = $(this).val();
        if (!reffer) {
            return $('.refferCheck').html('');
        }
        $.ajax({
            type: "POST",
            url: "<?php echo e(route('user.reffer.exist')); ?>",
            data: {
                _token:"<?php echo e(csrf_token()); ?>",
                reffer:reffer
            },
            success: function (res) {
                console.log(res);
                if (res.cls == 'success') {
                    $('.refferCheck').removeClass('text-danger').addClass('text-success');
                    $('.refferCheck').html(res.msg);
                } else {
                    $('.refferCheck').removeClass('text-success').addClass('text-danger');
                    $('.refferCheck').html(res.msg);
                }
            }
        });
    });
</script>

<?php /**PATH /Users/a/Documents/trading/core/resources/views/theme3/user/auth/ajax/register.blade.php ENDPATH**/ ?>