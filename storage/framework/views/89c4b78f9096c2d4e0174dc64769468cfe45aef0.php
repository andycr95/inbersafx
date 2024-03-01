<div class="d-none" id="currentPath">Deposit_Log</div>

<!-- Logs Navigation -->
<?php echo $__env->make('theme3.includes.user.logs_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Deposit History -->
<div class="section my-3">
    <div class="transactions">
        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- item -->
        <a href="#" class="item pt-1 pb-1 px-3">
            <div class="detail">
                <img src="https://cdn-icons-png.flaticon.com/128/2921/2921222.png" class="image-block imaged w48" alt="">

                <div>
                    <strong>Deposit via <?php echo e(__(@$data->gateway->gateway_name)); ?></strong>
                    <p class="small text-secondary">
                        Trx: <b class="text-info"><?php echo e($data->transaction_id); ?></b>
                        <br>
                        <?php echo e(showDateTime($data->created_at, 'd-m-Y')); ?> | <?php echo e(diffForHumans($data->created_at)); ?>

                    </p>
                </div>
            </div>
            <div align="right" class="col-auto">
                <h5 class="text-danger mb-1">
                    <?php echo e(__($general->currency_sym)); ?> <?php echo e(showAmount($data->amount)); ?>

                </h5>
                <?php if($data->payment_status == 1): ?>
                    <span class="badge badge-success style--light"><?php echo app('translator')->get('Complete'); ?></span>
                <?php elseif($data->payment_status == 2): ?>
                    <span class="badge badge-warning style--light"><?php echo app('translator')->get('Pending'); ?></span>
                <?php elseif($data->payment_status == 3): ?>
                    <span class="badge badge-danger style--light"><?php echo app('translator')->get('Rejected'); ?></span>
                <?php endif; ?>
            </div>
        </a>
        <!-- * item -->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<!-- * Deposit History -->

<?php /**PATH /var/www/pacificode_c_usr8/data/www/trading.pacificode.co/resources/views/theme3/user/ajax/deposit_log.blade.php ENDPATH**/ ?>