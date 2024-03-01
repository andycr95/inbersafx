   <?php
       $content = content('about.content');
   ?>


   <!-- about section start -->
   <div class="container py-4">
       <div class="row gy-5 align-items-center justify-content-between">
           <div class="col-12">
               <div class="about-thumb text-center">
                   <img src="<?php echo e(getFile('about', @$content->data->image)); ?>" alt="image">
               </div>
           </div>
           <div class="col-12 about-content wow fadeInUp" data-wow-duration="0.5s"
               data-wow-delay="0.5s">
               <h2 class="section-title text-light"><?php echo e(__(@$content->data->title)); ?></h2>
               <p class="fs--18px mt-3">
                   <?php
                   echo clean(@$content->data->description);
                   ?>
               </p>
               <a href="<?php echo e(__(@$content->data->button_text_link)); ?>"
                   class="btn main-btn mt-4 customLink"><?php echo e(__(@$content->data->button_text)); ?></a>
           </div>
       </div>
   </div>
   <!-- about section end -->
<?php /**PATH /home/webesite/binance.webesite.xyz/core/resources/views/theme3/sections/about.blade.php ENDPATH**/ ?>