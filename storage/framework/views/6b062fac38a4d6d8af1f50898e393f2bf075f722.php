<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?php echo e(__($pageTitle)); ?></h1>
            </div>

            <div class="row">

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">

                        <div class="card-body p-2">

                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Sl')); ?></th>
                                        <th><?php echo e(__('User')); ?></th>
                                        <th><?php echo e(__('Amount')); ?></th>
                                        <th><?php echo e(__('Trade Start Time')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $trades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $trade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('admin.user.details', $trade->user)); ?>">
                                                    <i class="fa-solid fa-user"></i> <?php echo e($trade->user->username); ?>

                                                </a>
                                            </td>
                                            <td><?php echo e(number_format($trade->amount, 2) . ' ' . @$general->site_currency); ?></td>
                                            <td><?php echo e($trade->created_at); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td class="text-center" colspan="100%"><?php echo e(__('No Data Found')); ?>

                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </div>

                        <?php if($trades->hasPages()): ?>
                            <div class="card-footer">
                                <?php echo e($trades->links('backend.partial.paginate')); ?>

                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        </section>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('style-plugin'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('asset/admin/css/datatables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('asset/admin/css/bs4-datatable.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-plugin'); ?>
    <script src="<?php echo e(asset('asset/admin/js/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/admin/js/bs4-datatable.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .pagination .page-item.active .page-link {
            background-color: rgb(95, 116, 235);
            border: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button:focus {
            background: transparent;
            border-color: transparent;
        }

        .pagination .page-item.active .page-link:hover {
            background-color: rgb(95, 116, 235);
        }

        th,
        td {
            text-align: center !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crevitoc/Crevito/script.crevito.com/binancetrade/core/resources/views/backend/runing_trade.blade.php ENDPATH**/ ?>