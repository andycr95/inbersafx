<style>
    .item .white {
        filter: brightness(0) saturate(100%) invert(75%) sepia(8%) saturate(259%) hue-rotate(172deg) brightness(95%) contrast(87%);
    }
    .item .active {
        filter: brightness(0) saturate(100%) invert(100%) sepia(30%) saturate(0%) hue-rotate(305deg) brightness(101%) contrast(103%) !important;
    }
    .item .hover{
        filter: brightness(0) saturate(100%) invert(100%) sepia(30%) saturate(0%) hue-rotate(305deg) brightness(101%) contrast(103%) !important;
    }
    
    /* .item .active {
        filter: brightness(0) saturate(100%) invert(9%) sepia(73%) saturate(6836%) hue-rotate(356deg) brightness(96%) contrast(105%);
    } */
</style>

<!-- App Bottom Menu -->
<div class="appBottomMenu">
    <a href="<?php echo e(route('home')); ?>" class="item customLink">
        <div class="col">
            <img class="white <?php echo e(Route::is('home') ? 'active' : ''); ?>" height="30px" width="30px" src="https://cdn-icons-png.flaticon.com/128/747/747846.png" alt="">
            <strong>Home</strong>
        </div>
    </a>
    <a href="<?php echo e(route('user.usdt.index')); ?>" class="item customLink">
        <div class="col">
            <img class="white <?php echo e(Route::is('user.usdt.index') ? 'active' : ''); ?> <?php echo e(Route::is('user.usdt.index') ? 'active' : ''); ?>" height="30px" width="30px" src="https://cdn-icons-png.flaticon.com/128/1622/1622060.png" alt="">
            <strong>Deposit</strong>
        </div>
    </a>
    <a href="<?php echo e(route('user.mining')); ?>" class="item customLink">
        <div class="col">
            <img class="white <?php echo e(Route::is('user.mining') ? 'active' : ''); ?>" height="30px" width="30px" src="data:image/png;base64,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" alt="">
            <strong>Mining</strong>
        </div>
    </a>
    
    
    <a href="<?php echo e(route('user.withdraw')); ?>" class="item customLink">
        <div class="col">
            <img class="white <?php echo e(Route::is('user.withdraw') ? 'active' : ''); ?>" height="30px" width="30px" src="https://cdn-icons-png.flaticon.com/128/5928/5928961.png" alt="">
            <strong>Withdraw</strong>
        </div>
    </a>
    <?php if(auth()->guard()->guest()): ?>
    <a href="<?php echo e(route('user.login')); ?>" class="item customLink">
        <div class="col">
            <img class="white" height="30px" width="30px" src="https://cdn-icons-png.flaticon.com/128/1000/1000946.png" alt="">
            <strong>Login</strong>
        </div>
    </a>
    <?php endif; ?>
    <?php if(auth()->guard()->check()): ?>
    <a href="<?php echo e(route('user.dashboard')); ?>" class="item customLink">
        <div class="col">
            <img class="white <?php echo e(Route::is('user.dashboard') ? 'active' : ''); ?>" height="30px" width="30px" src="https://cdn-icons-png.flaticon.com/128/12274/12274974.png" alt="">
            <strong>Mine</strong>
        </div>
    </a>
    <?php endif; ?>
</div>
<!-- * App Bottom Menu -->

<?php $__env->startPush('script'); ?>

    <script>

        $(document).on('click', '.customLink', function (e) {
            e.preventDefault();
            let hrefLink = $(this).attr('href');
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            setTimeout(() => {
                GoTo(hrefLink)
            }, 100);
        });



        // Home view
        // $(document).on('click', '.homeViewBtn', function (e) {
        //     e.preventDefault();
        //     $('#preLoadCustom').removeClass('d-none'); // loader-on
        //     $.ajax({
        //         type: "GET",
        //         url: "<?php echo e(route('ajax.home')); ?>",
        //         success: function (res) {
        //             // console.log(res);
        //             $('#appCapsule').html(res);
        //             $('#preLoadCustom').addClass('d-none'); // loader-off
        //             customPush("<?php echo e(route('home')); ?>") // url-change
        //         },
        //         error: function (err) {
        //             $('#preLoadCustom').addClass('d-none'); // loader-off
        //             let error = err.responseJSON;
        //             console.log(error);
        //         }
        //     });
        // });



        // Home view
        // $(document).on('click', '.homeViewBtn', function (e) {
        //     e.preventDefault();
        //     $('#preLoadCustom').removeClass('d-none'); // loader-on
        //     setTimeout(() => {
        //         GoTo("<?php echo e(route('home')); ?>")
        //     }, 100);
        // });

        // user dashboard view
        $(document).on('click', '.userDashboardBtn', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('user.ajax.dashboard')); ?>",
                success: function (res) {
                    // console.log(res);
                    $('#appCapsule').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    customPush("<?php echo e(route('user.dashboard')); ?>") // url-change
                },
                error: function (err) {
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    let error = err.responseJSON;
                    console.log(error);
                    if (error.message === "Unauthenticated.") {
                        notifyMsg("You need to Login At first!", 'error');
                        setTimeout(() => {
                            GoTo("<?php echo e(route('user.login')); ?>")
                        }, 100);
                    }else {
                        notifyMsg('Something went wrong!', 'error');
                    }
                }
            });
        });


        // investment plan view
        $(document).on('click', '.investmentPlanBtn', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('user.ajax.investmentplan')); ?>",
                success: function (res) {
                    // console.log(res);
                    $('#appCapsule').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    customPush("<?php echo e(route('user.investmentplan')); ?>") // url-change
                },
                error: function (err) {
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    let error = err.responseJSON;
                    console.log(error);
                    if (error.message === "Unauthenticated.") {
                        notifyMsg("You need to Login At first!", 'error');
                        setTimeout(() => {
                            GoTo("<?php echo e(route('user.login')); ?>")
                        }, 100);
                    }else {
                        notifyMsg('Something went wrong!', 'error');
                    }
                }
            });
        });

        // invest all view
        $(document).on('click', '.investAllBtn', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('user.ajax.invest.all')); ?>",
                success: function (res) {
                    // console.log(res);
                    $('#appCapsule').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    customPush("<?php echo e(route('user.invest.all')); ?>") // url-change
                },
                error: function (err) {
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    let error = err.responseJSON;
                    console.log(error);
                    if (error.message === "Unauthenticated.") {
                        notifyMsg("You need to Login At first!", 'error');
                        setTimeout(() => {
                            GoTo("<?php echo e(route('user.login')); ?>")
                        }, 100);
                    }else {
                        notifyMsg('Something went wrong!', 'error');
                    }
                }
            });
        });

        // profile setting view
        $(document).on('click', '.profileSettingBtn', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('user.ajax.profile')); ?>",
                success: function (res) {
                    // console.log(res);
                    $('#appCapsule').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    customPush("<?php echo e(route('user.profile')); ?>"); // url-change
                },
                error: function (err) {
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    let error = err.responseJSON;
                    console.log(error);
                    if (error.message === "Unauthenticated.") {
                        notifyMsg("You need to Login At first!", 'error');
                        setTimeout(() => {
                            GoTo("<?php echo e(route('user.login')); ?>")
                        }, 100);
                    }else {
                        notifyMsg('Something went wrong!', 'error');
                    }
                }
            });
        });

        // address setting view
        $(document).on('click', '.addressSettingBtn', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('user.ajax.address')); ?>",
                success: function (res) {
                    // console.log(res);
                    $('#appCapsule').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    customPush("<?php echo e(route('user.address')); ?>"); // url-change
                },
                error: function (err) {
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    let error = err.responseJSON;
                    console.log(error);
                    if (error.message === "Unauthenticated.") {
                        notifyMsg("You need to Login At first!", 'error');
                        setTimeout(() => {
                            GoTo("<?php echo e(route('user.login')); ?>")
                        }, 100);
                    }else {
                        notifyMsg('Something went wrong!', 'error');
                    }
                }
            });
        });

        // password change view
        $(document).on('click', '.passwordChangeBtn', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('user.ajax.change.password')); ?>",
                success: function (res) {
                    // console.log(res);
                    $('#appCapsule').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    customPush("<?php echo e(route('user.change.password')); ?>"); // url-change
                },
                error: function (err) {
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    let error = err.responseJSON;
                    console.log(error);
                    if (error.message === "Unauthenticated.") {
                        notifyMsg("You need to Login At first!", 'error');
                        setTimeout(() => {
                            GoTo("<?php echo e(route('user.login')); ?>")
                        }, 100);
                    }else {
                        notifyMsg('Something went wrong!', 'error');
                    }
                }
            });
        });

        // reffer friend view
        $(document).on('click', '.refferFriendBtn', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('user.ajax.reffer.friend')); ?>",
                success: function (res) {
                    // console.log(res);
                    $('#appCapsule').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    customPush("<?php echo e(route('user.reffer.friend')); ?>"); // url-change
                },
                error: function (err) {
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    let error = err.responseJSON;
                    console.log(error);
                    if (error.message === "Unauthenticated.") {
                        notifyMsg("You need to Login At first!", 'error');
                        setTimeout(() => {
                            GoTo("<?php echo e(route('user.login')); ?>")
                        }, 100);
                    }else {
                        notifyMsg('Something went wrong!', 'error');
                    }
                }
            });
        });

        // deposit log view
        $(document).on('click', '.depositLogBtn', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('user.ajax.deposit.log')); ?>",
                success: function (res) {
                    // console.log(res);
                    $('#appCapsule').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    customPush("<?php echo e(route('user.deposit.log')); ?>"); // url-change
                },
                error: function (err) {
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    let error = err.responseJSON;
                    console.log(error);
                    if (error.message === "Unauthenticated.") {
                        notifyMsg("You need to Login At first!", 'error');
                        setTimeout(() => {
                            GoTo("<?php echo e(route('user.login')); ?>")
                        }, 100);
                    }else {
                        notifyMsg('Something went wrong!', 'error');
                    }
                }
            });
        });

        // withdraw log view
        $(document).on('click', '.withdrawLogBtn', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('user.ajax.withdraw.all')); ?>",
                success: function (res) {
                    // console.log(res);
                    $('#appCapsule').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    customPush("<?php echo e(route('user.withdraw.all')); ?>"); // url-change
                },
                error: function (err) {
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    let error = err.responseJSON;
                    console.log(error);
                    if (error.message === "Unauthenticated.") {
                        notifyMsg("You need to Login At first!", 'error');
                        setTimeout(() => {
                            GoTo("<?php echo e(route('user.login')); ?>")
                        }, 100);
                    }else {
                        notifyMsg('Something went wrong!', 'error');
                    }
                }
            });
        });

        // invest log view
        $(document).on('click', '.investLogBtn', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('user.ajax.invest.log')); ?>",
                success: function (res) {
                    // console.log(res);
                    $('#appCapsule').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    customPush("<?php echo e(route('user.invest.log')); ?>"); // url-change
                },
                error: function (err) {
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    let error = err.responseJSON;
                    console.log(error);
                    if (error.message === "Unauthenticated.") {
                        notifyMsg("You need to Login At first!", 'error');
                        setTimeout(() => {
                            GoTo("<?php echo e(route('user.login')); ?>")
                        }, 100);
                    }else {
                        notifyMsg('Something went wrong!', 'error');
                    }
                }
            });
        });

        // interest log view
        $(document).on('click', '.interestLogBtn', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('user.ajax.interest.log')); ?>",
                success: function (res) {
                    // console.log(res);
                    $('#appCapsule').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    customPush("<?php echo e(route('user.interest.log')); ?>"); // url-change
                },
                error: function (err) {
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    let error = err.responseJSON;
                    console.log(error);
                    if (error.message === "Unauthenticated.") {
                        notifyMsg("You need to Login At first!", 'error');
                        setTimeout(() => {
                            GoTo("<?php echo e(route('user.login')); ?>")
                        }, 100);
                    }else {
                        notifyMsg('Something went wrong!', 'error');
                    }
                }
            });
        });

        // transaction log view
        $(document).on('click', '.transactionLogBtn', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('user.ajax.transaction.log')); ?>",
                success: function (res) {
                    // console.log(res);
                    $('#appCapsule').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    customPush("<?php echo e(route('user.transaction.log')); ?>"); // url-change
                },
                error: function (err) {
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    let error = err.responseJSON;
                    console.log(error);
                    if (error.message === "Unauthenticated.") {
                        notifyMsg("You need to Login At first!", 'error');
                        setTimeout(() => {
                            GoTo("<?php echo e(route('user.login')); ?>")
                        }, 100);
                    }else {
                        notifyMsg('Something went wrong!', 'error');
                    }
                }
            });
        });

        // commision log view
        $(document).on('click', '.commisionLogBtn', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('user.ajax.commision')); ?>",
                success: function (res) {
                    // console.log(res);
                    $('#appCapsule').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    customPush("<?php echo e(route('user.commision')); ?>"); // url-change
                },
                error: function (err) {
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    let error = err.responseJSON;
                    console.log(error);
                    if (error.message === "Unauthenticated.") {
                        notifyMsg("You need to Login At first!", 'error');
                        setTimeout(() => {
                            GoTo("<?php echo e(route('user.login')); ?>")
                        }, 100);
                    }else {
                        notifyMsg('Something went wrong!', 'error');
                    }
                }
            });
        });
    </script>

<?php $__env->stopPush(); ?>
<?php /**PATH /home/u207221236/domains/codeshack.net/public_html/tradedemo/core/resources/views/theme3/includes/user/bottom_nav.blade.php ENDPATH**/ ?>