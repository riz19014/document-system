

<?php $__env->startSection('content'); ?>


<?php $__env->startSection('content_header'); ?>

  <?php echo $__env->make('partials.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<div id="content">
    <div class="breadcrumb-area mb-4">
      <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb"  >
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" onclick="return false;">Nishat</a></li>
            <li class="breadcrumb-item active" aria-current="page">units</li>
          </ol>
      </nav>
    </div>
  <div class="main-content-area">
      <div class="file-view-area">
        <div class="row">
            <div class="audit-logs">
              <p class="mb-2 text-primary font-600">Units</p>
              <table class="table table-striped unit-table" >
                <thead>
                  <tr>
                    <th>Unit Name</th>
                    <th>Created at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
        </div>
      </div>
  </div>
</div>


<!-- create unit model -->

<div class="modal fade" id="unitAddModal" tabindex="-1" aria-labelledby="    exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New unit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="unit_form" action="" method="post">
              <?php echo e(csrf_field()); ?>


            <div class="mb-3">
            <div class="form-group">
              <label>Unit Name</label>
              <input required type="text" id="unit-name" class="form-control" name="name">

              <div class="d-none" id='form-meta_name'>
                <span id="error-meta_name" style="color: red"></span>
              </div>

            </div>
            </div>

            <div class="mb-3 text-end">
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>


<!-- delete unit model -->

<div class="modal fade" id="unitDelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <p>Are you sure you want to delete unit?</p>
        <form id="unit_delete" action="" method="post">
           <?php echo e(csrf_field()); ?>

          <div class="mb-3">
            <div class="d-none" id='form-fname'><span id="error-fname" style="color: red"></span></div>
            <input type="hidden" name="unit_id" id="unitDel" >
            <div class="big" id="textTitle" style="font-size: 2.2rem;"></div>
          </div>
          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

 <?php $__env->startSection('js'); ?>

 <script type="text/javascript">


  /* ---- unit list ----  */

  $(function () {
       var table = $('.unit-table').DataTable({
       "paging": false,
       "ordering": false,
       "searching": false,
       "info": false,
       // "lengthChange": false
       language : {
          "zeroRecords": " "
      },
        ajax: {
            url:"<?php echo route('unit-table-data'); ?>",
            data: function(data) { 
               data.search_grid = $('#search_grid').val()
           },
            method: "get",
          },
          columns: [

              {data: 'name', name: 'name'},
              {data: 'created_at', name: 'created_at'},
              {data: 'action', name: 'action'},

          ]
      });

  });

  /* ---- unit sotre ----  */

    $(document).on('submit','#unit_form',function(e){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "<?php echo e(route('store-unit')); ?>",
         data: $('#unit_form').serialize(),
          success: function(data) {
            if(data.success){
              $('#unitAddModal').modal('hide');
              $('#unit_form')[0].reset();
              $('.unit-table').DataTable().ajax.reload();
            }else{
              $("#form-meta_name").removeClass('d-none');
              document.getElementById('error-meta_name').innerHTML = "Unit name already exists.";
              setTimeout(function(){ $('#form-meta_name').addClass('d-none'); }, 4000);
            }

          },
        });
      });


  /* ---- unit delete ----  */

    $(document).on('click','.delUnit',function(e){
      var name = $(this).data("name");
      $('#unitDel').val($(this).data("id"));
      $('#textTitle').html('"'+name+'"');
      $('#unitDelModal').modal('show');
    });

  /* ---- reset unit create form ----  */

    $(document).ready(function(){
      $(document).on('shown.bs.modal','#unitAddModal', function () {
        $('#unit_form')[0].reset();
        $('#unit-name').focus();
      });
    });

  /* ---- delete unit ----  */

    $(document).on('submit','#unit_delete',function(e){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "<?php echo e(route('delete-unit')); ?>",
          data: $('#unit_delete').serialize(),
          success: function(data) {
              $('#unitDelModal').modal('hide');
              $('.unit-table').DataTable().ajax.reload();
          },
        });
      });

  /* ---- search unit ----  */

    $(document).on('keyup','#search_grid', function(e) {
      $('.unit-table').DataTable().ajax.reload(); 
    });

    document.addEventListener('DOMContentLoaded', function () {
       document.getElementById('search_grid').placeholder = 'Search unit..';
    }) 


</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Tariq_Naeem\TNN\Laravel\DMS_S\NDMS\resources\views/account/unit.blade.php ENDPATH**/ ?>