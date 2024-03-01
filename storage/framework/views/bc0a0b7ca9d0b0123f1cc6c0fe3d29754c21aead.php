<div class="d-none" id="currentPath">login_page</div>

<section class="section px-4 pt-120 pb-120">

    <div class="row justify-content-center">
        <div class="col">
            <div class="login-area">

               

                <form class="action-form mt-50 loginForm" id="loginForm" action="<?php echo e(route('user.login')); ?>" method="post">
                    <?php echo csrf_field(); ?>

                    
                    
                    <span style="color: #FFFFFF; margin-bottom: 10px; font-size: 19px;">Login your account</span><br/>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" name="username" placeholder="<?php echo app('translator')->get('Username'); ?>"
                                class="form-control text-warning" value="<?php echo e(old('username')); ?>">
                        </div>
                    </div><!-- form-group end -->


                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            
                            <input type="password" name="password" placeholder="<?php echo app('translator')->get('Password'); ?>"
                                class="form-control text-warning" value="<?php echo e(old('password')); ?>">
                        </div>
                    </div><!-- form-group end -->
                    
                    <p><font color="#f0b90b" id="registerPageBtn">Forgot your password?</font></p>

                    <button type="submit" class="btn login-btn w-100 mt-3 py-1 loginSubmitBtn">Login</button><br/>
                    
                    <p><span style="color: #838383; margin-top: 10px;">Don't have an account? <font color="#f0b90b" id="registerPageBtn">Create New One</font></span></p>
                </form>
            </div>
        </div>
    </div>

</section>

<!-- jquery -->
<script src="<?php echo e(asset('asset/theme3/frontend/js/jquery.min.js')); ?>"></script>
<!-- nav_script -->
<?php echo $__env->make('theme3.includes.auth.nav_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    $(document).on('submit', '#loginForm', function (e) {
        e.preventDefault();
        $('.loginSubmitBtn').html(BtnSPIN);
        var formData = new FormData($('#loginForm')[0]);
        $.ajax({
            type: "POST",
            url: "<?php echo e(route('user.login')); ?>",
            data: formData,
            dataType: "json",
            contentType: false, // The content type used when sending data to the server.
            processData: false,
            success: function (res) {
                notifyMsg(res.msg, res.cls);
                $('.loginSubmitBtn').html('Login');
                if (res.cls === 'success') {
                    setTimeout(() => {
                        window.location.href = "<?php echo e(route('user.dashboard')); ?>";
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

<?php /**PATH /home/webesite/binance.webesite.xyz/core/resources/views/theme3/user/auth/ajax/login.blade.php ENDPATH**/ ?>