
<div class="d-none" id="currentPath">Referral_Log</div>

<!-- Logs Navigation -->
<?php echo $__env->make('theme3.includes.user.logs_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Referral History -->
<div class="section my-3">
    <div class="transactions">
        <?php $__currentLoopData = $commison; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- item -->
        <a href="#" class="item pt-1 pb-1 px-3">
            <div class="detail">
                <img src="<?php echo e(asset('asset/images/2d-icon/3/history.png')); ?>" class="image-block imaged w48" alt="">

                <div>
                    <strong><?php echo e($data->purpouse); ?> from <b class="text-success"><?php echo e(@$data->commissionFrom->username); ?></b></strong>
                    <p class="small text-secondary">
                        <?php echo e(showDateTime($data->created_at, 'd-m-Y')); ?> | <?php echo e(diffForHumans($data->created_at)); ?>

                    </p>
                </div>
            </div>
            <div align="right" class="col-auto">
                <h5 class="text-success mb-0">
                    <?php echo e(__($general->currency_sym)); ?> <?php echo e(showAmount($data->amount)); ?>

                </h5>
            </div>
        </a>
        <!-- * item -->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<!-- * Referral History -->
<?php /**PATH /var/www/pacificode_c_usr8/data/www/trading.pacificode.co/resources/views/theme3/user/ajax/commision_log.blade.php ENDPATH**/ ?>