<?php $__env->startSection('content2'); ?>
    <div class="container">
        <div class="card mb-2">
            <div class="card-body pb-0 pt-1">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="form-label mb-0">Referral Link</label>
                            <div class="input-group">
                                <input type="text" name="key" value="<?php echo e(route('user.register', [Auth::user()->username])); ?>" class="form-control form-control-sm" id="referralURL" readonly="">
                                <a class="input-group-text btn btn-gr-red px-3 cursor-pointer copytext" id="copyBoard">
                                    <i class="fas fa-copy"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-6" style="padding-right: 3px;">
                        <div class="card bg-gr-red text-center">
                            <div class="card-body">
                                <h6 class="mb-0 small">Total Team</h6>
                                <h6 class="mb-0"><?php echo e(teamSize($user->id, 1)+teamSize($user->id, 2)+teamSize($user->id, 3)); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6" style="padding-left: 3px;">
                        <div class="card bg-gr-red text-center">
                            <div class="card-body">
                                <h6 class="mb-0 small">Total Earn</h6>
                                <h6 class="mb-0"><?php echo e(@$general->currency_sym); ?><?php echo e(showAmount($commison)); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card bg-gr-red text-center mt-1">
                            <div class="card-body">
                                <h6 class="mb-0 small">Work Team</h6>
                                <h6 class="mb-0"><?php echo e(depoTeamSize($user->id, 1)+depoTeamSize($user->id, 2)+depoTeamSize($user->id, 3)); ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                <div class="row justify-content-center">
                    <?php for($i=1; $i<=3; $i++): ?>
                        <div class="col-4 px-1">
                            <a class="btn btn-gr-red btn-sm border-0 w-100 customLink <?php if($i == $lev): ?> disabled <?php endif; ?>"  href="<?php echo e(route('user.team', $i)); ?>">Lev<?php echo e($i); ?>(<?php echo e(teamSize($user->id, $i)); ?>)</a>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <div class="my-3">
            <?php echo e(showUserLevel($user->id, $lev)); ?>

        </div>

    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
    $('.copytext').on('click', function() {
        var copyText = document.getElementById("referralURL");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        notifyMsg("Copied: " + copyText.value,'success');
        notifyMsg("Copy Success!",'success')
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(template().'layout.master2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/pacificode_c_usr8/data/www/trading.pacificode.co/resources/views/theme3/user/team/index.blade.php ENDPATH**/ ?>