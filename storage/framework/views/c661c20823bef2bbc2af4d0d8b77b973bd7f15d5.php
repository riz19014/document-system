<?php $__env->startSection('content'); ?>
<?php $__env->startSection('content_header'); ?>
<?php echo $__env->make('partials.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


        <div id="content">

              <div class="breadcrumb-area mb-4">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#" onclick="return false;">Nishat</a></li>
                      <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <li class="breadcrumb-item"><a href="<?php echo e(route('folder-index',$folder->id)); ?>"><?php echo e($folder->description); ?></a></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      <li class="breadcrumb-item"><?php echo e($file->doc_name); ?></li>

                      
                    </ol>
                  </nav>
                </div>
             <div class="main-content-area">
                      <div class="file-view-area">
                        <div class="row">
                          <div class="col-lg-9">
                            <div class="img-icon mb-3">
                              





                        <?php if(strpos($file->doc_name, '.png') || strpos($file->doc_name, '.jpg')
                        || strpos($file->doc_name, '.jpeg') || strpos($file->doc_name, '.svg')): ?>



                        <a title="View" href="<?php echo e(asset('storage/'.$fname->description.'/'.$file->doc_name)); ?>" data-lity><i class='fas fa-images'></i>&nbsp;&nbsp;</a>


                        <?php elseif(strpos($file->doc_name, '.odt') || strpos($file->doc_name, '.txt')): ?>

                         <i class='fas fa-file-alt'></i>&nbsp;&nbsp;



                           <a href="" data-lity data-lity-target="<?php echo e(asset('storage/'.$fname->description.'/'.$file->doc_name)); ?>">Image</a>
                        <?php else: ?>
                        <a title="View" href="<?php echo e(asset('storage/'.$fname->description.'/'.$file->doc_name)); ?>" data-lity><i class='fas fa-file-alt'></i>&nbsp;&nbsp;</a>



                         <?php endif; ?>
                         <a href="<?php echo e(route('download-file',$file->id)); ?>">

                            <?php echo e($file->doc_name); ?></a>
                            </div>


                            <?php if($approve_status== 0): ?>
                              <div class="mb-4">
                                <p class="mb-0 text-danger font-600">File is under approval!</p>
                              </div>
                            <?php endif; ?>

                            <?php if($file->file_locked == 1): ?>
                              <div class="mb-4">
                                <p class="mb-0 text-danger font-600">File is locked!</p>
                              </div>
                            <?php endif; ?>



                                <div class="mb-4">
                                  <p class="mb-0 text-primary font-600">Notes</p>
                                  <p class="mb-0"><?php echo e($file->note); ?></p>
                                </div>


                                <div class="mb-4">
                                  <p class="mb-0 text-primary font-600">Tags</p>
                                  <p class="mb-0"><?php echo e($file->tags); ?></p>
                                </div>


                                 <div class="mb-4">
                                  <p class="mb-0 text-primary font-600">Signed by</p>
                                  <p class="mb-0"><?php echo e($file->signed_by); ?></p>
                                </div>



                            <div class="row">
                              <div class="col-md-4">
                                <div class="mb-4">
                                  <p class="mb-0 text-primary font-600">Document ID</p>
                                  <p class="mb-0"><?php echo e($file->id); ?></p>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <p class="mb-0 text-primary font-600">Date</p>
                                <p class="mb-0">
                                  <?php if($file->date != null): ?>
                                  <?php echo e(\Carbon\Carbon::parse( $file->date )->format('Y-m-d')); ?>

                                  <?php endif; ?>

                                </p>
                              </div>
                              <div class="col-md-4">
                                <p class="mb-0 text-primary font-600">Due Date</p>
                                <p class="mb-0">
                                  <?php if($file->date != null): ?>
                                  <?php echo e(\Carbon\Carbon::parse( $file->due_date )->format('Y-m-d')); ?>

                                  <?php endif; ?>
                              </p>
                              </div>
                            </div>






                                <?php if($fileScans->isEmpty()): ?>

              <?php $__currentLoopData = $folcols; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



          <div class="mb-4">
                                  <p class="mb-0 text-primary font-600"><?php echo e($fol->tagname->tagging_name); ?></p>
                                </div>



        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <?php else: ?>

           <?php $__currentLoopData = $fileScans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fileScan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


         <div class="mb-4">
                                  <p class="mb-0 text-primary font-600"><?php echo e($fileScan->metaname->tagging_name); ?></p>
                                  <p class="mb-0"><?php echo e($fileScan->meta_tag_value); ?></p>
                                </div>



        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>




                            
                            <div class="audit-logs">
                              <p class="mb-2 text-primary font-600">Audit Log</p>
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Time</th>
                                    <th>User</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>


                                <?php $__currentLoopData = $file_audits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $audit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <td><?php echo e($audit->date); ?></td>
                                    <td><?php echo e($audit->User->email); ?></td>
                                    <td>

                                      <?php echo e($audit->action); ?>


                                    </td>
                                  </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="reminder-area">
                              <h6 class="text-primary font-600 mb-3">Reminders:</h6>
                              <ul class="p-0 m-0 list-unstyled reminders">
                                <li class="justify-content-between d-flex">
                                  <a href="#">2021-08-25 @ 16:26</a>
                                  <a href="#"><i class="fas fa-trash"></i></a>
                                </li>
                                <li><a href="#" data-bs-toggle="modal" data-bs-target="#reminders-modal"><i class="far fa-bell"></i>&nbsp; Add New Reminder</a></li>
                              </ul>
                              
                              <div class="Retention">
                                <h6 class="text-primary font-600 mb-0 mt-3">Retention:</h6>
                                <?php if($retention_end != null): ?>
                                <a href="javascript:void(0);"><i class="fas fa-history"></i>&nbsp;  Moved to the Recycle Bin at
                                  <?php echo e($retention_end); ?>

                                </a>
                                <?php else: ?>
                                 <a href="javascript:void(0);"><i class="fas fa-clock"></i>&nbsp;
                                  Infinite
                                </a>

                                <?php endif; ?>
                              </div>
                            </div>
                            <div class="right-btns">
                              
                              <?php if($approve_status== 1): ?>

                                  <?php if($file->file_locked==0): ?>
                                   <a href="#" id="lock_file" class="btn btn-primary btn-sm d-block font-600 mb-3" data-bs-toggle="modal" data-bs-target="#filelockModal" data-id="<?php echo e($file->id); ?>">Lock File</a>
                                  <?php elseif($file->file_locked==1): ?>
                                    <a href="#" id="unlock_file" class="btn btn-primary btn-sm d-block font-600 mb-3" data-bs-toggle="modal" data-bs-target="#fileunlockModal" data-id="<?php echo e($file->id); ?>">Unlock File</a>
                                  <?php endif; ?>

                              <?php endif; ?>




                                <?php if($file->file_locked==0): ?>
                                <a id="update_file" class="btn btn-primary btn-sm d-block font-600 mb-3"href="#" data-bs-toggle="modal" data-bs-target="#fileupdateModal" data-id="<?php echo e($file->id); ?>" >Upload New Version</a>
                                <?php endif; ?>


                                <a href="#" class="btn btn-primary btn-sm d-block font-600 mb-3">View Approval Workflow</a>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
</div>

<!-- end view Content part  -->


   <div class="modal fade" id="filedelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <p>Are you sure you want to delete this file?</p>
        <form id="file_delete" action="" method="post">
        <?php echo e(csrf_field()); ?>

          <div class="mb-3">
            <div class="d-none" id='form-fname'><span id="error-fname" style="color: red"></span></div>
            <input type="hidden" name="file_del" id="FileDel" value="">
            <div class="big" style="font-size: 2.2rem;">"<?php echo e($file->doc_name); ?>"</div>
          </div>
          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="filelockModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <p>Are you sure you want to lock this file?</p>
        <form id="file_lock" action="" method="post">
        <?php echo e(csrf_field()); ?>

          <div class="mb-3">
            <div class="d-none" id='form-fname'><span id="error-fname" style="color: red"></span></div>
            <input type="hidden" name="file_id" id="FileLock" value="<?php echo e($file->id); ?>">
            <div class="big" style="font-size: 2.2rem;">"<?php echo e($file->doc_name); ?>"</div>
          </div>
          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Lock</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="fileunlockModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <p>Are you sure you want to unlock this file?</p>
        <form id="file_unlock" action="" method="post">
        <?php echo e(csrf_field()); ?>

          <div class="mb-3">
            <div class="d-none" id='form-fname'><span id="error-fname" style="color: red"></span></div>
            <input type="hidden" name="file_id" id="FileUnlock" value="<?php echo e($file->id); ?>">
            <div class="big" style="font-size: 2.2rem;">"<?php echo e($file->doc_name); ?>"</div>
          </div>
          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Unlock</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="fileupdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <h4>Update file</h4>
        <div class="user-image mb-3 text-center">
          <div id="imgGallery">
            <img id="img" width="100" height="100"/>
          </div>
        </div>
        <form class="form-horizontal" id="file_update" enctype="multipart/form-data"  method="post">
          <?php echo e(csrf_field()); ?>

            <div class="form-group" style="padding-bottom: 15px">
              <input type="file" class="form-control" id="chooseFile" name="image"
              onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])
              ">
                <input type="hidden" name="file_id" id="FileUpdate" value="<?php echo e($file->id); ?>">
                <input type="hidden" name="folder_des" id="FolderDes" value="<?php echo e($folder->description); ?>">


            </div>
             <button type="submit" class="btn btn-success" style="margin-top:10px">Submit</button>
          </form>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">


       $(document).on('click', '#file_id', function(){
          var file_del_id = $(this).data('id');
          // alert(file_del_id);
          $('#FileDel').val(file_del_id);
         });




    $(document).on('submit','#file_lock',function(e){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "<?php echo e(route('file-lock')); ?>",
         data: $('#file_lock').serialize(),
          success: function(data) {
            $('#filelockModal').modal('hide');
              location.reload();
          },
        });
      });


      $(document).on('submit','#file_unlock',function(e){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "<?php echo e(route('file-unlock')); ?>",
         data: $('#file_unlock').serialize(),
          success: function(data) {
            $('#fileunlockModal').modal('hide');
            location.reload();
          },
        });
      });

      $(document).on('submit','#file_update',function(e){
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
          type: "POST",
          data: formData,
          url: "<?php echo e(route('file-update')); ?>",
          contentType: false,
         processData: false,
          success: function(data) {
            $('#fileupdateModal').modal('hide');
            location.reload();
          },
        });
      });



  $(document).on('submit','#file_delete',function(e){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "<?php echo e(route('file-delete')); ?>",
         data: $('#file_delete').serialize(),
          success: function(data) {
            $('#filedelModal').modal('hide');
            window.location.href = "/folder/index/"+data.folderid;

          },
        });
      });


      // $('#chooseFile').on('change', function() {
      //   $("#imgGallery").removeClass('d-none');
      // });
      // $(document).on('click', '.btn_update-file', function () {
      //   $("#chooseFile").click();
      // });


</script>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rizwan/tpro/NDMS/resources/views/file/view.blade.php ENDPATH**/ ?>