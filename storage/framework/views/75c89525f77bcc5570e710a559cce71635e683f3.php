<!-- Withdraw Action Sheet -->
<div class="modal fade action-sheet" id="miningModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Start AI Trading</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div id="miningModalBody">
                        <div class="card glass-bg my-2">
                            <div class="card-body p-2">
                                <div class="row align-items-center">
                                    <div class="col text-start">
                                        <h6 class="mb-0 text-light small-font-lg text-start">Current Balance:</h6>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="mb-0 text-light small-font-lg"><?php echo e(@$general->currency_sym); ?><?php echo e(showAmount(@$user->balance)); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <style>
                            .miningBtn {
                                cursor: pointer;
                            }
                            .miningBtn:hover, .miningBtn:focus {
                                scale: .95;
                                transition: all ease-in .1s;
                            }
                        </style>
                        <div class="text-center my-3">
                            <div class="row justify-content-center">
                                <div class="miningBtn col-auto">
                                    <img width="150px" src="https://upload.wikimedia.org/wikipedia/commons/5/5a/Perspective-Button-Stop-icon.png" alt="">
                                    <h1 class="text-light" style="margin-top: -110px; margin-bottom: 70px;">START</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * Withdraw Action Sheet -->

<?php $__env->startPush('script'); ?>
<script>
    $(document).on('click', '.miningBtn', function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?php echo e(route('user.mining.on')); ?>",
            success: function (res) {
                notifyMsg(res.msg, res.cls);
                $('#miningModal').modal('hide');
                $('.modal-backdrop').removeClass('modal-backdrop');
                if (res.cls == 'success') {
                    setTimeout(() => {
                        location.reload();
                    }, 2200);
                }
            }
        });

    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/u207221236/domains/codeshack.net/public_html/tradedemo/core/resources/views/theme3/user/action_modal/mining_action.blade.php ENDPATH**/ ?>