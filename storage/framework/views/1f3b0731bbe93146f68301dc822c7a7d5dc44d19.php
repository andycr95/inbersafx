<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('asset/admin/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css')); ?>" />
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?php echo e(__($pageTitle)); ?></h1>
            </div>
            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <form action="" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="trading_bonus"><?php echo e(__('Trading Bonus')); ?></label>
                                        <div class="input-group">
                                            <input type="text" name="trading_bonus" placeholder="<?php echo app('translator')->get('Trading Bonus'); ?>"
                                                class="form-control form_control" value="<?php echo e(@$general->trading_bonus); ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text gr-bg-1 text-white">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="trading_min_amount"><?php echo e(__('Minimum Trading Amount')); ?></label>
                                        <div class="input-group">
                                            <input type="text" name="trading_min_amount" placeholder="<?php echo app('translator')->get('Minimum Trading Amount'); ?>" class="form-control form_control" value="<?php echo e(@$general->trading_min_amount); ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text gr-bg-1 text-white"><?php echo e(@$general->site_currency); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="profit_type"><?php echo e(__('Profit Type')); ?></label>
                                        <select class="form-select form-control form_control text-white <?php echo e(@$general->profit_type == 'minus' ? 'bg-danger' : 'bg-success'); ?>" id="profit_type" name="profit_type">
                                            <option <?php if(@$general->profit_type == 'plus'): ?> selected <?php endif; ?> value="plus">+ Plus</option>
                                            <option <?php if(@$general->profit_type == 'minus'): ?> selected <?php endif; ?> value="minus">- Minus</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="invest_end_time"><?php echo e(__('Trade Open End Time')); ?></label>
                                        <div class="input-group">
                                            <input type="time" name="invest_end_time" placeholder="<?php echo app('translator')->get('Trade Open End Time'); ?>" class="form-control form_control" value="<?php echo e(@$general->invest_end_time); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="coin_name"><?php echo e(__('Coin Name')); ?></label>
                                        <div class="input-group">
                                            <input type="text" name="coin_name" placeholder="<?php echo app('translator')->get('Coin Name'); ?>" class="form-control form_control" value="<?php echo e(@$general->coin_name); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3 mb-3">
                                        <label class="col-form-label"><?php echo e(__('Coin Image')); ?></label>
                                        <div id="image-preview-login" class="image-preview" style="background-image:url(<?php echo e(getFile('coin_image', @$general->coin_image)); ?>);">
                                            <label for="image-upload-login" id="image-label-login"><?php echo e(__('Choose File')); ?></label>
                                            <input type="file" name="coin_image" id="image-upload-login" />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 mt-4">
                                        <button type="submit" class="btn btn-primary w-100"><?php echo e(__('Update Trading Setting')); ?></button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>




<?php $__env->startPush('style'); ?>
    <style>
        .sp-replacer {
            padding: 0;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 5px 0 0 5px;
            border-right: none;
        }

        select.form-control:not([size]):not([multiple]) {
            height: calc(2.25rem + 9px);
        }

        .sp-preview {
            width: 100px;
            height: 46px;
            border: 0;
        }

        .sp-preview-inner {
            width: 110px;
        }

        .sp-dd {
            display: none;
        }

        .select2-container .select2-selection--single {
            height: 44px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 43px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 43px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('asset/admin/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')); ?>"></script>
    <script>
        $(function() {

            'use strict'

            $('#cp1').colorpicker();
            $('#cp2').colorpicker();

            $.uploadPreview({
                input_field: "#image-upload",
                preview_box: "#image-preview",
                label_field: "#image-label",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-icon",
                preview_box: "#image-preview-icon",
                label_field: "#image-label-icon",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-login",
                preview_box: "#image-preview-login",
                label_field: "#image-label-login",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-login_image",
                preview_box: "#image-preview-login_image",
                label_field: "#image-label-login_image",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-breadcrumbs",
                preview_box: "#image-preview-breadcrumbs",
                label_field: "#image-label-breadcrumbs",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-main",
                preview_box: "#image-preview-main",
                label_field: "#image-label-main",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-whitelogo",
                preview_box: "#image-preview-whitelogo",
                label_field: "#image-label-whitelogo",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suntech1/demo.codemaker.pro/h1/core/resources/views/backend/setting/trading_setting.blade.php ENDPATH**/ ?>