

<?php $__env->startSection('content_headerr'); ?>


                <!-- Page Content  -->
             <?php if($status_data->approval_status == 1): ?>   
                <div id="content">
                      <div class="main-content-area">
                      <div class="accept-reject-form">
                        <div class="row justify-content-center">
                          <div class="col-md-6">
                            <div class="topicone text-center mb-4">
                              <i class="fas fa-file-alt"></i>
                            </div>
                            <h5 class="font-600 text-center mb-4">You have been asked to approve a documnet</h5>
          

                              <div class="mb-3">
                                <div class="input-group position-relative field-icon rounded border border-2">
                                  <input type="text" class="form-control bg-white border-end-0 border-0" value="" readonly="">
                                  <span class="field-text"><?php echo e($status_data->file->doc_name); ?></span>
                                  <i class="fas fa-file-alt"></i>


                                  <a href="<?php echo e(route('download-file',$status_data->file_id)); ?>" class="btn text-primary btn-download" type="button"><i class="fas fa-download"></i></a>


                              

                                <a href="<?php echo e(asset('storage/'.$status_data->file->foldername->description.'/'.$status_data->file->doc_name)); ?>" class="btn text-primary btn-searchfile" type="button" data-lity><i class="far fa-file-alt"></i></a>   


    





                                </div>
                              </div>
                              <div class="mb-3">
                                
                              </div>
                              <div class="mb-3">
                                <div class="border border-top-2"></div>
                              </div>
                              <div class="mb-5">
                                <h6 class="font-600 mb-3">Users in this approval workflow</h6>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-check">
                                  <?php if(Auth::user()->id == $user->User->id): ?>
                                  <input class="form-check-input" type="radio" name="approval" id="acme" checked>
                                  <?php else: ?>
                                  <input class="form-check-input" type="radio" name="approval" id="acme" disabled>
                                    
                                  <?php endif; ?>
                                  <label class="form-check-label" for="acme">
                                    <?php echo e($user->User->email); ?>

                                  </label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </div>
                              <div class="mb-3">
                                <label>Comment</label>
                                <textarea class="form-control comField" name="comment" rows="6"></textarea>
                              </div>
                         
                              <div class="mb-3 text-center">
                                <button type="submit" value="2" class="btn btn-success btn-sm text-upppercase font-600 me-4 approve_btn">Approve</button>
                                <button type="button" value="3" class="btn btn-danger btn-sm text-upppercase font-600 reject_btn">Reject</button>
                              </div>



                              
                       
                          </div>
                        </div>                            
                      </div>
                    </div>
                  </div>

             <?php else: ?>


                <div id="content">              
                    <div class="main-content-area">
                      <div class="accept-reject-form">
                        <div class="row justify-content-center">
                          <div class="col-md-6">
                            <div class="topicone text-center mb-4">
                              <i class="fas fa-file-alt"></i>
                            </div>
                            <h5 class="font-600 text-center mb-4">You have been asked to approve a documnet</h5>
                              <div class="mb-3">
                                <div class="input-group position-relative field-icon rounded border border-2">
                                  <input type="text" class="form-control bg-white border-end-0 border-0" value="" readonly="">
                                  <span class="field-text"><?php echo e($status_data->file->doc_name); ?></span>
                                     <i class="fas fa-file-alt"></i>

                                  <a href="<?php echo e(route('download-file',$status_data->file_id)); ?>" class="btn text-primary btn-download" type="button"><i class="fas fa-download"></i></a>
                                <a href="<?php echo e(asset('storage/'.$status_data->file->foldername->description.'/'.$status_data->file->doc_name)); ?>" class="btn text-primary btn-searchfile" type="button" data-lity><i class="far fa-file-alt"></i></a>   
                                </div>
                              </div>
                              
                              <div class="mb-3">
                                <div class="border-top border-top-2"></div>
                              </div>


                              <div class="mb-3">
                                <h6 class="font-600 mb-3 text-primary">Your Decision</h6>
                                <p class="mb-1"><strong>Comment</strong></p>
                                <p><?php echo e($status_data->resolution); ?></p>
                              </div>

                              <div class="mb-3">
                                <p class="mb-1"><strong>Status</strong></p>
                                <?php if($status_data->approval_status == 2): ?> 
                                <p><i class="fas fa-check-circle text-success"></i> &nbsp;Approved</p>
                                <?php elseif($status_data->approval_status == 3): ?> 
                                <p><i class="fas fa-times-circle text-danger"></i> &nbsp;Rejected</p>
                                <?php endif; ?>
                              </div>
                              <div class="mb-3">
                                <div class="border-top border-top-2"></div>
                              </div>


                              <div class="mb-3">
                                <h6 class="font-600 mb-3 text-primary">Resolution Result</h6>

                                 <?php if($status_data->approval_status == 2): ?> 
                               <p><i class="fas fa-check-circle text-success"></i> &nbsp;Approved</p>
                                <?php elseif($status_data->approval_status == 3): ?> 
                               <p><i class="fas fa-times-circle text-danger"></i> &nbsp;Rejected</p>
                                <?php endif; ?>   
                              </div>
                              <div class="mb-3">
                                <div class="border-top border-top-2"></div>
                              </div>
                              <div class="mb-3">
                                <h6 class="font-600 mb-3">Users in this approval workflow</h6>
                                 <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p>
                                  <?php if($status_data->approval_status == 2): ?> 
                                  <i class="fas fa-circle text-success" title="Approved"></i>
                                  <?php elseif($status_data->approval_status == 3): ?>
                                  <i class="fas fa-circle text-danger" title="Rejected"></i>
                                  <?php endif; ?>

                                  &nbsp; <?php echo e($user->User->email); ?></p>
                                <div class="ms-3">
                                  <p class="mb-2"><i class="far fa-clock"></i>&nbsp; <?php echo e(\Carbon\Carbon::parse($status_data->updated_at)->timezone('Asia/Karachi')->format('d M Y, H:i:s')); ?></p>
                                  <?php if($status_data->resolution != null): ?>
                                  <p class="mb-2"><i class="far fa-comment"></i>&nbsp; <?php echo e($status_data->resolution); ?></p>
                                  <?php endif; ?>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </div>                
                          </div>
                        </div>                            
                      </div>
                    </div>
                  </div>
         <?php endif; ?>         


<?php $__env->stopSection(); ?> 


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">





 $(document).on('click', '.reject_btn', function(e){
e.preventDefault();
  btns = $('.reject_btn').val();
  comment = $('.comField').val();
  mfile= '<?php echo e($status_data->file_id); ?>';
swal({
    title: "Reject Document?",
    text: "Are you sure, you want to reject this document. ?",
    buttons: {
        cancel: true,
        confirm: true,
    },
    icon: "warning",
    dangerMode: true,
})
    .then(willDelete => {
        if (willDelete) {

        $.ajax({
          type: "get",
          url: "<?php echo e(route('reso-status')); ?>",
         data: { file: mfile, btnstatus:btns, comment:comment },
          success: function(data) {

            // var url = '<?php echo e(route("reso-view", ":slug")); ?>';
            //     url = url.replace(':slug', data.fileId);
            var url = '<?php echo e(route("file-approval-history")); ?>';
            window.location =  url;

          },
        });
        }
    });
});


$(document).on('click', '.approve_btn', function(e){
e.preventDefault();
   btns = $('.approve_btn').val();
   comment = $('.comField').val();
   mfile= '<?php echo e($status_data->file_id); ?>';
swal({
    title: "Approve Document?",
    text: "Are you sure, you want to approve this document. ?",
    buttons: {
        cancel: true,
        confirm: true,
    },
    icon: "warning",
    dangerMode: true,
})
    .then(willDelete => {
        if (willDelete) {

        $.ajax({
          // type: "get",
          url: "<?php echo e(route('reso-status')); ?>",
         data: { file: mfile, btnstatus:btns, comment:comment},
          success: function(data) {
               // var url = '<?php echo e(route("reso-view", ":slug")); ?>';
               //  url = url.replace(':slug', data.fileId);
               var url = '<?php echo e(route("file-approval-history")); ?>';  
               window.location =  url;

          },
        });
        }
    });
});


</script>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Tariq_Naeem\TNN\Laravel\DMS_S\dms\resources\views/approval/resolution.blade.php ENDPATH**/ ?>