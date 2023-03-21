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
                    <th>Location</th>
                    <th>Total Department</th>
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

            <div class="mb-3">
                <div class="form-group">
                 <select required id="company_id" class="form-control" name="company">
                    <option value="" disabled="" selected="">Select location</option>
                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>
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



<div class="modal fade" id="viewDepartmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Department list</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <div v-if="!!departments" class="table-responsive" id="view_unit_department">
          <label style="color:red;" v-if="departments.length ==0">Departments are not created against this unit</label>
          <table class="table" v-if="departments.length >0">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>created at</th>

                  </tr>
              </thead>
              <tbody>

                  <tr v-for="department in departments">
                      <td>{{ department.name }}</td>
                      <td>{{ department.created_at }}</td>
                  </tr>

              </tbody>
          </table>
      </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

 <?php $__env->startSection('js'); ?>
 <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
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
              {data: 'company', name: 'company'},
              {data: 'departments', name: 'departments'},
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


   $(document).on('click','.viewDepartment',function(e){
      e.preventDefault();
      $.ajax({
          url: "<?php echo e(route('get-unit-departments')); ?>",
          type: 'get',
          dataType: 'JSON',
          data: {
              'unit_id': $(this).data("id"),
          },
          success: function(response) {
            $('#viewDepartmentModal').modal('show');
            viewUnitDepartment.departments = response.departments;
              
          },
          error: function(response) {
              console.log(response);
          }
      });
      
    });

  /* ---- search unit ----  */

    $(document).on('keyup','#search_grid', function(e) {
      $('.unit-table').DataTable().ajax.reload(); 
    });

    document.addEventListener('DOMContentLoaded', function () {
       document.getElementById('search_grid').placeholder = 'Search unit..';
    }) 
   
   var viewUnitDepartment = new Vue({

        el: '#view_unit_department',
        data: {
            departments: ''
        }

    });

</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rizwan/tpro/NDMS/resources/views/account/unit.blade.php ENDPATH**/ ?>