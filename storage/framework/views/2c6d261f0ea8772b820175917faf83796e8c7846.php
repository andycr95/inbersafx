<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#1E2329">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="shortcut icon" type="image/png" href="<?php echo e(getFile('icon', @$general->favicon)); ?>">

    <title>
        <?php if(@$general->sitename): ?>
            <?php echo e(__(@$general->sitename) . '-'); ?>

        <?php endif; ?>
        <?php echo e(__(@$pageTitle)); ?>

    </title>

    <link rel="stylesheet" href="<?php echo e(asset('asset/theme3/frontend/css/cookie.css')); ?>">
    <link href="<?php echo e(asset('asset/theme3/frontend/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('asset/theme3/frontend/css/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('asset/theme3/frontend/css/slick.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('asset/theme3/frontend/css/font-awsome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('asset/theme3/frontend/css/iziToast.min.css')); ?>">
    <link href="<?php echo e(asset('asset/theme3/frontend/css/style.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('asset/theme1/frontend/css/color.php?primary_color=' . str_replace('#', '', @$general->primary_color))); ?>">

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
    <style>
        .btn{
            font-size: 12px !important;
            border-radius: 10px 10px;
            height: 45px;
        }
        .login-btn {
            font-size: 15px !important;
            background: #f0b90b !important;
            color: #0c0e12;
        }
        .login-btn:hover {
            font-size: 15px !important;
            background: #B9992C !important;
            color: #0c0e12;
            opacity: .9;
        }
        .sign-up-btn {
            font-size: 15px !important;
            background: #f0b90b !important;
            color: #0c0e12;
        }
        .sign-up-btn:hover {
            font-size: 15px !important;
            background: #B9992C !important;
            color:  #0c0e12;
            opacity: .9;
        }
        .label {
            color:  #0c0e12 !important;
        }
        body {
            /* background-image: url('<?php echo e(asset('asset/images/bg/bg-1.png')); ?>'); */
            background: #262930;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center top;
            box-shadow: inset 0 0 0 2000px #1E2329;
        }

        .country-code .input-group-prepend .input-group-text {
            background: #fff !important;
        }

        .country-code select {
            border: none;
        }

        .country-code select:focus {
            border: none;
            outline: none;
        }

        .hover-input-popup {
            position: relative;
        }

        .hover-input-popup:hover .input-popup {
            opacity: 1;
            visibility: visible;
        }

        .input-popup {
            position: absolute;
            bottom: 130%;
            left: 50%;
            width: 280px;
            background-color: #1a1a1a;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            -ms-border-radius: 5px;
            -o-border-radius: 5px;
            -webkit-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            transform: translateX(-50%);
            opacity: 0;
            visibility: hidden;
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }

        .input-popup::after {
            position: absolute;
            content: '';
            bottom: -19px;
            left: 50%;
            margin-left: -5px;
            border-width: 10px 10px 10px 10px;
            border-style: solid;
            border-color: transparent transparent #1a1a1a transparent;
            -webkit-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        .input-popup p {
            padding-left: 20px;
            position: relative;
        }

        .input-popup p::before {
            position: absolute;
            content: '';
            font-family: 'Line Awesome Free';
            font-weight: 900;
            left: 0;
            top: 4px;
            line-height: 1;
            font-size: 18px;
        }

        .input-popup p.error {
            text-decoration: line-through;
        }

        .input-popup p.error::before {
            content: "\f057";
            color: #ea5455;
        }

        .input-popup p.success::before {
            content: "\f058";
            color: #28c76f;
        }
        /* input */
        .input-group .input-group-text {
            background: white;
            border-bottom: 0px solid #DCDCE9;
            border-radius: 20px !important;
            height: 42px;
            margin-right: 10px;
        }
        .form-control {
            padding: 1px 0.9375rem;
            border: 1px solid #484C55;
            border-radius: 5px 5px !important;
            background-color: #1E2329;
            color: #fff !important;
            width: 100%;
            height: 3.0rem;
        }
        .form-control::placeholder {
            color: #eeeeee !important;
            font-size: 14px;
        }
        .form-control:focus {
            background-color: #1E2329;
            border-color: #F0B90B !important;
        }
        label {
            margin-bottom: 3px;
            font-size: 12px;
        }
    </style>
    <style>
        body, .appHeader, .appBottomMenu {
            max-width: 500px;
            margin: auto;
        }
    </style>

    <style>
        #appCapsule {
            height: 100vh !important;
            width: 100% !important;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    </style>
    
    <style>
        .swal2-popup.swal2-toast {
            background: rgba( 0, 0, 0, 0.5 ) !important;
            box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 ) !important;
            backdrop-filter: blur( 11.5px ) !important;
            -webkit-backdrop-filter: blur( 11.5px ) !important;
            border-radius: 10px !important;
            border: 1px solid rgba( 255, 255, 255, 0.18 ) !important;
            padding: 5px !important;
            width: auto !important;
        }
        .swal2-popup.swal2-toast .swal2-title {
            margin: 10px 5px !important;
            color: #FFF !important;
        }
        [chrome-autofilled] {
            background-color: #e5f1fb38 !important;
            color: #ffffff !important;
        }
    </style>

</head>

<body class="text-capitalize">

    <!-- Preloader Ajax Start -->
    <div id="preLoadCustom" class="d-none">
        <div class="custom_preload d-flex align-items-center justify-content-center">
            <img width="40px" class="loaderCustom" src="<?php echo e(asset('asset/images/loader/loading-spiner.gif')); ?>" alt="">
        </div>
    </div>
    <!-- Preloader Ajax End -->
    <?php if(@$general->preloader_status): ?>
        <div id="preloader"></div>
    <?php endif; ?>

    <?php if(@$general->allow_modal): ?>
        <?php echo $__env->make('cookieConsent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>


    <?php if(@$general->analytics_status): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(@$general->analytics_key); ?>"></script>
        <script>
            'use strict'
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag("js", new Date());
            gtag("config", "<?php echo e(@$general->analytics_key); ?>");
        </script>
    <?php endif; ?>

    <main id="main" class="main-img">
        <!-- App Header -->
        <div class="text-center position-absolute w-100">
            <a href="<?php echo e(route('home')); ?>">
                <img style="height: 40px" class="pt-2 " src="<?php echo e(getFile('logo', @$general->whitelogo)); ?>" alt="">
            </a>
        </div>

        <!-- * App Header -->
        <div id="appCapsule">
            <?php echo $__env->yieldContent('content'); ?>
        </div><!-- #appCapsule -->
    </main>

    <script src="<?php echo e(asset('asset/theme3/frontend/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/theme3/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/theme3/frontend/js/slick.min.js')); ?>"></script>

    <script src="<?php echo e(asset('asset/theme3/frontend/js/wow.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/theme3/frontend/js/jquery.paroller.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/theme3/frontend/js/TweenMax.min.js')); ?>"></script>

    <script src="<?php echo e(asset('asset/theme3/frontend/vendor/php-email-form/validate.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/theme3/frontend/js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/theme3/frontend/js/iziToast.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/theme3/frontend/js/jquery.uploadPreview.min.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('script'); ?>
    <?php if(@$general->twak_allow): ?>
        <script type="text/javascript">
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = "https://embed.tawk.to/<?php echo e(@$general->twak_key); ?>";
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>
    <?php endif; ?>



    <?php if(Session::has('error')): ?>
        <script>
            "use strict";
            iziToast.error({
                message: "<?php echo e(session('error')); ?>",
                position: 'topRight'
            });
        </script>
    <?php endif; ?>

    <?php if(Session::has('success')): ?>
        <script>
            "use strict";
            iziToast.success({
                message: "<?php echo e(session('success')); ?>",
                position: 'topRight'
            });
        </script>
    <?php endif; ?>

    <?php if(session()->has('notify')): ?>
        <?php $__currentLoopData = session('notify'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <script>
                "use strict";
                iziToast.<?php echo e($msg[0]); ?>({
                    message: "<?php echo e(trans($msg[1])); ?>",
                    position: "topRight"
                });
            </script>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <?php if(@$errors->any()): ?>
        <script>
            "use strict";
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                iziToast.error({
                message: "<?php echo e(__($error)); ?>",
                position: "topRight"
                });
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </script>
    <?php endif; ?>
    <!-- Sweet Alert 2.0 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //-- Notify --//
        const notifyMsg = (msg,cls) => {
            Swal.fire({
                position: 'center',
                icon: cls,
                title: msg,
                toast:true,
                showConfirmButton: false,
                timer: 2100
            })
        }

        const BtnSPIN = `<div class="spinner-border spinner-border-sm" role="status"></div>`;

        const customPush = (route) => {
            window.history.pushState("", "", route);
        }

    </script>

    <script>
        $(window).on('load', function () {
            btnClr()
        });


        // btn-coller-change
        const btnClr = () => {
            if( $('#currentPath').html() == 'login_page' ){
                $('#loginPageBtn').removeClass("btn-outline-light").addClass("btn-light");
            }

            if( $('#currentPath').html() == 'register_page' ){
                $('#registerPageBtn').removeClass("btn-outline-light").addClass("btn-light");
            }
        }

        // user login page view
        $(document).on('click', '#loginPageBtn', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('user.ajax.login')); ?>",
                success: function (res) {
                    console.log(res);
                    $('#appCapsule').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    customPush("<?php echo e(route('user.login')); ?>") // url-change
                    btnClr()
                }
            });
        });

        // user register page view
        $(document).on('click', '#registerPageBtn', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('user.ajax.register')); ?>",
                success: function (res) {
                    console.log(res);
                    $('#appCapsule').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    customPush("<?php echo e(route('user.register')); ?>") // url-change
                    btnClr()
                }
            });
        });
    </script>


    <script>
        'use strict';



        $(document).ready(function() {
            $('#trial_subscribe').on('click', function(e) {

                e.preventDefault();
                var email = $('#trial_email').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'POST',
                    url: "<?php echo e(route('subscribe')); ?>",
                    data: {
                        email: email
                    },
                    success: function(response) {

                        if (response.fails) {
                            notify('error', response.errorMsg.email)

                        }

                        if (response.success) {
                            $('#email').val('');
                            notify('success', response.successMsg)

                        }
                    }
                });
            })


        });
    </script>


    <script>
        'use strict'
        var url = "<?php echo e(route('user.changeLang')); ?>";

        $(".changeLang").change(function() {
            if ($(this).val() == '') {
                return false;
            }
            window.location.href = url + "?lang=" + $(this).val();
            console.log(window.location.href);
        });

        //Get the button
        let mybutton = document.getElementById("btn-back-to-top");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
            ) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        mybutton.addEventListener("click", backToTop);

        function backToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>


</body>


</html>
<?php /**PATH /home/crevitoc/Crevito/script.crevito.com/binancetrade/core/resources/views/theme3/layout/auth.blade.php ENDPATH**/ ?>