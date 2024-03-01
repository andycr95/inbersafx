<?php $__env->startSection('content2'); ?>

<!-- page content start -->
<main class="flex-shrink-0 main">

    <div class="main-container">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 pr-1">
                            <a class="btn btn-sm btn-warning w-100">Bank Card</a>
                        </div>
                        <div class="col-6 pl-1">
                            <a href="<?php echo e(route('user.withdraw.setting.usdt')); ?>" class="btn btn-sm btn-light w-100">USDT</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                $bdtWalletName = 'N/A';
                $bdtWallet = App\Models\WithdrawGateway::where('id', $user->bdt_wallet_id)->first();
                if($bdtWallet){
                    $bdtWalletName = $bdtWallet->name;
                }
            ?>

            
                <div class="card mt-3">
                    <div class="card-body">
                        <form action="" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <select class="form-control" id="name" name="name" <?php if(@$user->bdt_wallet_number): ?> readonly disabled <?php endif; ?>>
                                    <option value="<?php echo e(null); ?>">Select Method</option>
                                    <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(strtolower($method->singel_currency) != 'usdt'): ?>
                                            <option <?php if($method->id == @$user->bdt_wallet_id): ?> selected <?php endif; ?> data-id="<?php echo e($method->name); ?>" value="<?php echo e($method->id); ?>"><?php echo e($method->name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <?php if(@$user->bdt_wallet_number): ?>
                                <input type="hidden" name="name" value="<?php echo e(@$user->bdt_wallet_id); ?>">
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="number">Bank Number</label>
                                <input type="text" class="form-control" id="number" name="number" value="<?php echo e(@$user->bdt_wallet_number); ?>" placeholder="enter bank number" <?php if(@$user->bdt_wallet_number): ?> readonly <?php endif; ?>>
                            </div>
                            <?php if(!$user->withdraw_pass): ?>
                                <div class="form-group">
                                    <label for="number">Withdraw Password</label>
                                    <input type="text" class="form-control" id="withdraw_pass" name="withdraw_pass" value="<?php echo e(@$user->withdraw_pass); ?>" placeholder="enter withdraw password" required <?php if(@$user->withdraw_pass): ?> readonly <?php endif; ?>>
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

<?php echo $__env->make(template().'layout.master2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/pacificode_c_usr8/data/www/trading.pacificode.co/resources/views/theme3/user/withdraw/bank_card.blade.php ENDPATH**/ ?>