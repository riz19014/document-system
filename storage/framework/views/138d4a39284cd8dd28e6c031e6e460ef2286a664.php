
<?php $__env->startSection('content'); ?>
         <?php $__env->startSection('content_header'); ?>
           <?php echo $__env->make('partials.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

           <?php $__env->stopSection(); ?>

          <div class="col-lg-9">
            <!-- Page Content  -->
            <div id="content">
              <div class="breadcrumb-area mb-4">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#" onclick="return false;">Nishat</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Recycle Bin</li>
                    </ol>
                  </nav>
                </div>

          <table class="table table-striped table-hover recycle-table">
                    <thead>
                        <tr>
                          <th class="noVis">
                            <div class="custom-control custom-checkbox custom-checkbox1 d-inline-block">
                              <input type="checkbox" class="custom-control-input check-all1" name="check_all" id="check-all">
                              <label class="custom-control-label" for="check-all"></label>
                            </div>
                          </th>
                            <th>Name </th>
                            <th> Deleted at </th>
                            <th> Size </th>
                            <th></th>
                        </tr>
                    </thead>

           </table>


<!--                 <div class="main-content-area">
                  <div class="uploads-files-area">
                    <div id="dropzone">
                        <form action="/upload" class="dropzone needsclick" id="demo-upload">

                        <div class="dz-message needsclick">
                          <button type="button" class="dz-button">Folder is empty.</button><br />
                          <span class="note needsclick">Click, or drag your first file here!</span>
                        </div>

                      </form>
                    </div>
                  </div> -->
                
            </div>
          </div>

<!-- New Section Modal -->


<div class="modal fade" id="MetaexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New metadata field
</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="meta_form" action="" method="post">
            <?php echo e(csrf_field()); ?>

          <div class="mb-3">
          <div class="form-group">
            <input type="text" id="meta-name" class="form-control" name="meta_name" placeholder="Field name">
          </div>
            <div class="d-none" id='form-meta_name'><span id="error-meta_name" style="color: red"></span></div>
          </div>
          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


  <div class="modal fade" id="restoreModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <p>Are you sure you want to restore this file?</p>
        <form id="restore_data">
        <?php echo e(csrf_field()); ?>

          <div class="mb-3">
            <div class="d-none" id='form-fname'><span id="error-fname" style="color: red"></span></div>
            <input type="hidden" name="RestoreId" id="restID" value="">
            <div class="big" id="headval" style="font-size: 2.2rem;"></div>
          </div>
          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Restore</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


  <div class="modal fade" id="restoreDelModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <p>Permanently delete file?</p>
        <form id="restore_del">
        <?php echo e(csrf_field()); ?>

          <div class="mb-3">
            <div class="d-none" id='form-fname'><span id="error-fname" style="color: red"></span></div>
            <input type="hidden" name="Restoredel" id="restdel" value="">
            <div class="big" id="restdelval" style="font-size: 2.2rem;"></div>
          </div>
          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Delete permanently</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="emptyRecycleModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <h4>Empty all items from Recycle Bin?</h4>
        <p>All items in the Recycle Bin will be permanently deleted.</p>
        <form id="empty_recycle">
        <?php echo e(csrf_field()); ?>

          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-danger">Empty Now</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="multipleRemoveModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <h5>Are you sure you want to permanently delete selected items?</h5>
        <form id="remove_multiple">
        <?php echo e(csrf_field()); ?>

          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-danger">Delete  Now</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

    <?php $__env->stopSection(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="<?php echo e(asset('js/dropzone.min.js')); ?>"></script>
<script type="text/javascript">

		$(function () {
		var table = $('.recycle-table').DataTable({

		     "paging": false,
		     "ordering": false,
		     "searching": false,
		     "info": false,

		     language : {
		        "zeroRecords": "No records is table"
		    },
		      ajax: {
		          url:"<?php echo route('recycle-data'); ?>",
		          method: "get",
		        },
		        columns: [
                  { data: 'checkbox', name: 'checkbox' },
		            {data: 'doc_name', name: 'doc_name'},
                 {data: 'deleted_at', name: 'deleted_at'},
		            {data: 'file_size', name: 'file_size'},
		            {data: 'action', name: 'action'},

		        ]
		    });

		  });


         $(document).on('click','#restoreId',function(e){
          doc_id = $(this).data("id");
          doc_name = $(this).data("name");
          $('#headval').text(doc_name);
          $('#restID').val(doc_id);
         });

          $(document).on('click','#restoreDel',function(e){
          del_id = $(this).data("id");
          del_name = $(this).data("name");
          $('#restdelval').text(del_name);
          $('#restdel').val(del_id);
         });


        $(document).on('submit','#restore_data',function(e){
        e.preventDefault();

        $.ajax({
          type: "get",
          url: "<?php echo e(route('restore-data')); ?>",
         data: $('#restore_data').serialize(),
          success: function(data) {
            $('#restoreModel').modal('hide');
            $('.recycle-table').DataTable().ajax.reload();
          },
        });
      });


        $(document).on('submit','#empty_recycle',function(e){
        e.preventDefault();
        $.ajax({
          type: "get",
          url: "<?php echo e(route('empty-recycle')); ?>",
          success: function() {
            $('#emptyRecycleModel').modal('hide');
            $('.recycle-table').DataTable().ajax.reload();
          },
        });
      });


      $(document).on('click', '.check-all1', function () {
        if(this.checked == true){
        $('.check1').prop('checked', true);
        $('.check1').parents('tr').addClass('selected');
        var cb_length = $( ".check1:checked" ).length;
        if(cb_length > 0){

          // $('.selected-item').removeClass('d-none');
           $('.cancel-quotations').removeClass('d-none');
           $('.proceed-invoice').removeClass('d-none');
        }
      }else{
        $('.check1').prop('checked', false);
        $('.check1').parents('tr').removeClass('selected');
        // $('.selected-item').addClass('d-none');
          $('.cancel-quotations').addClass('d-none');
          $('.proceed-invoice').addClass('d-none');

      }
    });


    $(document).on('click', '#remove_multiple', function(e){
      e.preventDefault();
      var selected_quots = [];
            var check_idd = 1;
          $("input.check1:checked").each(function() {
            selected_quots.push($(this).val());
          });
          $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          if(selected_quots == ''){
            $('#multipleRemoveModel').modal('hide');
            return false;
          }

       $.ajax({
          url: "<?php echo e(route('permanent-delete')); ?>",
          method: 'post',
          data: {selected_quots:selected_quots},

          success: function(data) {
            $('#multipleRemoveModel').modal('hide');
            $('.recycle-table').DataTable().ajax.reload();
          }
        });


        });

    </script>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Tariq_Naeem\TNN\Laravel\DMS_S\NDMS\resources\views/folder/recycle-bin.blade.php ENDPATH**/ ?>