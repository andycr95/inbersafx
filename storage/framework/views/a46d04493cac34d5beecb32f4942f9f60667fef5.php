<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        
        <a href="<?php echo e(route('user.profile')); ?>" class="headerButton">
            <ion-icon name="person-circle"></ion-icon>
        </a>
         
    </div>
    
    
     <a href="<?php echo e(route('home')); ?>">
    <div class="pageTitle">
        
        <img src="<?php echo e(getFile('logo', @$general->whitelogo)); ?>" alt="logo" class="logo">
    </div>
    </a>
    <div class="right">
        <a href="javascript:void(0)" class="headerButton transactionLogBtn">
            <ion-icon class="icon" name="notifications"></ion-icon>
        </a>
        
        <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
            <ion-icon name="menu-outline"></ion-icon>
        </a>
        
    </div>
</div>
<!-- * App Header -->
<?php /**PATH /home/u207221236/domains/codeshack.net/public_html/tradedemo/core/resources/views/theme3/includes/user/top_nav.blade.php ENDPATH**/ ?>