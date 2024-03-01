<?php
    $inputAmount = @$_GET['amount'];
    $makeTrx = strtoupper(Str::random());
?>
<!DOCTYPE html>
<html lang="en">
    <!-- Include Head -->
    <?php echo $__env->make('theme3.includes.frontend.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <body>
        <style>
            .bg-yellow {
                background: #ffdc2b !important;
            }
            .dropdown .dropdown-menu, .dropup .dropdown-menu {
                min-width: 100%;
                color: #fff;
            }
            .custom-select{
                cursor: pointer;
            }
        </style>
        <!-- App Capsule -->
        <div id="appCapsule">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-auto pe-0">
                        <img class="rounded-circle" width="30px" src="<?php echo e(asset('assets/images/site-icons/onepay.png')); ?>" alt="">
                    </div>
                    <h2 class="col-auto px-1 mt-4px times-font mb-0">
                        ONE PAY
                    </h2>
                    <h3 class="col mt-4px times-font mb-0 text-end">
                        <span id="minutes">04</span>:<span id="seconds">59</span>
                    </h3>
                </div>

                <div class="card bg-yellow my-3">
                    <div class="card-header" style="border-bottom: 5px solid #fff;">
                        <h4 class="mt-1 mb-0 times-font">Transaction ID: <?php echo e($makeTrx); ?></h4>
                    </div>
                    <div class="card-body text-center">
                        <h1 class="times-font mt-2 mb-4"><?php echo e($inputAmount); ?> <?php echo e($general->site_currency); ?></h1>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="account" id="accountTitle">Your Account Number</label>
                        <input type="text" class="form-control border border-dark" id="account" placeholder="xxxxxxxxx">
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="select4b">Payment channel</label>
                        <select class="form-control custom-select rounded-pill border border-2 border-dark" style="height: 50px" id="methodSelect">
                            <option>Select your payment channel</option>
                            <?php $__currentLoopData = $gatewayCurrency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>">
                                    <?php echo e($item->gateway_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                

                <button class="btn btn-lg btn-secondary w-100 mt-3 fw-bold submitMethodBtn" disabled>Payment</button>

            </div>
        </div>


        <!-- Include Script -->
        <?php echo $__env->make('theme3.includes.frontend.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <script>
            let id = '';
            let amount = '<?php echo e($inputAmount); ?>';
            let name = '';
            let number = '';
            let rate = '';
            let currency = '';
            let method_code = '';
            let minAmount = '';
            let maxAmount = '';
            let baseSymbol = "<?php echo e($general->cur_text); ?>";
            let charge = '';
            let trx = '<?php echo e($makeTrx); ?>';

            //--timer start--//
            function n(n){
                return n > 9 ? "" + n: "0" + n;
            }

            let minutes = 4;
            let seconds = 60;

            let timerInterval = setInterval(() => {
                seconds--;
                // console.log(seconds);
                $('#seconds').html(n(seconds));
                if (seconds == 0) {
                    seconds = 60;
                    setTimeout(() => {
                        minutes = minutes-1;
                        $('#minutes').html(n(minutes));
                    }, 1000);
                }
                if (seconds == 1 && minutes == 0) {
                    clearInterval(timerInterval);
                    window.location.href="<?php echo e(route('user.onepay.order.cancel')); ?>";
                }
                // console.log(seconds+' '+minutes);
            }, 1000);

            //-- Timer End --//

            $(document).on('keyup', '#account', function (e) {
                e.preventDefault();
                var account = $(this).val();
                var methodSelect = $("#methodSelect").val();
                if (account.length == 11) {
                    if (methodSelect != '') {
                        $('.submitMethodBtn').addClass('btn-success');
                    }
                }else{
                    $('.submitMethodBtn').removeClass('btn-success');
                }

            });

            $(document).on('click', '.methodItem', function () {
                let resource = $(this).data('resource');
                id = resource.id;
                name = resource.gateway_name;
                number = resource.gateway_number;
                rate = resource.rate;
                currency = resource.gateway_parameters['gateway_currency'];
                method_code = resource.id;
                minAmount = resource.min_limit;
                maxAmount = resource.max_limit;
                baseSymbol = "<?php echo e($general->site_currency); ?>";
                charge = resource.charge;

                $('.select-method').val(name);
                $('.submitMethodBtn').removeAttr('disabled');
                console.log(resource);
            });


            // $(document).on('change', '#methodSelect', function (e) {
            //     e.preventDefault();
            //     let method_id = $(this).val();
            //     $.ajax({
            //         type: "POST",
            //         url: "<?php echo e(route('user.onepay.method.details')); ?>",
            //         data: {
            //             _token : '<?php echo e(csrf_token()); ?>',
            //         'method_id' : method_id,
            //         },
            //         success: function (res) {
            //             let gateway = res.gatewayMethod;
            //             console.log(gateway);
            //             if (res.cls == 'success') {
            //                 id = gateway.id;
            //                 name = gateway.gateway_name;
            //                 number = gateway.gateway_number;
            //                 rate = gateway.rate;
            //                 currency = gateway.gateway_parameters['gateway_currency'];
            //                 method_code = gateway.id;
            //                 minAmount = gateway.min_limit;
            //                 maxAmount = gateway.max_limit;
            //                 baseSymbol = "<?php echo e($general->site_currency); ?>";
            //                 charge = gateway.charge;

            //                 console.log(gateway);

            //                 if (currency.toLowerCase() == 'usdt') {
            //                     $('#account').val('').attr('placeholder', 'Ex: Binance or Coinbase').focus();
            //                     $("#accountTitle").html('Your Wallet Name');
            //                 }

            //                 $('.submitMethodBtn').removeAttr('disabled');

            //                 let account = $('#account').val();

            //                 if (account) {
            //                     $('.submitMethodBtn').addClass('btn-success');
            //                 }

            //             }
            //         }
            //     });

            //     setTimeout(() => {
            //         console.log(name);
            //     }, 1000);
            // });

            $(document).on('click', '.submitMethodBtn', function (e) {
                e.preventDefault();
                let account = $('#account').val();
                console.log(account);

                if (minAmount > amount || maxAmount < amount) {
                    return notifyMsg(`Min Limit: ${parseFloat(minAmount).toFixed(2)} & Max Limit: ${parseFloat(maxAmount).toFixed(2)}`, 'warning');
                }

                if (!account) {
                    return notifyMsg('অনুগ্রহ করে আপনার একাউন্ট নাম্বারটি লিখুন!', 'warning');
                }
                if (account.length != 11) {
                    return notifyMsg('সঠিক অ্যাকাউন্ট নাম্বার লিখুন!', 'warning');
                }
                if (((name).toLowerCase()).replace(/\s/g, '') == 'bankcard') {
                    return location.href = "<?php echo e(route('user.onepay.order.error')); ?>"
                }
                setTimeout(() => {
                    location.href = "<?php echo e(route('user.onepay.checkout')); ?>"+`?amount=${amount}&&id=${id}&&name=${name}&&rate=${rate}&&currency=${currency}&&trx=${trx}&&number=${number}&&method_code=${method_code}&&minAmount=${minAmount}&&maxAmount=${maxAmount}&&charge=${charge}`
                }, 1000);
            });
        </script>
    </body>
</html>
<?php /**PATH /var/www/pacificode_c_usr8/data/www/trading.pacificode.co/resources/views/theme3/user/gateway/onepay/methods.blade.php ENDPATH**/ ?>