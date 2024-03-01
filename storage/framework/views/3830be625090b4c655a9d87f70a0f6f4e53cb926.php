<?php $__env->startSection('content'); ?>

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?php echo e(__($pageTitle)); ?></h1>
            </div>


            <div class="row">

                <div class="col-md-12  col-lg-12 col-12 all-users-table">
                    <div class="card-header">
                        <h5><?php echo e(__('Trading Referral Commission')); ?></h5>
                    </div>
                    <div class="card">

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="">
                                            <th scope="col"><?php echo e(__('Level')); ?></th>
                                            <th scope="col"><?php echo e(__('Commission')); ?></th>
                                            <th scope="col"><?php echo e(__('Change Status')); ?></th>
                                            <th scope="col"><?php echo e(__('Generate')); ?></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php if($invest_referral): ?>
                                                <td>

                                                    <?php $__empty_1 = true; $__currentLoopData = $invest_referral->level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <li class="list-group-item list-group-item-primary">
                                                            <?php echo e($level); ?>

                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <?php endif; ?>

                                                </td>
                                                <td>

                                                    <?php $__empty_1 = true; $__currentLoopData = $invest_referral->commision; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commision): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <li class="list-group-item list-group-item-primary">
                                                            <?php echo e($commision); ?> %
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <?php endif; ?>

                                                </td>

                                                <td class="text-capitalize">

                                                    <div class="custom-switch custom-switch-label-onoff">
                                                        <input class="custom-switch-input" id="investstatus"
                                                            data-status="<?php echo e($invest_referral->status); ?>"
                                                            data-url="<?php echo e(route('admin.refferalstatus', $invest_referral->id)); ?>"
                                                            type="checkbox" name="status"
                                                            <?php echo e($invest_referral->status ? 'checked' : ''); ?>>
                                                        <label class="custom-switch-btn" for="investstatus"></label>
                                                    </div>

                                                </td>
                                            <?php else: ?>
                                        <tr>

                                            <td class="text-center" colspan="100%"><?php echo e(__('No Data Found')); ?></td>

                                        </tr>
                                        <?php endif; ?>
                                        <td>
                                            <div class="append_table">
                                                <div class="input-group mb-3 mt-3 ml-auto ">
                                                    <input type="number" class="form-control invest_commision"
                                                        placeholder="How Many Field You Want" required>

                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button"
                                                            id="invest"><?php echo e(__('Generate')); ?></button>
                                                    </div>
                                                </div>
                                                <form method="POST" action="<?php echo e(route('admin.invest.store')); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="append_invest  ml-auto">

                                                    </div>
                                                    <input type="text" name="type" value="invest" hidden>
                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary btn-block ml-auto create-invest"
                                                            type="submit"><?php echo e(__('Create')); ?></button>
                                                    </div>
                                                </form>
                                            </div>



                                        </td>

                                        </tr>

                                    </tbody>
                                </table>


                            </div>

                        </div>

                    </div>
                    

        </section>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $('.create-invest').hide();
        $('.create-interest').hide();

        $(document).ready(function() {

            $('#invest').on('click', function() {
                var value = $('.invest_commision').val();
                if (value > 3) {
                    iziToast.error({
                        message: 'Max Limit of Refferal level is 3',
                        position: 'topRight'
                    });

                    return;
                }
                var viewHtml = "";

                for (let i = 0; i < value; i++) {
                    viewHtml += `
                        <div class="input-group mb-3 mt-3 ">
                            <div class="input-group-prepend">
                                <input class="btn btn-primary" type="text"  name=level[] value="level ${i+1}" readonly>
                            </div>
                            <input type="number" required class="form-control" name=commision[]
                                placeholder="Commision">

                            <div class="input-group-append">
                                <button class="btn btn-primary text-light no-drop" type="button"
                                    >%</button>
                                <button class="btn btn-danger text-white delete_invest" type="button"
                                    >X</button>
                            </div>
                        </div>

                    `
                    $('.append_invest').html(viewHtml).hide().slideDown('slow');
                    $('.invest_commision').val('');
                    $('.create-invest').show();

                }


            });
            $(document).on('click', '.delete_invest', function() {
                $(this).closest('.input-group').remove();

                var count = $('.append_invest').children().length;

                if (count == 0) {
                    $('.create-invest').hide();
                }

            });





            $('#interest').on('click', function() {
                var value = $('.interest_commision').val();
                var viewHtml = "";

                if (value > 5) {
                    iziToast.error({
                        message: 'Max Limit of Refferal level is 5 ',
                        position: 'topRight'
                    });

                    return;
                }


                for (let i = 0; i < value; i++) {
                    viewHtml += `

            <div class="input-group mb-3 mt-3 ">
                <div class="input-group-prepend">
                                                <input class="btn btn-success" type="text"  name="level[]"  value="level ${i+1}" readonly>
                                            </div>
                                            <input type="number" name=commision[] class="form-control"
                                                placeholder="Commision" min="0" required>

                                            <div class="input-group-append">
                                                <button class="btn btn-success text-light no-drop" type="button"
                                                    >%</button>
                                                <button class="btn btn-danger text-white delete_interest" type="button"
                                                    >X</button>
                                            </div>


                                        </div>

             `
                    $('.append_interest').html(viewHtml).hide().slideDown('slow');
                    $('.interest_commision').val('');
                    $('.create-interest').show();
                }


            });
            $(document).on('click', '.delete_interest', function() {
                $(this).closest('.input-group').remove();
                var count = $('.append_interest').children().length;

                if (count == 0) {
                    $('.create-interest').hide();
                }
            });
        });

        $(function() {

            $('#investstatus').on('change', function() {
                let status = $(this).data('status');
                let url = $(this).data('url');

                $.ajax({

                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },

                    url: url,

                    data: {
                        status: status
                    },

                    method: "POST",

                    success: function(response) {
                        iziToast.success({

                            message: response.success,
                            position: 'topRight'
                        });
                    }
                })
            })
        })

        $(function() {

            $('#intereststatus').on('change', function() {
                let status = $(this).data('status');
                let url = $(this).data('url');

                $.ajax({

                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },

                    url: url,

                    data: {
                        status: status
                    },

                    method: "POST",

                    success: function(response) {
                        iziToast.success({

                            message: response.success,
                            position: 'topRight'
                        });
                    }
                })
            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u207221236/domains/codeshack.net/public_html/tradedemo/core/resources/views/backend/referral/index.blade.php ENDPATH**/ ?>