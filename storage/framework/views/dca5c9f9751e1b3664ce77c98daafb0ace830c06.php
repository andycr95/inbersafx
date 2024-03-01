
<div class="container">
    <!-- Image Upload -->
    <div class="card my-3">
        <div class="row user-profile text-center align-items-center">
            <div  class="col-6 profile-thumb-wrapper text-center mt-2 mb-1">
                <div style="width: 7.25rem; height: 7.25rem;" class="profile-thumb">
                    <div class="avatar-preview">
                        <div style="width: 7.25rem; height: 7.25rem; background-image: url( '<?php echo e(@Auth::user()->image ? getFile('user', @Auth::user()->image) : dummyImg()); ?>' );" class="profilePicPreview rounded-circle" style=""></div>
                    </div>

                    <form action="#" method="POST" enctype="multipart/form-data" id="imgForm">
                        <div class="avatar-edit">
                            <input type='file' class="profilePicUpload" id="image" name="image" accept=".png, .jpg, .jpeg" />
                            <label  class="text-white bg-warning imgEdit" for="image">
                                <span class="material-icons">photo_camera</span>
                            </label>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-6 text-start">
                <h3 class="mb-0 title"><?php echo e(__($user->fullname)); ?></h3>
                <span><?php echo app('translator')->get('user id'); ?>: <?php echo e(__($user->username)); ?></span>
            </div>
        </div>
    </div>

    <div class="d-none" id="currentPath">Account</div>
    <!-- Account Navigation -->
    <?php echo $__env->make('theme3.includes.user.account_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <form id="profileSetting" action="<?php echo e(route('user.profileupdate')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="subtitle mb-0">
                    User Informations
                </h4>
            </div>

            <div class="card-body">

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">First Name</label>
                        <?php if($user->fname): ?>
                        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo e($user->fname); ?>" style="opacity: 0.5" readonly>
                        <?php else: ?>
                        <input placeholder="first name" type="text" class="form-control" id="fname" name="fname">
                        <?php endif; ?>
                        
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">Last Name</label>
                        <?php if($user->lname): ?>
                        <input placeholder="last name" type="text" class="form-control" id="lname" value="<?php echo e($user->lname); ?>" name="lname" style="opacity: 0.5" readonly>
                        <?php else: ?>
                        <input placeholder="last name" type="text" class="form-control" id="lname" name="lname">
                        <?php endif; ?>

                       
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">Mobile Number</label>
                        <?php if($user->phone): ?>
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo e($user->phone); ?>" style="opacity: 0.5" readonly >
                        <?php else: ?>
                        <input placeholder="phone number" type="tel" class="form-control" id="phone" name="phone" value="<?php echo e($user->phone); ?>" <?php if($user->phone): ?> readonly  <?php endif; ?> >
                        <?php endif; ?>
                       
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">E-Mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo e($user->email); ?>" style="opacity: 0.5" readonly>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <h4 class="text-center p-0 mt-1">KYC Verification</h4>
                    <?php if($kyc!=null && $kyc->status ==1): ?>
                    <span class="text-center d-block">Verify Status: <p class="text-success p-0 m-0 d-inline">Complete</p></span>
                    <?php elseif($kyc !=null && $kyc->status == 2): ?>
                    <span class="text-center d-block">Verify Status: <p class="text-danger p-0 m-0 d-inline">Rejected</p></span>
                    <?php elseif($kyc !=null && $kyc->status == 0): ?>
                    <span class="text-center d-block">Verify Status: <p class="text-success p-0 m-0 d-inline">Pending</p></span>
                    <?php endif; ?>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">Card Type</label>
                        <?php if($kyc!=null && $kyc->status != 2 && $kyc->status !=0): ?>
                        <select name="type" class="form-control" readonly style="opacity: 0.5">
                            <option selected value="<?php echo e($kyc->type); ?>"><?php echo e($kyc->type); ?></option>
                            <option value="national ID">national ID</option>
                            <option value="Driving licence">Driving licence</option>
                            <option value="Passport">Passport</option>
                        </select>
                      
                        <?php else: ?> 
                        <select name="type" class="form-control">
                            <option value="national ID">national ID</option>
                            <option value="Driving licence">Driving licence</option>
                            <option value="Passport">Passport</option>
                        </select>
                        <?php endif; ?>
                        
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">Country</label>
                        <?php if($kyc!=null && $kyc->status != 2 && $kyc->status !=0): ?>
                        <select name="country" class="form-control" readonly style="opacity: 0.5">
                            <option selected value="<?php echo e($kyc->country); ?>"><?php echo e($kyc->country); ?></option>
                             <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->country); ?>"><?php echo e($item->country); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                       
                        <?php else: ?> 
                        <select name="country" class="form-control">
                             <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->country); ?>"><?php echo e($item->country); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php endif; ?>
                        
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">Front Part</label>
                        <?php if($kyc!=null): ?>
                        <input type='file' id="image" name="nid" accept=".png, .jpg, .jpeg"  <?php if( $kyc->status==1 || $kyc->status== 0): ?> readonly <?php else: ?> required <?php endif; ?>/>
                        <?php else: ?>
                        <input type='file' id="image" name="nid" accept=".png, .jpg, .jpeg"  required />
                        <?php endif; ?>
                       
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary rounded-pill w-100 ProfileSubmitBtn">Update Information</button>
            </div>
        </div>
    </form>
</div>


<script>
    'use strict'
    document.getElementById("imageUpload").onchange = function() {
        show();
    };

    function show() {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-id-preview");
            preview.src = src;
            preview.style.display = "block";
            document.getElementById("file-id-preview").style.visibility = "visible";
        }
    }
</script>

<script>
    //--profile Photo--//
    (function($){

    function proPicURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = $(input).parents('.profile-thumb').find('.profilePicPreview');
                $(preview).css('background-image', 'url(' + e.target.result + ')');
                $(preview).addClass('has-image');
                $(preview).hide();
                $(preview).fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".profilePicUpload").on('change', function(e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "<?php echo e(route('user.profile.photo')); ?>",
            data: new FormData($("#imgForm")[0]),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                console.log(res.msg);
                notifyMsg(res.msg,res.cls)
                $('#loadProfilePhoto').attr('style', '');
                $('#loadProfilePhoto').attr('style', "background-image: url('<?php echo e(route('home')); ?>/"+res.img+"');");
                $('.profileImgView').attr('src', "<?php echo e(route('home')); ?>/"+res.img); // change-image on top-nav
            }
        });
        proPicURL(this);

    });

    $(".remove-image").on('click', function(){
    $(".profilePicPreview").css('background-image', 'none');
    $(".profilePicPreview").removeClass('has-image');
    })

    })(jQuery);
</script>

<script>
    //-- Proile Setting --//
    $(document).on('submit', '#profileSetting', function (e) {
        e.preventDefault();
        var status='<?php echo e($kyc->status?? 100); ?>'
        if(status==1){
            notifyMsg('Account info alreday verified can change this data','error'); 
        }else if (status ==0){
            notifyMsg('Account veryfication pending can change info','error'); 
        } else{
          
            $('.ProfileSubmitBtn').html(BtnSPIN);
            let formData = new FormData($("#profileSetting")[0])
            $.ajax({
            type: "POST",
            url: "<?php echo e(route('user.profileupdate')); ?>",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                console.log(res);
                notifyMsg(res.msg,res.cls)
                window.location.href = "<?php echo e(route('user.kyclist')); ?>";
                $('.ProfileSubmitBtn').html("Update Information");
            }
        });
        }
       
    });
</script>
<?php /**PATH /var/www/pacificode_c_usr8/data/www/trading.pacificode.co/resources/views/theme3/user/ajax/profile.blade.php ENDPATH**/ ?>