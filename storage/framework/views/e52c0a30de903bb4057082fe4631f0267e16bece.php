<?php $__env->startSection('content'); ?>
              

<?php $__env->startSection('content_header'); ?>

<?php echo $__env->make('partials.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
          
            <!-- Page Content  -->
          <div id="content">  
              <div class="breadcrumb-area mb-4">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#" onclick="return false;">Softpyramid</a></li>
                      <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <li class="breadcrumb-item"><a href="<?php echo e(route('folder-index',$folder->id)); ?>"><?php echo e($folder->description); ?></a></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                      <li class="breadcrumb-item"><a href="<?php echo e(route('file-view',$file->id)); ?>"><?php echo e($file->doc_name); ?></a></li>
                     
                      
                    </ol>
                  </nav>
                </div>


        


          <div class="main-content-area">
                      <div class="file-view-area">
                        <div class="row">
                          <div class="col-lg-9">
                            <div class="img-icon mb-0">



                              <i class="fas fa-images"></i>&nbsp;&nbsp; <a href="#"><?php echo e($file_name); ?></a>



                            </div>
                            <p class="mb-4 text-primary font-400">Upload new version</p>
                            <div class="edit-form-file">
                              <form action="" method="" id="folder_file">
                                <?php echo e(csrf_field()); ?>

                                <div class="mb-4">
                                  <label class="font-600 text-primary">Name</label>
                                  <div class="input-group mb-3">
                                     <input type="text" id="docname" name="doc_name" value="<?php echo e($file_name); ?>" class="form-control">
                                    <span class="input-group-text" id="basic-addon1">.<?php echo e($file_ext); ?></span>
                                       <input type="hidden" name="file_ext" value=".<?php echo e($file_ext); ?>">
                                       <input type="hidden" name="file_id" value="<?php echo e($fileid); ?>">
                                  </div>
                                </div>
                                  <div class="mb-4">
                                  <label class="font-600 text-primary">Tags</label>
                                  <div class="input-group mb-3">
                                   <input type="text" id="docname" name="doc_tag" value="<?php echo e($file->tags); ?>" class="form-control" />
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-4">
                                      <label class="font-600 text-primary">Date</label>
                                      <input type="date" name="date" class="form-control" <?php if($file->date != null): ?>
                                      value =<?php echo e(\Carbon\Carbon::parse( $file->date )->format('Y-m-d')); ?>

                                      <?php endif; ?>/>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-4">
                                      <label class="font-600 text-primary">Due Date</label>
                                      <input type="date" name="due_date" class="form-control" <?php if($file->date != null): ?>
                                      value = <?php echo e(\Carbon\Carbon::parse( $file->due_date )->format('Y-m-d')); ?>

                                      <?php endif; ?>>
                                    </div>
                                  </div>
  
                                  <div class="col-md-12">
                                    <div class="mb-4">
                                      <label class="text-primary font-600" >Notes</label>
                                      <textarea class="form-control" name="note" id="note" rows="3"><?php echo e($file->note); ?></textarea>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <p class="text-primary font-600 mb-0">Custom Metadata Fields</p>
                                      <label class="text-primary">Manage all metadata fields</label>
                                  </div>

                                  <?php if($editfiles->isEmpty()): ?> 
                                  <?php $__currentLoopData = $editcols; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $editcol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                  
                                  <div class="col-md-6">
                                    <div class="mb-3">
                                      <span class="form-control metavalue"><?php echo e($editcol->tagname->tagging_name); ?></span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3">
                                      <input type="text" id="docname" name="meta[<?php echo e($editcol->meta_tag_id); ?>]" class="form-control" />
                                    </div>
                                  </div>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                  <?php else: ?>
                                   <?php $__currentLoopData = $editfiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $editfile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                      <div class="col-md-6">
                                    <div class="mb-3">
                                      <span class="form-control metavalue"><?php echo e($editfile->metaname->tagging_name); ?></span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3">
                                      <input type="text" id="docname" name="meta[<?php echo e($editfile->meta_tag_id); ?>]" value="<?php echo e($editfile->meta_tag_value); ?>" class="form-control" />
                                    </div>
                                  </div>

                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>



                                </div>
                                <div class="row moveonright">
                                  <div class="col-md-3">
                                    <a class="btn btn-primary font-600 text-uppercase d-block cancelbtn" href="<?php echo e(route('file-view',$file->id)); ?>">
                                        Cancel
                                    </a>
                                  </div>
                                  <div class="col-md-4">
                                    <button class="btn btn-primary font-600 text-uppercase d-block w-100">Save</button>
                                  </div>
                                </div>

                              </form>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>


<?php $__env->stopSection(); ?> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">



     $(document).on('submit','#folder_file',function(e){  
        e.preventDefault(); 
        $.ajax({
          type: "POST",
          url: "<?php echo e(route('edit-file-form')); ?>",
         data: $('#folder_file').serialize(),
          success: function(data) {
            // alert(data.fileid);
            $('#exampleModal').modal('hide');
              window.location.href = "/file/view/"+data.fileid;

          },
        });
      });




  $(document).on('click', '#send_btn', function(){
       value = 34;
       
         $.ajax({
      url: "<?php echo e(route('edit-file-form')); ?>",
      method: 'post',
      data: $('#contact_us').serialize(),

      success: function(response){
         //------------------------
            $('#send_form').html('Submit');
            $('#res_message').show();
            $('#res_message').html(response.msg);
            $('#msg_div').removeClass('d-none');
 
            document.getElementById("contact_us").reset(); 
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },10000);
         //--------------------------
      }});
        
         });
  
  $(document).ready(function(){
$('#send_form').click(function(e){
   e.preventDefault();
 
   $('#send_form').html('Sending..');
   
   /* Submit form data using ajax*/
   $.ajax({
      url: "<?php echo e(url('edit-form')); ?>",
      method: 'post',
      data: $('#contact_us').serialize(),
      success: function(response){
         //------------------------
            $('#send_form').html('Submit');
            $('#res_message').show();
            $('#res_message').html(response.msg);
            $('#msg_div').removeClass('d-none');
 
            document.getElementById("contact_us").reset(); 
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },10000);
         //--------------------------
      }});
   });
});
</script>









<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rizwan/tpro/NDMS/resources/views/file/edit.blade.php ENDPATH**/ ?>