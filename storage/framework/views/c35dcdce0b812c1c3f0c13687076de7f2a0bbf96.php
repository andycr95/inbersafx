<?php $__env->startSection('content2'); ?>
<style>
    .input-group .input-group-text {
        height: 40px;
    }
</style>
    <div class="container">
        <div class="row my-2">
            <!--<div class="col-6">-->
            <!--    <div class="card bg-pink-light">-->
            <!--        <div class="card-body">-->
            <!--            <div class="row align-items-center">-->
            <!--                <div class="col-auto">-->
            <!--                    <img style="width: 45px; padding: 6px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAABb0lEQVR4nO3Zv0qVcRjA8V9WRKYtQrU02OgV2NKiBd2AU4sEtdkNuDoEKs2OunUBLaLgP2hrc5AIbQodpEKUA/qJA2/LGfRn+B6f9/T7XMHzPc/zngPnTakoegse4zUWsY1DfMM0+lJU6MdLfKgGP89UigRP8A7LOJZv47oHf4hXWMIP/+5ntwe/gzG8xxecuRqn3TqXN/jY/uTUJNU0/CPM4Htdg9cagmEs4KRbAX9dZcSz6oRGcDc1EW7hduoF6Kt+ebfqfKgz/MY6JnHzshH3sSqeNQzlRtzAJ3Fttk8/J2RCfG9zQlbE9zkn5Jf4jnJCGiGVkGBS2UgwqWwkmFQ20j271f8A9zCOvaZuZKxjnudNDRnomGewqSHjvbKR3Wr4Abxo8jOSpYREk8ppBZPKRoJJ/9NGWuJr5YR8Fd9OTsi8+GZz304diGsfDy4MqWKeBo3Zx2hWRMer5rn2PV7zF0CrmmE2exNFUaROfwDvDa5Ik7OxJAAAAABJRU5ErkJggg==" alt="">-->
            <!--                </div>-->
            <!--                <div class="col">-->
            <!--                    <h4 class="mb-0">Mobile Banking</h4>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="m-auto">
                <a href="<?php echo e(route('user.usdt.index')); ?>" class="card usdt-href-btn customLink">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img style="width: 45px" src="https://img.icons8.com/color/96/tether--v2.png" alt="">
                            </div>
                            <div class="col text-white">
                                <h4 class="mb-0">USDT</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <h3 class="mt-3 mb-0 text-center"><?php echo e(showAmount(auth()->user()->balance)); ?> <?php echo e($general->site_currency); ?></h3>
        <h6 class="mb-3 text-center text-secondary">Current Balance</h6>

        <h4 class="row mt-2 mb-3 align-items-center">
            <div class="col-auto px-1">
                Pay with
            </div>
            <div class="col-auto px-1">
                <img class="rounded-circle" width="20px" src="<?php echo e(asset('asset/images/site-icons/onepay.png')); ?>" alt="">
            </div>
            <div class="col-auto px-1">
                One Pay
            </div>
        </h4>

        <div class="input-group mb-3">
            <span class="input-group-text px-3 border bg-pink-light-alt"
                style="border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
                <ion-icon name="wallet-outline"></ion-icon>
            </span>
            <input type="text" class="form-control" name="amount" id="amountInput">
            <span class="input-group-text px-3 border bg-pink-light-alt"
                style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
                <?php echo e($general->site_currency); ?>

            </span>
        </div>

        <div class="row">
            <div class="col-4"><button class="amountBtn  btn border-0 bg-light w-100 mb-1" data-amount="50"><?php echo e($general->currency_sym); ?> 50</button></div>
            <div class="col-4"><button class="amountBtn  btn border-0 bg-light w-100 mb-1" data-amount="100"><?php echo e($general->currency_sym); ?> 100</button></div>
            <div class="col-4"><button class="amountBtn  btn border-0 bg-light w-100 mb-1" data-amount="200"><?php echo e($general->currency_sym); ?> 200</button></div>
            <div class="col-4"><button class="amountBtn  btn border-0 bg-light w-100 mb-1" data-amount="500"><?php echo e($general->currency_sym); ?> 500</button></div>
            <div class="col-4"><button class="amountBtn  btn border-0 bg-light w-100 mb-1" data-amount="1000"><?php echo e($general->currency_sym); ?> 1000</button></div>
            <div class="col-4"><button class="amountBtn  btn border-0 bg-light w-100 mb-1" data-amount="2500"><?php echo e($general->currency_sym); ?> 2500</button></div>
            <div class="col-4"><button class="amountBtn  btn border-0 bg-light w-100 mb-1" data-amount="5000"><?php echo e($general->currency_sym); ?> 5000</button></div>
            <div class="col-4"><button class="amountBtn  btn border-0 bg-light w-100 mb-1" data-amount="10000"><?php echo e($general->currency_sym); ?> 10000</button></div>
            <div class="col-4"><button class="amountBtn  btn border-0 bg-light w-100 mb-1" data-amount="15000"><?php echo e($general->currency_sym); ?> 15000</button></div>
        </div>

        <button class="btn btn-primary w-100 rounded-pill my-2 depositSubmitBtn">Deposit</button>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>

    $(document).on('click', '.amountBtn', function (e) {
        e.preventDefault();
        let amount = $(this).data('amount'); // get val form btn
        $('.amountBtn').removeClass('bg-pink-light');
        $(this).addClass('bg-pink-light');

        $('#amountInput').val(amount); // set val to input form
    });

    $(document).on('click', '.depositSubmitBtn', function (e) {
        e.preventDefault();
        let amount = $('#amountInput').val();
        if(!amount){
            return notifyMsg('please select an option first!', 'warning');
        }
        notifyMsg(`recharge: ${amount} success,Please wait patiently`, 'success')
        setTimeout(() => {
            location.href = "<?php echo e(route('user.onepay.methods')); ?>"+'?amount='+amount
        }, 1000);

    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(template().'layout.master2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/pacificode_c_usr8/data/www/trading.pacificode.co/resources/views/theme3/user/gateway/onepay/deposit.blade.php ENDPATH**/ ?>