


<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?php echo e(__($pageTitle)); ?></h1>
            </div>

            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-header">
                            <div class="d-inline-flex">


                            </div>


                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table" id="example">
                                    <thead>
                                        <tr>

                                            <th><?php echo e(__('Sl')); ?></th>
                                            <th><?php echo e(__('Full Name')); ?></th>
                                            <th><?php echo e(__('Phone')); ?></th>
                                            <th><?php echo e(__('Email')); ?></th>
                                            <th><?php echo e(__('Country')); ?></th>
                                            <th><?php echo e(__('Status')); ?></th>
                                            <th><?php echo e(__('Action')); ?></th>

                                        </tr>

                                    </thead>

                                    <tbody id="filter_data">

                                        <?php $__empty_1 = true; $__currentLoopData = $userdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($user->fname.' '.$user->lname); ?></td>
                                                <td><?php echo e($user->phone ?? 'N/A'); ?></td>
                                                <td><?php echo e($user->email ?? 'N/A'); ?></td>
                                                <td><?php echo e(@$user->country ?? 'N/A'); ?></td>
                                                <td>

                                                    <?php if($user->status==1): ?>
                                                        <span class='badge badge-success'><?php echo e(__('Active')); ?></span>
                                                    <?php elseif($user->status==0): ?>
                                                        <span class='badge badge-danger'><?php echo e(__('Pending')); ?></span>
                                                    <?php else: ?>
                                                    <span class='badge badge-danger'><?php echo e(__('Rejected')); ?></span>
                                                    <?php endif; ?>

                                                </td>

                                                <td>

                                                    <a href="<?php echo e(route('admin.user.kycdetails',$user->id)); ?>"
                                                        class="btn btn-md btn-primary"><i class="fa fa-eye"></i></a>
                                                </td>


                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td class="text-center" colspan="100%"><?php echo e(__('No Data Found')); ?></td>
                                            </tr>
                                        <?php endif; ?>



                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <?php if($userdata->hasPages()): ?>
                            <div class="card-footer">
                                <?php echo e($userdata->links('backend.partial.paginate')); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u207221236/domains/codeshack.net/public_html/tradedemo/core/resources/views/backend/admins/kyc/requestkyc.blade.php ENDPATH**/ ?>