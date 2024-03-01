<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?php echo e(__($pageTitle)); ?></h1>
            </div>

            <div class="row">

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="" method="post" enctype="multipart/form-data">

                                <?php echo csrf_field(); ?>

                                <div class="row">
                                    <div class="form-group col-md-6">

                                        <label for=""><?php echo e(__('Email Method')); ?></label>
                                        <select name="email_method" id="" class="form-control selectric">

                                            <option value="php" <?php echo e(@$general->email_method == 'php' ? 'selected' : ''); ?>>
                                                <?php echo e(__('PHPMail')); ?></option>
                                            <option value="smtp"
                                                <?php echo e(@$general->email_method == 'smtp' ? 'selected' : ''); ?>>
                                                <?php echo e(__('SMTP Mail')); ?></option>

                                        </select>

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label for=""><?php echo e(__('Email Sent From')); ?></label>

                                        <input type="email" name="site_email" class="form-control form_control"
                                            value="<?php echo e(@$general->site_email); ?>">

                                    </div>

                                    <div class="form-group col-md-12 smtp-config">


                                        <?php if(@$general->email_method == 'smtp'): ?>
                                            <div class="row">

                                                <div class="col-md-3">

                                                    <label for=""><?php echo e(__('SMTP HOST')); ?></label>
                                                    <input type="text" name="email_config[smtp_host]" class="form-control"
                                                        value="<?php echo e(@$general->email_config->smtp_host); ?>">

                                                </div>

                                                <div class="col-md-3">

                                                    <label for=""><?php echo e(__('SMTP Username')); ?></label>
                                                    <input type="text" name="email_config[smtp_username]"
                                                        class="form-control"
                                                        value="<?php echo e(@$general->email_config->smtp_username); ?>">

                                                </div>

                                                <div class="col-md-3">

                                                    <label for=""><?php echo e(__('SMTP Password')); ?></label>
                                                    <input type="text" name="email_config[smtp_password]"
                                                        class="form-control"
                                                        value="<?php echo e(@$general->email_config->smtp_password); ?>">

                                                </div>
                                                <div class="col-md-3">

                                                    <label for=""><?php echo e(__('SMTP port')); ?></label>
                                                    <input type="text" name="email_config[smtp_port]" class="form-control"
                                                        value="<?php echo e(@$general->email_config->smtp_port); ?>">

                                                </div>

                                                <div class="col-md-6 mt-3">

                                                    <label for=""><?php echo e(__('SMTP Encryption')); ?></label>
                                                    <select name="email_config[smtp_encryption]" id="encryption"
                                                        class="form-control selectric">
                                                        <option value="ssl"
                                                            <?php echo e(@$general->email_config->smtp_encryption == 'ssl' ? 'selected' : ''); ?>>
                                                            <?php echo e(__('SSL')); ?></option>
                                                        <option value="tls"
                                                            <?php echo e(@$general->email_config->smtp_encryption == 'tls' ? 'selected' : ''); ?>>
                                                            <?php echo e(__('TLS')); ?></option>
                                                    </select>

                                                    <code class="hint"></code>

                                                </div>

                                            </div>
                                        <?php endif; ?>

                                    </div>

                                    <div class="form-group col-md-12">

                                        <button type="submit"
                                            class="btn btn-primary float-right"><?php echo e(__('Update Email Configuration')); ?></button>

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


<?php $__env->startPush('script'); ?>
    <script>
        $(function() {
            'use strict'

            $('select[name=email_method]').on('change', function() {
                if ($(this).val() == 'smtp') {
                    var html = `

                     <div class="row">

                                    <div class="col-md-3">

                                        <label for=""><?php echo e(__('SMTP HOST')); ?></label>
                                        <input type="text" name="email_config[smtp_host]"  class="form-control" value="<?php echo e(@$general->email_config->smtp_host); ?>">

                                    </div>

                                    <div class="col-md-3">

                                        <label for=""><?php echo e(__('SMTP Username')); ?></label>
                                        <input type="text" name="email_config[smtp_username]"  class="form-control" value="<?php echo e(@$general->email_config->smtp_username); ?>">

                                    </div>

                                    <div class="col-md-3">

                                        <label for=""><?php echo e(__('SMTP Password')); ?></label>
                                        <input type="text" name="email_config[smtp_password]"  class="form-control" value="<?php echo e(@$general->email_config->smtp_password); ?>">

                                    </div>
                                    <div class="col-md-3">

                                        <label for=""><?php echo e(__('SMTP port')); ?></label>
                                        <input type="text" name="email_config[smtp_port]"  class="form-control" value="<?php echo e(@$general->email_config->smtp_port); ?>">

                                    </div>

                                    <div class="col-md-6 mt-3">

                                        <label for=""><?php echo e(__('SMTP Encryption')); ?></label>
                                       <select name="email_config[smtp_encryption]" id="encryption" class="form-control selectric">
                                        <option value="tls" <?php echo e(@$general->email_config->smtp_encription == 'tls' ? 'selected' : ''); ?>><?php echo e(__('TLS')); ?></option>
                                        <option value="ssl" <?php echo e(@$general->email_config->smtp_encription == 'ssl' ? 'selected' : ''); ?>><?php echo e(__('SSL')); ?></option>
                                       </select>


                                       <code class="hint"></code>

                                    </div>

                                </div>

                `;

                    $('.smtp-config').html(html)

                } else {
                    $('.smtp-config').html('')
                }
            })

            $(document).on('change', '#encryption', function() {

                if ($(this).val() == 'ssl') {
                    $('.hint').text("For SSL please add ssl:// before host otherwise it won't work")
                } else {
                    $('.hint').text('')
                }
            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u207221236/domains/codeshack.net/public_html/tradedemo/core/resources/views/backend/email/config.blade.php ENDPATH**/ ?>