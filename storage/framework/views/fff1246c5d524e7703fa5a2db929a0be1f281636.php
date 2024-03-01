
<div class="container">
    <!-- Image Upload -->
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
                <h3 class="mb-0 title"><?php echo e(__($user->fullname)); ?></h3>
                <span><?php echo app('translator')->get('user id'); ?>: <?php echo e(__($user->username)); ?></span>
            </div>
        </div>
    </div>

    <div class="d-none" id="currentPath">Address</div>
    <!-- Account Navigation -->
    <?php echo $__env->make('theme3.includes.user.account_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <form id="addressSetting" action="<?php echo e(route('user.addressupdate')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="card mb-4">
            <div class="card-header">
                <h4 class="subtitle mb-0">
                    User Address
                </h4>
            </div>

            <div class="card-body">

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">State</label>
                        <input type="text" class="form-control" id="state" name="state" value="<?php echo e(@$user->address->state); ?>" <?php if(@$user->address->state): ?> readonly <?php endif; ?>>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">Zip Code</label>
                        <input type="text" class="form-control" id="zip" name="zip" value="<?php echo e(@$user->address->zip); ?>" <?php if(@$user->address->zip): ?> readonly <?php endif; ?>>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="<?php echo e(@$user->address->city); ?>" <?php if(@$user->address->city): ?> readonly <?php endif; ?>>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="<?php echo e(@$user->address->country); ?>" <?php if(@$user->address->country): ?> readonly <?php endif; ?>>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary rounded-pill w-100 AddressSubmitBtn">Update Address</button>
            </div>

        </div>
    </form>

</div>



<script>
     //-- Address Setting --//
     $(document).on('submit', '#addressSetting', function (e) {
        e.preventDefault();
        $('.AddressSubmitBtn').html(BtnSPIN);
        let formData = new FormData($("#addressSetting")[0])
        $.ajax({
            type: "POST",
            url: "<?php echo e(route('user.addressupdate')); ?>",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                console.log(res);
                notifyMsg(res.msg,res.cls)
                $('.AddressSubmitBtn').html("Update Address");
            }
        });
    });
</script>
<?php /**PATH /var/www/pacificode_c_usr8/data/www/trading.pacificode.co/resources/views/theme3/user/ajax/address.blade.php ENDPATH**/ ?>