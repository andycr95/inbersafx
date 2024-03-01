<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo e(route('admin.home')); ?>"><?php echo e(@$general->sitename); ?></a>
        </div>

        <ul class="sidebar-menu">

            <li class="nav-item dropdown <?php echo e(menuActive('admin.home')); ?>">
                <a href="<?php echo e(route('admin.home')); ?>" class="nav-link ">
                    <i data-feather="home"></i>
                    <span><?php echo e(__('Dashboard')); ?></span>
                </a>
            </li>

            


            <li class="sidebar-menu-caption"><?php echo e(__('Trading Section')); ?></li>

            <?php if(auth()->guard('admin')->user()->can('manage-plan')): ?>
                <li class="nav-item dropdown <?php echo e(menuActive('admin.general.trading.setting')); ?>">
                    <a href="<?php echo e(route('admin.general.trading.setting')); ?>" class="nav-link ">
                        <i data-feather="box"></i>
                        <span><?php echo e(__('Trading Setting')); ?></span>
                    </a>
                </li>
                <li class="nav-item dropdown <?php echo e(menuActive('admin.trading.runing')); ?>">
                    <a href="<?php echo e(route('admin.trading.runing')); ?>" class="nav-link ">
                        <i data-feather="clock"></i>
                        <span><?php echo e(__('Runing Trade')); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            


            <li class="sidebar-menu-caption"><?php echo e(__('User Management')); ?></li>

            <?php if(auth()->guard('admin')->user()->can('manage-user')): ?>
                <li class="nav-item dropdown <?php echo e(@$navManageUserActiveClass); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i data-feather="user"></i>
                        <span><?php echo e(__('Manage Users')); ?> <?php if(@$deactiveUser > 0): ?>
                                <i
                                    class="far fa-bell text-danger animate__animated animate__infinite animate__heartBeat animate__slow"></i>
                            <?php endif; ?>
                        </span></a>
                    <ul class="dropdown-menu">
                        <li class="<?php echo e(@$subNavManageUserActiveClass); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.user')); ?>"><?php echo e(__('Manage Users')); ?></a>
                        </li>

                        <li class="<?php echo e(@$subNavActiveUserActiveClass); ?>">
                            <a class="nav-link"
                                href="<?php echo e(route('admin.user.filter', 'active')); ?>"><?php echo e(__('Active Users')); ?></a>
                        </li>

                        <li class="<?php echo e(@$subNavDeactiveUserActiveClass); ?>">
                            <a class="nav-link"
                                href="<?php echo e(route('admin.user.filter', 'deactive')); ?>"><?php echo e(__('Deactive Users')); ?> <span
                                    class="badge badge-danger"><?php echo e(@$deactiveUser); ?></span></a>
                        </li>
                          <li class="<?php echo e(@$subNavkycReqUserActiveClass); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.user.kyc.requiest')); ?>"><?php echo e(__('KYC Request')); ?></a>
                        </li>

                        


                        
                    </ul>
                </li>
            <?php endif; ?>




            

            <?php if(auth()->guard('admin')->user()->can('manage-referral')): ?>
                <li class="nav-item dropdown <?php echo e(menuActive('admin.referral*')); ?>">
                    <a href="<?php echo e(route('admin.referral.index')); ?>" class="nav-link ">
                        <i data-feather="link"></i>
                        <span><?php echo e(__('Manage Referral')); ?></span>
                    </a>
                </li>
            <?php endif; ?>




            <li class="sidebar-menu-caption"><?php echo e(__('Payment and Payout')); ?></li>

            

            <?php if(auth()->guard('admin')->user()->can('manage-withdraw')): ?>
                <li class="nav-item dropdown <?php echo e(@$navManageWithdrawActiveClass); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i data-feather="package"></i>
                        <span><?php echo e(__('Manage Withdraw')); ?></span></a>
                    <ul class="dropdown-menu">
                        <li class="<?php echo e(@$subNavWithdrawMethodActiveClass); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.withdraw')); ?>"><?php echo e(__('Withdraw Method')); ?></a>
                        </li>
                        <li class="<?php echo e(@$subNavWithdrawPendingActiveClass); ?>">
                            <a class="nav-link"
                                href="<?php echo e(route('admin.withdraw.pending')); ?>"><?php echo e(__('Pending Withdraws')); ?></a>
                        </li>
                        <li class="<?php echo e(@$subNavWithdrawAcceptedActiveClass); ?>">
                            <a class="nav-link"
                                href="<?php echo e(route('admin.withdraw.accepted')); ?>"><?php echo e(__('Accepted Withdraws')); ?></a>
                        </li>
                        <li class="<?php echo e(@$subNavWithdrawRejectedActiveClass); ?>">
                            <a class="nav-link"
                                href="<?php echo e(route('admin.withdraw.rejected')); ?>"><?php echo e(__('Rejected Withdraws')); ?></a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>


            <?php if(auth()->guard('admin')->user()->can('manage-deposit')): ?>

                <li class="nav-item dropdown <?php echo e(menuActive('admin.deposit.log')); ?> <?php echo e(@$subNavDepositMethodActiveClass); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i data-feather="table"></i>
                        <span><?php echo e(__('Manage Deposit')); ?></span></a>
                    <ul class="dropdown-menu">
                        <li class="<?php echo e(@$subNavDepositMethodActiveClass); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.gateway.index')); ?>"><?php echo e(__('Deposit Method')); ?></a>
                        </li>
                        <li class="<?php echo e(@$subNavDepositPendingActiveClass); ?>">
                            <a class="nav-link"
                                href="<?php echo e(route('admin.deposit.log', 'pending')); ?>"><?php echo e(__('Pending Deposits')); ?></a>
                        </li>
                        <li class="<?php echo e(@$subNavDepositAcceptedActiveClass); ?>">
                            <a class="nav-link"
                                href="<?php echo e(route('admin.deposit.log', 'accepted')); ?>"><?php echo e(__('Accepted Deposits')); ?></a>
                        </li>
                        <li class="<?php echo e(@$subNavDepositRejectedActiveClass); ?>">
                            <a class="nav-link"
                                href="<?php echo e(route('admin.deposit.log', 'rejected')); ?>"><?php echo e(__('Rejected Deposits')); ?></a>
                        </li>
                        <li class="<?php echo e(@$navDepositPaymentActiveClass); ?>">
                            <a class="nav-link"
                                href="<?php echo e(route('admin.deposit.log')); ?>"><?php echo e(__('All Deposits')); ?></a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->guard('admin')->user()->can('manage-email') ||
                auth()->guard('admin')->user()->can('manage-setting') ||
                auth()->guard('admin')->user()->can('manage-gateway') ||
                auth()->guard('admin')->user()->can('manage-language')): ?>
                <li class="sidebar-menu-caption"><?php echo e(__('System Settings')); ?></li>
            <?php endif; ?>

            

            <?php if(auth()->guard('admin')->user()->can('manage-setting')): ?>

                <li class="menu-header"><?php echo e(__('System Settings')); ?></li>

                <li class="nav-item dropdown <?php echo e(@$navGeneralSettingsActiveClass); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i data-feather="settings"></i>
                        <span><?php echo e(__('General Settings')); ?></span></a>
                    <ul class="dropdown-menu">
                        <li class="<?php echo e(@$subNavGeneralSettingsActiveClass); ?>">
                            <a class="nav-link"
                                href="<?php echo e(route('admin.general.setting')); ?>"><?php echo e(__('General Settings')); ?></a>
                        </li>
                        
                        <li class="<?php echo e(@$subNavSEOManagerActiveClass); ?>">
                            <a class="nav-link"
                                href="<?php echo e(route('admin.general.seo')); ?>"><?php echo e(__('Global SEO Manager')); ?></a>
                        </li>

                        <li>
                            <a class="nav-link"
                                href="<?php echo e(route('admin.general.cacheclear')); ?>"><?php echo e(__('Cache Clear')); ?></a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->guard('admin')->user()->can('manage-email')): ?>
                <li class="menu-header"><?php echo e(__('Email Settings')); ?></li>

                <li class="nav-item dropdown <?php echo e(@$navEmailManagerActiveClass); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i data-feather="mail"></i>
                        <span><?php echo e(__('Email Manager')); ?></span></a>
                    <ul class="dropdown-menu">
                        <li class="<?php echo e(@$subNavEmailConfigActiveClass); ?>">
                            <a class="nav-link"
                                href="<?php echo e(route('admin.email.config')); ?>"><?php echo e(__('Email Configure')); ?></a>
                        </li>
                        <li class="<?php echo e(@$subNavEmailTemplatesActiveClass); ?>">
                            <a class="nav-link"
                                href="<?php echo e(route('admin.email.templates')); ?>"><?php echo e(__('Email Templates')); ?></a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>



            

            

            

            




            <?php if(auth()->guard('admin')->user()->can('manage-frontend') ||
                auth()->guard('admin')->user()->can('manage-subscriber')): ?>

                <li class="sidebar-menu-caption"><?php echo e(__('Others')); ?></li>

            <?php endif; ?>
            <?php if(auth()->guard('admin')->user()->can('manage-frontend')): ?>

                <li class="nav-item dropdown <?php echo e(@$navManagePagesActiveClass); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i data-feather="layout"></i>
                        <span><?php echo e(__('Frontend')); ?></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li class="<?php echo e(@$subNavPagesActiveClass); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.frontend.pages')); ?>"><?php echo e(__('Pages')); ?></a>
                        </li>

                        <?php $__empty_1 = true; $__currentLoopData = $urlSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="">
                                <a class="nav-link"
                                    href="<?php echo e(route('admin.frontend.section.manage', ['name' => $key])); ?>"><?php echo e(frontendFormatter($key) . ' Section'); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <?php endif; ?>
                    </ul>

                </li>

            <?php endif; ?>



            



            


            

            <li class="my-5">

            </li>

        </ul>
    </aside>
</div>
<?php /**PATH /home/webesite/binance.webesite.xyz/core/resources/views/backend/layout/sidebar.blade.php ENDPATH**/ ?>