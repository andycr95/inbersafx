<div class="card mb-3">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-4 px-1">
                <a class="btn btn-primary btn-sm w-100 Nav profileSettingBtn" id="NavAccount" href="#" >Account</a>
            </div>
            <div class="col-4 px-1">
                <a class="btn btn-primary btn-sm w-100 Nav addressSettingBtn" id="NavAddress" href="#">Address</a>
            </div>
            <div class="col-4 px-1">
                <a class="btn btn-primary btn-sm w-100 Nav passwordChangeBtn" id="NavPassword" href="#">Password</a>
            </div>
        </div>
    </div>
</div>
<script>
    console.log($('#currentPath').html());

    $('.Nav').removeClass('disabled');

    if( $('#currentPath').html() == 'Account' ){
        $('#NavAccount').addClass("disabled");
    }
    if( $('#currentPath').html() == 'Address' ){
        $('#NavAddress').addClass("disabled");
    }
    if( $('#currentPath').html() == 'Password' ){
        $('#NavPassword').addClass("disabled");
    }

</script>
<?php /**PATH /var/www/pacificode_c_usr8/data/www/trading.pacificode.co/resources/views/theme3/includes/user/account_nav.blade.php ENDPATH**/ ?>