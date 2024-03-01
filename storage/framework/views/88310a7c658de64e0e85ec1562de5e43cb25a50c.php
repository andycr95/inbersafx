<div class="d-none" id="currentPath">Withdraw_Log</div>

<!-- Logs Navigation -->
<?php echo $__env->make('theme3.includes.user.logs_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Withdraw History -->
<div class="section my-3">
    <div class="transactions">
        <?php $__currentLoopData = $withdrawlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- item -->
        <a href="javascript:void(0)" class="item pt-1 pb-1 px-3 details" data-user_data="<?php echo e(json_encode($data->user_withdraw_prof)); ?>" data-withdraw="<?php echo e($data); ?>">
            <div class="detail">
                <img src="https://cdn-icons-png.flaticon.com/128/2921/2921222.png" class="image-block imaged w48" alt="">

                <div>
                    <strong>Withdraw via <?php echo e(__(@$data->withdrawMethod->name)); ?></strong>
                    <p class="small text-secondary">
                        Trx: <b class="text-info"><?php echo e($data->transaction_id); ?></b>
                        <br>
                        <?php echo e(showDateTime($data->created_at, 'd-m-Y')); ?> | <?php echo e(diffForHumans($data->created_at)); ?>

                    </p>
                </div>
            </div>
            <div align="right" class="col-auto">
                <h5 class="text-success mb-1">
                    <?php echo e(__($general->currency_sym)); ?> <?php echo e(showAmount($data->withdraw_amount)); ?>

                </h5>
                <?php if($data->status == 1): ?>
                    <span class="badge badge-success"><?php echo e(__('Success')); ?></span>
                <?php elseif($data->status == 2): ?>
                    <span class="badge badge-danger"><?php echo e(__('Rejected')); ?></span>
                <?php else: ?>
                    <span class="badge badge-warning"><?php echo e(__('Pending')); ?></span>
                <?php endif; ?>
            </div>
        </a>
        <!-- * item -->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<!-- * Withdraw History -->

<script>
    $(document).on('click', '.details', function() {

        let html = `

            <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                       <?php echo e(__('Withdraw Email')); ?>

                        <span>${$(this).data('user_data').email}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo e(__('Withdraw Account Information')); ?>

                        <span>${$(this).data('user_data').account_information}</span>
                    </li>


                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo e(__('Note For Withdraw')); ?>

                        <span>${$(this).data('user_data').note}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo e(__('Withdraw Transaction')); ?>

                        <span>${$(this).data('withdraw').transaction_id}</span>
                    </li>
                </ul>
        `;

        $('#details').find('.withdraw-details').html(html);

        $('#details').modal('show');
    })
</script>

<!-- Modal -->
<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(__('Withdraw Details')); ?></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="withdraw-details">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger"
                    data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
            </div>
        </div>
    </div>
</div>

<?php /**PATH /var/www/pacificode_c_usr8/data/www/trading.pacificode.co/resources/views/theme3/user/withdraw/ajax/withdraw_log.blade.php ENDPATH**/ ?>