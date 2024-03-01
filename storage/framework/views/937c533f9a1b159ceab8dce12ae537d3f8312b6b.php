<div class="d-none" id="currentPath">Transaction_Log</div>

<!-- Logs Navigation -->
<?php echo $__env->make('theme3.includes.user.logs_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Transaction History -->
<div class="section my-3">
    <div class="transactions">
        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- item -->
        <a href="#" class="item pt-1 pb-1 px-3">
            <div class="detail">
                <img src="https://cdn-icons-png.flaticon.com/128/2921/2921222.png" class="image-block imaged w48" alt="">

                <div>
                    <strong>
                        <?php echo e(__(@$data->details)); ?>

                    </strong>
                    <p class="small text-secondary">
                        Trx: <b class="text-info"><?php echo e($data->trx); ?></b>
                        <br>
                        <?php echo e(showDateTime($data->created_at, 'd-m-Y')); ?> | <?php echo e(diffForHumans($data->created_at)); ?>

                    </p>
                </div>
            </div>
            <div align="right" class="col-auto">
                <h5 class="<?php echo e($data->type == '-' ? 'text-danger' : 'text-success'); ?> mb-1">
                    <?php echo e($data->type); ?> <?php echo e(showAmount($data->amount)); ?><?php echo e(__($general->currency_sym)); ?>

                </h5>
                
            </div>
        </a>
        <!-- * item -->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<!-- * Transaction History -->
<?php /**PATH /var/www/pacificode_c_usr8/data/www/trading.pacificode.co/resources/views/theme3/user/ajax/transaction.blade.php ENDPATH**/ ?>