<?php $__env->startSection('content'); ?>


<?php $__env->startSection('content_header'); ?>

  <?php echo $__env->make('partials.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>



<div id="content">

	  <div class="breadcrumb-area mb-4">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#" onclick="return false;"><?php echo e(Auth::user()->name); ?></a></li>       
          <li class="breadcrumb-item active" aria-current="page">Pending Files</li>
        </ol>
      </nav>
      
    </div>


             <div class="main-content-area">
                      <div class="file-view-area">
                        <div class="row">
                          <div class="col-lg-12">


                            <div class="audit-logs">
                              <p class="mb-2 text-primary font-600">Pending Approval Files</p>
                              <table class="table table-striped" id="table_data">
                                <thead>
                                  <tr>
                           
                                    <th>Name</th>
                                    <th>Approval status</th>
                                    <th>My decision</th>
                                    <th>Decision time</th>
 
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <td>
                                      <?php if($file->approval_status == 1): ?>
                                      <span style="background-color: #fabd17;" class="status-ball" title="Pending"></span>
                                      <?php elseif($file->approval_status == 2): ?>
                                       <span style="background-color: #00aa00;" class="status-ball" title="Approved"></span>

                                      <?php elseif($file->approval_status == 3): ?>
                                       <span style="background-color: #cc0000;" class="status-ball" title="Rejected"></span>

                                      <?php endif; ?>

                                      <a href="<?php echo e(route('reso-view',$file->id)); ?>"><?php echo e($file->file->doc_name); ?></a>
                                    </td>
                                    <td>


                                      <?php if($file->approval_status == 1): ?>
                                        Pending
                                      <?php elseif($file->approval_status == 2): ?>
                                       
                                       Approved
                                      <?php elseif($file->approval_status == 3): ?>
                                      
                                       Rejected
                                      <?php endif; ?>

                                    </td>
                                    <td>
                                      
                                        <?php if($file->approval_status == 2): ?>
                                        Approved
                                      <?php elseif($file->approval_status == 3): ?>
                                       
                                       Rejected
                                      <?php endif; ?>


                                    </td>
                                     <td>
                                      <?php echo e(\Carbon\Carbon::parse( $file->created_at )->format('d M Y')); ?>

                                    </td>

                                   </tr>

                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                   
                              </table>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div> 
</div>




<div class="modal fade" id="StatusModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New user
</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="invite_user" action="" method="post">
            <?php echo e(csrf_field()); ?>


          <div class="mb-3">
          <div class="form-group">
          	     <select  id="roleId" class="form-control" name="email">
                            <option value="" selected="" disabled>choose type</option>
  
                </select> 
                          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Invite</button>
          </div>           
          </div>
            <div class="d-none" id='form-meta_name'><span id="error-meta_name" style="color: red"></span></div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>    



<?php $__env->stopSection(); ?> 



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">



    $(document).on('submit','#invite_user',function(e){
        e.preventDefault(); 

        $.ajax({
          type: "POST",
          url: "<?php echo e(route('invite-user')); ?>",
         data: $('#invite_user').serialize(),
          success: function(data) {
            // alert('respose');
            $('#ApprovalModal').modal('hide');
            $('#invite_user')[0].reset();
            // $('.meta-table').DataTable().ajax.reload();


             var html = '<tr>';
             html += '<td>'+data.flags.id+'</td>';
             html += '<td>'+data.flags.email+'</td>';
              html += '<td>'+data.flags.created_at+'</td></tr>';
             $('#table_data').prepend(html);


          },
        });
      });

</script>


 








<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rizwan/tpro/NDMS/resources/views/approval/filelist.blade.php ENDPATH**/ ?>