<?php $__env->startSection('content2'); ?>

<!-- page content start -->
<main class="flex-shrink-0 main">

    <div class="main-container">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 pr-1">
                            <a href="<?php echo e(route('user.withdraw.setting.bank.card')); ?>" class="btn btn-sm btn-light w-100">Bank Card</a>
                        </div>
                        <div class="col-6 pl-1">
                            <a class="btn btn-sm btn-warning w-100">USDT</a>
                        </div>
                    </div>
                </div>
            </div>
            
                <div class="card mt-3">
                    <div class="card-body">
                        <form action="" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="name">Network</label>
                                <select class="form-control" id="network" <?php if(@$user->usdt_wallet_address): ?> readonly disabled <?php endif; ?>>
                                    <option value="<?php echo e(null); ?>">Select Network</option>
                                    <option <?php if(@$user->usdt_wallet_address): ?> selected <?php endif; ?> value="<?php echo e(null); ?>">TRC 20</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo e(@$user->usdt_wallet_address); ?>" placeholder="enter usdt address" <?php if(@$user->usdt_wallet_address): ?> readonly <?php endif; ?>>
                            </div>
                            <?php if(!$user->withdraw_pass): ?>
                                <div class="form-group">
                                    <label for="number">Withdraw Password</label>
                                    <input type="text" class="form-control" id="withdraw_pass" name="withdraw_pass" placeholder="enter withdraw password" <?php if(@$user->withdraw_pass): ?> readonly <?php endif; ?>>
                                </div>
                            <?php endif; ?>
                            <button class="btn btn-primary w-100 mt-2" type="submit">Confirm</button>
                        </form>
                    </div>
                </div>
            

        </div>
    </div>
</main>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make(template().'layout.master2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/pacificode_c_usr8/data/www/trading.pacificode.co/resources/views/theme3/user/withdraw/usdt.blade.php ENDPATH**/ ?>