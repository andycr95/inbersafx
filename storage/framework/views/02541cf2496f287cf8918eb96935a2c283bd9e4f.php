<?php $__env->startSection('content2'); ?>
    <!-- page banner start -->
    
    <!-- page banner end -->

    <?php if($page->sections != null): ?>
        <?php $__currentLoopData = $page->sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sections): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make(template().'sections.' . $sections, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(template() . 'layout.master2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/pacificode_c_usr8/data/www/trading.pacificode.co/resources/views/theme3/pages.blade.php ENDPATH**/ ?>