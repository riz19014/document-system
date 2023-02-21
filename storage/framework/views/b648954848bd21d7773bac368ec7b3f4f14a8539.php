

<?php $__env->startSection('content'); ?>


<?php $__env->startSection('content_header'); ?>

  <?php echo $__env->make('partials.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>



<div id="content">

 <div class="main-content-area">
          <div class="file-view-area">
            <div class="row">
              <div class="col-lg-9">


                <div class="audit-logs">
                  <p class="mb-2 text-primary font-600" style="font-size: 1.3rem;">
                  Files that need my approval:
                  </p>

                </div>
                 <div class="row">
                <div class="col-lg-5">
                   
                  (<?php echo e($filecount); ?>) Files
                </div>
                <div class="col-lg-2">
                    <?php if($filecount !=0): ?>
                    <a href="<?php echo e(route('file-approval-view')); ?>" class="btn btn-primary ">View</a>
                    <?php endif; ?>


                </div>


              </div>
            
              </div>
                <div class="row" style="text-align: right;" >
                     <div class="bg-light" >
  
                    
                    <a href="<?php echo e(route('file-approval-history')); ?>" style="color: #1ea1d7;">
                      <span>My Approval History</span>
                    </a>


                </div>
              </div>

            </div>
          </div>
        </div> 
</div>



<?php $__env->stopSection(); ?> 











<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Tariq_Naeem\TNN\Laravel\DMS_S\NDMS\resources\views/approval/notify.blade.php ENDPATH**/ ?>