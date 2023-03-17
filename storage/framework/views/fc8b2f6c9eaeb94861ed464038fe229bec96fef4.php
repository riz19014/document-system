    <div class="header-area">
        <div class="container-xxl">
            <div class="row align-items-center">
              <div class="col-6 col-lg-3">
                <a class="logo" href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('img/logo-white.png')); ?>" align="" class="img-fluid" width="200"></a>
              </div> 
              <div class="col-6 col-lg-9 text-end">

                <div class="login-info">  <a href="<?php echo e(url('logout')); ?>" class="logout"><span class="fas fa-power-off"></span> Log Out</a></div>
                <button type="button" id="sidebarCollapse" class="btn btn-info d-lg-none d-inline-block">
                    <i class="fas fa-align-left"></i>
                </button>
                
                <a href="<?php echo e(route('notify-files')); ?>" class="share-link text-primary ps-2 position-relative"><i class="fas fa-bell fa-lg" ></i><?php if($filecount > 0): ?> <span class="badge"><?php echo e($filecount); ?></span><?php endif; ?></a>
                <a target="_blank" title="User Manual" href="<?php echo e(asset('help/UserManual.pdf')); ?>" class="ps-2 help-link"><i class="fas fa-question"></i></a>         
              </div>
            </div>
          </div>
      </div><?php /**PATH /home/rizwan/tpro/NDMS/resources/views/partials/header.blade.php ENDPATH**/ ?>