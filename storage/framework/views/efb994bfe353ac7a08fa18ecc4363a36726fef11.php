<?php
    $yourLinks = content('links.content');
?>
<!-- Wallet Card -->
<div class="section wallet-card-section pt-1">
    <div class="row align-items-center py-3 px-2" style="position: relative;">
        <div class="col-auto">
            <img width="80px" class="imaged rounded-circle" src="<?php echo e(@Auth::user()->image ? getFile('user', @Auth::user()->image) : dummyImg()); ?>"/>
        </div>
        <div class="col">
            <h4 class="mb-0 text-white"><?php echo e(Auth::user()->username); ?></h4>
        </div>
        <div class="col-auto text-center">
            
            <img width="50px" height="50px" src="https://cdn-icons-png.flaticon.com/128/5549/5549231.png"/>
            <h5 class="mb-0 text-light">VIP Privillage</h5>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h6 class="mb-1 small-font text-start">Main Wallet</h6>
                    <h3 class="mb-1"><?php echo e(@$general->currency_sym); ?> <?php echo e(showAmount(@$user->balance)); ?></h3>
                </div>
                <div class="col-6 text-end">
                    <h6 class="mb-1 small-font text-end">Trading Wallet</h6>
                    <h3 class="mb-1"><?php echo e(@$general->currency_sym); ?> <?php echo e(showAmount(@$user->trading_balance)); ?></h3>
                </div>
            </div>

            <div class="row">
                <a class="col-3 text-center customLink" href="<?php echo e(route('user.usdt.index')); ?>">
                
                    <img class="icon-color-change" width="45px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/9652/9652743.png">
                    <div class="small-font">Deposit</div>
                </a>
                <a class="col-3 text-center customLink" href="<?php echo e(route('user.withdraw')); ?>">
                    <img class="icon-color-change" width="45px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/9652/9652652.png">
                    <div class="small-font">Withdraw</div>
                </a>
                <a class="col-3 text-center transactionLogBtn" href="javascript:void(0)">
                    <img class="icon-color-change" width="45px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/12194/12194480.png">
                    <div class="small-font">Records</div>
                </a>
                <a class="col-3 text-center profileSettingBtn" href="javascript:void(0)">
                    <img class="icon-color-change" width="45px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/512/12195/12195137.png">
                    <div class="small-font">Account</div>
                </a>
            </div>

            

        </div>
    </div>
</div>
<!-- Wallet Card -->


<!-- Stats -->
<div class="section">
    <div class="row mt-2">
        <div class="col-6">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img width="40px" height="40px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/9590/9590116.png" alt="">
                    </div>
                    <div class="col ps-0 text-end">
                        <div class="title">Total Deposit</div>
                        <div class="value text-danger"><?php echo e(@$general->currency_sym); ?> <?php echo e(showAmount(@$totalDeposit)); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col pe-0 text-start">
                        <div class="title">Total Withdraw</div>
                        <div class="value text-success"><?php echo e(@$general->currency_sym); ?> <?php echo e(showAmount(@$withdraw)); ?></div>
                    </div>
                    <div class="col-auto">
                        <img width="40px" height="40px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/9590/9590117.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6 h-100">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img width="40px" height="40px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/1353/1353566.png" alt="">
                    </div>
                    <div class="col ps-0 text-end">
                        <div class="title">Today Profit</div>
                        <div class="value"><?php echo e(@$general->currency_sym); ?> <?php echo e(showAmount($today['earning'])); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 h-100">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col pe-0 text-start">
                        <div class="title">Total Profit</div>
                        <div class="value"><?php echo e(@$general->currency_sym); ?> <?php echo e(showAmount($total['earning'])); ?></div>
                    </div>
                    <div class="col-auto">
                        <img width="40px" height="40px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/7418/7418648.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img width="40px" height="40px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/5662/5662976.png" alt="">
                    </div>
                    <div class="col ps-0 text-end">
                        <div class="title">Refferal Earn</div>
                        <div class="value"><?php echo e(@$general->currency_sym); ?> <?php echo e(showAmount($commison)); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- * Stats -->

<ul class="listview image-listview inset mt-2">
    <li>
        <a href="javascript:void(0)" class="item profileSettingBtn">
            <div class="icon-box">
                <img width="25px" src="https://cdn-icons-png.flaticon.com/128/3649/3649387.png" alt="">
            </div>
            <div class="in">
                <div>Account Info</div>
            </div>
        </a>
    </li>

    <li>
        <a href="<?php echo e(route('user.kyclist')); ?>" class="item customLink">
            <div class="icon-box">
                <img width="25px" src="https://cdn-icons-png.flaticon.com/512/12195/12195137.png" alt="">
            </div>
            <div class="in">
                <div>KYC Status</div>
            </div>
        </a>
    </li>

    <li>
        <a href="<?php echo e(route('user.team', 1)); ?>" class="item customLink">
            <div class="icon-box">
                <img width="25px" src="https://cdn-icons-png.flaticon.com/128/4807/4807598.png" alt="">
            </div>
            <div class="in">
                <div>My Team</div>
            </div>
        </a>
    </li>
    
    
    
    <li>
        <a href="<?php echo e(route('user.withdraw.setting.bank.card')); ?>" class="item">
            <div class="icon-box">
                <img width="25px" src="https://cdn-icons-png.flaticon.com/128/9528/9528894.png" alt="">
            </div>
            <div class="in">
                <div>Withdraw Setting</div>
            </div>
        </a>
    </li>
    <li>
        <a href="<?php echo e(@$yourLinks->data->apps); ?>" class="item">
            <div class="icon-box">
                <img width="25px" src="https://cdn-icons-png.flaticon.com/128/3437/3437364.png" alt="">
            </div>
            <div class="in">
                <div>App Download</div>
            </div>
        </a>
    </li>
    
    <li>
        <a href="<?php echo e($yourLinks->data->telegram); ?>" class="item">
            <div class="icon-box">
                <img width="25px" src="https://cdn-icons-png.flaticon.com/128/1391/1391058.png" alt="">
            </div>
            <div class="in">
                <div>Telegram</div>
            </div>
        </a>
    </li>
    <li>
        <a href="<?php echo e(route('pages', 'about')); ?>" class="item">
            <div class="icon-box">
                <img width="25px" src="https://cdn-icons-png.flaticon.com/128/2115/2115962.png" alt="">
            </div>
            <div class="in">
                <div>About Us</div>
            </div>
        </a>
    </li>
</ul>



<!-- Stats -->

<!-- * Stats -->
<!-- Account Options -->


<!-- Logs -->


<div class="section my-3">
    <a href="javascript:void(0)" class="btn btn-gr-red gr-bg-red w-100 shadow" data-bs-toggle="modal" data-bs-target="#signoutAlert">Sign Out</a>
</div>

<!-- Dialog Basic -->
<div class="modal fade dialogbox" id="signoutAlert" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure?</h5>
            </div>
            <div class="modal-footer">
                <div class="btn-inline">
                    <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</a>
                    <a href="<?php echo e(route('user.logout')); ?>" class="btn btn-text-primary">YES</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * Dialog Basic -->


<?php /**PATH /home/u207221236/domains/codeshack.net/public_html/tradedemo/core/resources/views/theme3/user/ajax/dashboard.blade.php ENDPATH**/ ?>