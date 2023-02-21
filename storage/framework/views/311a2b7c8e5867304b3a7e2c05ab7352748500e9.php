<?php $__env->startSection('content'); ?>


<?php $__env->startSection('content_header'); ?>

  <?php echo $__env->make('partials.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<div id="content">
    <div class="breadcrumb-area mb-4">
      <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb"  >
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" onclick="return false;">Nishat</a></li>
            <li class="breadcrumb-item active" aria-current="page">departments</li>
          </ol>
      </nav>
    </div>
  <div class="main-content-area">
      <div class="file-view-area">
        <div class="row">
            <div class="audit-logs">
              <p class="mb-2 text-primary font-600">Departments</p>
              <table class="table table-striped department-table" >
                <thead>
                  <tr>
                    <th>Department Name</th>
                    <th>Unit</th>
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


<!-- create department model -->

<div class="modal fade" id="departmentAddModal" tabindex="-1" aria-labelledby="    exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New department</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="department_form" action="" method="post">
              <?php echo e(csrf_field()); ?>


            <div class="mb-3">
            <div class="form-group">
              <label>Department Name</label>
              <input required type="text" id="department-name" class="form-control" name="name">

              <div class="d-none" id='form-meta_name'>
                <span id="error-meta_name" style="color: red"></span>
              </div>

            </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                 <select required id="unit_id" class="form-control" name="unit">
                    <option value="" disabled="" selected="">Select unit</option>
                    <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($unit->id); ?>"><?php echo e($unit->unit_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
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


<!-- delete department model -->

<div class="modal fade" id="departmentDelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <p>Are you sure you want to delete department?</p>
        <form id="department_delete" action="" method="post">
           <?php echo e(csrf_field()); ?>

          <div class="mb-3">
            <div class="d-none" id='form-fname'><span id="error-fname" style="color: red"></span></div>
            <input type="hidden" name="del_id" id="departmentDel" >
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


  /* ---- department list ----  */

  $(function () {
       var table = $('.department-table').DataTable({
       "paging": false,
       "ordering": false,
       "searching": false,
       "info": false,
       // "lengthChange": false
       language : {
          "zeroRecords": " "
      },
        ajax: {
            url:"<?php echo route('department-table-data'); ?>",
            data: function(data) { 
               data.search_grid = $('#search_grid').val()
           },
            method: "get",
          },
          columns: [

              {data: 'name', name: 'name'},
              {data: 'unit', name: 'unit'},
              {data: 'created_at', name: 'created_at'},
              {data: 'action', name: 'action'},

          ]
      });

  });

  /* ---- department sotre ----  */

    $(document).on('submit','#department_form',function(e){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "<?php echo e(route('store-department')); ?>",
         data: $('#department_form').serialize(),
          success: function(data) {
            if(data.success){
              $('#departmentAddModal').modal('hide');
              $('#department_form')[0].reset();
              $('.department-table').DataTable().ajax.reload();
            }else{
              $("#form-meta_name").removeClass('d-none');
              document.getElementById('error-meta_name').innerHTML = "Department name already exists.";
              setTimeout(function(){ $('#form-meta_name').addClass('d-none'); }, 4000);
            }

          },
        });
      });


  /* ---- department delete ----  */

    $(document).on('click','.delDepartment',function(e){
      var name = $(this).data("name");
      $('#departmentDel').val($(this).data("id"));
      $('#textTitle').html('"'+name+'"');
      $('#departmentDelModal').modal('show');
    });

  /* ---- reset department create form ----  */

    $(document).ready(function(){
      $(document).on('shown.bs.modal','#departmentAddModal', function () {
        $('#department_form')[0].reset();
        $('#department-name').focus();
      });
    });

    $(document).on('submit','#department_delete',function(e){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "<?php echo e(route('department-delete')); ?>",
          data: $('#department_delete').serialize(),
          success: function(data) {
              $('#departmentDelModal').modal('hide');
              $('.department-table').DataTable().ajax.reload();
          },
        });
      });

    $(document).on('keyup','#search_grid', function(e) {
      $('.department-table').DataTable().ajax.reload(); 
    });

    document.addEventListener('DOMContentLoaded', function () {
       document.getElementById('search_grid').placeholder = 'Search department..';
    }) 



</script>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rizwan/tpro/NDMS/resources/views/account/department.blade.php ENDPATH**/ ?>