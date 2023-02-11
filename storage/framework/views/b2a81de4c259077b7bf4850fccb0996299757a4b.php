
  <div class="container-xxl">
    <div class="wrapper">
        <!-- Sidebar  -->
        <div class="row">
          <div class="col-lg-3 left-sidebar-area">
              <nav id="sidebar">

                   <ul class="list-unstyled components">
                    <?php if(Auth::user()->role_id !== 4): ?>
                    <li>
                        <a href="#">Index&nbsp;<i class="fas fa-envelope text-primary"></i></a>
                    </li>
                    <li><a href="#">#team</a></li>
                    <?php $__currentLoopData = $sidebars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <li><a id="sinfo" data-id="<?php echo e($side->id); ?>" href="<?php echo e(route('folder-index',$side->id)); ?>"><?php echo e($side->description); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div id="line_items"></div>
                     
                    <li class="mb-5"><a id="sectionId" href="#" data-bs-toggle="modal" data-bs-target="#createnewsection"><i class="fas fa-plus-circle text-primary"></i> &nbsp;Create New Section</a></li>

                    <li><p class="heading-sidebar">Admin tools</p></li>
                    <li><a href="<?php echo e(route('dash-index')); ?>"><i class="fas fa-flag"></i>&nbsp; Dashboard & Reports</a></li>


                    <li><a href="<?php echo e(route('recycle-bin')); ?>"><i class="fas fa-trash-alt"></i>&nbsp; Recycle bin</a></li>
                    <li class='sub-menu'><a href='javascript:void(0)'><i class="fas fa-chevron-right right"></i>&nbsp;More Tools</a>
                      <ul class="p-0 list-unstyled">
                        
                        <li><a href='#'><i class="fas fa-user"></i>&nbsp;Access Overview</a></li>
                        <li><a href="<?php echo e(route('meta-index')); ?>"><i class="fas fa-tag"></i>&nbsp;Meta</a></li>
                        
                        <li><a href="<?php echo e(route('approve-users')); ?>"><i class="fas fa-check"></i>&nbsp;Approval Workflow</a></li>
                        <li><a href="<?php echo e(route('audit-log')); ?>"><i class="fas fa-file-alt"></i>&nbsp;Audit Log</a></li>
                      </ul>
                    </li>
                  <?php endif; ?>

                    

                  <?php if(Auth::user()->role_id == 4): ?>

                  <li><a href="<?php echo e(route('manage-units')); ?>"><i class="fas fa-code-branch"></i>&nbsp; Operating Unit</a></li>

                    <li><a href="<?php echo e(route('manage-departments')); ?>"><i class="fa fa-server"></i>&nbsp; Departments</a></li>

                    <li><a href="<?php echo e(route('manage-sections')); ?>"><i class="fa fa-cubes"></i>&nbsp; Sections</a></li>

                    <li><a href="<?php echo e(route('manage-users')); ?>"><i class="fas fa-users"></i>&nbsp; Manage Users</a></li>
                    

                  <?php endif; ?>
                     
                </ul>
            </nav>
          </div>
          <div class="col-lg-9">

            <!-- Page Content  -->

             <?php echo $__env->yieldContent('content'); ?>

          </div>



        </div>



    </div>

    

  </div>


  <!-- New Section Modal -->


    <div class="modal fade" id="createnewsection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Section</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="section_part" action="" method="post">
                <?php echo e(csrf_field()); ?>

              <div class="mb-3">
                <label>Section Name</label>
                <input type="text" name="folder_name" id="folderName" class="form-control">
                <div class="d-none" id='form-folder_name'><span id="error-folder_name" style="color: red"></span></div>
              </div>
              <div class="mb-3 text-end">
                <button type="submit" class="btn btn-primary">Create</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div><?php /**PATH /home/rizwan/tpro/NDMS/resources/views/partials/sidebar.blade.php ENDPATH**/ ?>