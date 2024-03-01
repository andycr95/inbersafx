<!DOCTYPE html>
<html lang="en">

<head>

    <?php echo $__env->make('theme3.includes.frontend.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Custom Css Blade-->
    <?php echo $__env->make('theme3.layout.custom.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('theme3.layout.custom.red', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldPushContent('style'); ?>
    <!-- Owl -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css">


    <style>
        .owl-dots{
            display: none;
        }
        .imgEdit {
            width: 35px !important;
            height: 35px !important;
            margin-left: -3.5rem !important;
            margin-bottom: 1.5rem !important;
        }
    </style>
    <style>
        .intl-tel-input {
            position: relative;
            display: inline-block;
            width: 100% !important;
        }

        .profile-thumb {
            position: relative;
            width: 11.25rem;
            height: 11.25rem;
            border-radius: 15px;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            -ms-border-radius: 15px;
            -o-border-radius: 15px;
            display: inline-flex;
        }
        .profile-thumb .profilePicPreview {
            width: 11.25rem;
            height: 11.25rem;
            border-radius: 15px;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            -ms-border-radius: 15px;
            -o-border-radius: 15px;
            display: block;
            border: 3px solid #ffffff;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.25);
            background-size: cover;
            background-position: center;
        }
        .profile-thumb .profilePicUpload {
            font-size: 0;
            opacity: 0;
        }
        .profile-thumb .avatar-edit {
            position: absolute;
            right: -15px;
            bottom: -20px;
        }
        .profile-thumb .avatar-edit input {
            width: 0;
        }
        .profile-thumb .avatar-edit label {
            width: 45px;
            height: 45px;
            background-color: #37ebec;
            border-radius: 50%;
            text-align: center;
            line-height: 45px;
            border: 2px solid #ffffff;
            font-size: 18px;
            cursor: pointer;
            color: #000000;
        }
    </style>

    <!-- jquery -->
    <script src="<?php echo e(asset('asset/theme3/frontend/js/jquery.min.js')); ?>"></script>

    <style>
        .custom_preload{
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 9999999999;
        }
        .loderCustom{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50% -50%)
        }
    </style>




</head>

<body>

    

    <!-- Preloader Ajax Start -->
    <div id="preLoadCustom" class="d-none">
        <div class="custom_preload d-flex align-items-center justify-content-center">
            <img width="40px" class="loaderCustom" src="<?php echo e(asset('asset/images/loader/loading-spiner.gif')); ?>" alt="">
            
        </div>
    </div>
    <!-- Preloader Ajax End -->

    <!-- custom loader -->
    
    <!-- * custom loader -->

    

    <main id="main" class="dashboard-main">
        <section class="dashboard-section">
            


            <!-- Float btn -->
            <?php echo $__env->make('theme3.includes.frontend.float_btn', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- Top Nav -->
            <?php echo $__env->make('theme3.includes.user.top_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- Side Nav -->
            <?php echo $__env->make('theme3.includes.user.side_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- App Capsule -->
            <div id="appCapsule">
                <?php echo $__env->yieldContent('content2'); ?>
            </div>

            <!-- Bottom Nav -->
            <?php echo $__env->make('theme3.includes.user.bottom_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- Deposit Action Sheet -->
            
            <!-- Withdraw Action Sheet -->
            
            <!-- Transfer Action Sheet -->
            



        </section>
    </main>

    <?php
        $content = content('contact.content');
        $contentlink = content('footer.content');
        $footersociallink = element('footer.element');
        $serviceElements = element('service.element');
    ?>

    <?php echo $__env->make('theme3.includes.frontend.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH /Users/a/Documents/trading/core/resources/views/theme3/layout/master2.blade.php ENDPATH**/ ?>