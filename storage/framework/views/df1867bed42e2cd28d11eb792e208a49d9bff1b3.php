
<div class="container">

    <div class="card my-3">
        <div class="row user-profile text-center align-items-center">
            <div  class="col-6 profile-thumb-wrapper text-center mt-2 mb-1">
                <div style="width: 7.25rem; height: 7.25rem;" class="profile-thumb">
                    <div class="avatar-preview">
                        <div style="width: 7.25rem; height: 7.25rem; background-image: url( '<?php echo e(@Auth::user()->image ? getFile('user', @Auth::user()->image) : dummyImg()); ?>' );" class="profilePicPreview rounded-circle" style=""></div>
                    </div>
                </div>
            </div>
            <div class="col-6 text-start">
                <h3 class="mb-0 title"><?php echo e(__(auth()->user()->fullname)); ?></h3>
                <span><?php echo app('translator')->get('user id'); ?>: <?php echo e(__(auth()->user()->username)); ?></span>
            </div>
        </div>
    </div>

    <div class="d-none" id="currentPath">Password</div>
    <!-- Account Navigation -->
    <?php echo $__env->make('theme3.includes.user.account_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <form id="passwordChange" action="<?php echo e(route('user.update.password')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="card mb-4">
            <div class="card-header">
                <h4 class="subtitle mb-0">
                    Change Password
                </h4>
            </div>

            <div class="card-body">

                

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">New Password</label>
                        <input type="password" class="form-control" name="password" placeholder="<?php echo e(__('Enter New Password')); ?>">
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="<?php echo e(__('Confirm Password')); ?>">
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary rounded-pill w-100 PasswordSubmitBtn">Update Password</button>
            </div>
        </div>
    </form>
</div>

<script>
    //-- Password Change --//
    $(document).on('submit', '#passwordChange', function (e) {
       e.preventDefault();
       $('.PasswordSubmitBtn').html(BtnSPIN);
       let formData = new FormData($("#passwordChange")[0])
       $.ajax({
           type: "POST",
           url: "<?php echo e(route('user.update.password')); ?>",
           data: formData,
           processData: false,
           dataType: 'json',
           contentType: false,
           success: function (res) {
               console.log(res);
               notifyMsg(res.msg,res.cls)
               $('.PasswordSubmitBtn').html("Update Password");
               if (res.cls == 'success') {
                    $("#passwordChange")[0].reset();
               }
           },
           error: function (err) {
                let errors = err.responseJSON.errors;
                let problems = '';
                let key = 1;
                $.each(errors, function (index, value) {
                    problems += (key++)+':'+value+'<br>';
                });

                notifyMsg(problems,'error')
                $('.PasswordSubmitBtn').html("Update Password");
           }
       });
   });
</script>
<?php /**PATH /var/www/pacificode_c_usr8/data/www/trading.pacificode.co/resources/views/theme3/user/auth/ajax/changepassword.blade.php ENDPATH**/ ?>