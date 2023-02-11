<?php $__env->startSection('content_header'); ?>
<?php echo $__env->make('partials.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Page Content  -->
    <div id="content">
      <div class="breadcrumb-area mb-4">
      <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#" onclick="return false;">Nishat</a></li>
              <li class="breadcrumb-item active" aria-current="page">Metadata</li>
            </ol>
          </nav>
        </div>
          <table class="table table-striped table-hover meta-table">
            <thead>
                <tr>
                  <th >Name </th>
                  <th > Actions </th>
                </tr>
            </thead>
          </table>
        </div>

<!-- New Section Modal -->

<div class="modal fade" id="MetaexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New metadata field</h5>
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

                 <!--Edit Modal -->
<div class="modal fade" id="metaModaledit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md " role="dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit metadata field</h5>
        <button id="btnCloseModal" type="button" class="btn-close pedit" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert alert-success d-none" id='form-messages_emp'></div>
      <div class="alert alert-danger d-none" id='form-messages_error'></div>
      <div class="modal-body">
          <form class="form-horizontal" id="form_package_edit" method="post" novalidate="novalidate">

            <?php echo e(csrf_field()); ?>


            <div class="mb-3">
            <input type="text" name="meta_name" id="edit_meta" class="form-control">
            <div class="d-none" id='form-fname' ><span id="error-fname" style="color: red"></span></div>
            <input type="hidden" name="meta_id" id="meta_edit_id">
          </div>

          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary submit-btn">Save</button>
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

$(document).ready(function () {
  $('#MetaexampleModal').on('shown.bs.modal', function() {
    $('#meta-name').focus();
  })
});


$(function () {
var table = $('.meta-table').DataTable({

     "paging": false,
     "ordering": false,
     "searching": false,
     "info": false,
     // "lengthChange": false
     language : {
        "zeroRecords": " "
    },
      ajax: {
          url:"<?php echo route('meta-table'); ?>",
          method: "get",
        },
        columns: [
            {data: 'tagging_name', name: 'tagging_name'},
            {data: 'action', name: 'action'},

        ]
    });

  });


        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });

        $('.sub-menu ul').hide();
        $(".sub-menu a").click(function () {
          $(this).parent(".sub-menu").children("ul").slideToggle("100");
          $(this).find(".right").toggleClass("fa-chevron-right fa-chevron-down");
        });
        $("#dropzone").dropzone({ url: "/file/post" });


         // $(document).on('click','#sinfo',function(){
         //    alert('here');
         //    var edit_id = $(this).data('id');
         //    alert(edit_id);

         // });




          $(document).on('click', '#sectionId', function(){
               $("#createnewsection").find("#section_part")[0].reset();
         });


  // $(document).on('click', '#form_package_edit', function(e){
  //     e.preventDefault();
  //      $.ajax({
  //         url: "<?php echo e(route('edit-meta-form')); ?>",
  //         method: 'post',
  //         data: $('#form_package_edit').serialize(),

  //         success: function(data){
  //           $('#metaModaledit').modal('hide');
  //           alert(data)
  //            $("#btnCloseModal").trigger('click');

  //           // $('.meta-table').DataTable().ajax.reload();

  //         },
  //       });
  //   });


  $(document).on('click','#editmeta',function(e){
           var id = $(this).data("id");
           $('#meta_edit_id').val(id);
           var name = $(this).data("name");
           $('#edit_meta').val(name);
         });


    $(document).on('click', '.submit-btn', function(e){
          e.preventDefault();
              $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

          $.ajax({
                url: "<?php echo e(route('edit-meta-form')); ?>",
                method: 'post',
                data: $('#form_package_edit').serialize(),
                success: function(data) {
                  $('#metaModaledit').removeClass('show');
                  $( '.modal-backdrop' ).remove();
                  $('.meta-table').DataTable().ajax.reload();
                }
            });
        });


         $(document).on('click','#deletemeta',function(e){
          meta_id = $(this).data("id");
          meta_name = $(this).data("name");
          e.preventDefault();
              $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

          $.ajax({
                url: "<?php echo e(route('delete-meta')); ?>",
                method: 'post',
                data: {meta_id:meta_id,meta_name:meta_name},
                success: function(data) {
                  $('.meta-table').DataTable().ajax.reload();
                }
            });

         });


        $(document).on('submit','#meta_form',function(e){
        e.preventDefault();
             $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
             var meta_name = $('#meta-name').val();
              if (meta_name.length<1) {
         $("#form-meta_name").removeClass('d-none');
          document.getElementById('error-meta_name').innerHTML = "Meta name is required. *";
         setTimeout(function(){ $('#form-meta_name').addClass('d-none'); }, 4000);
    }
    if(meta_name.length<1){
        return false;
    }
        $.ajax({
          type: "POST",
          url: "<?php echo e(route('add-meta')); ?>",
         data: $('#meta_form').serialize(),
          success: function(data) {
            // alert('respose');
            $('#MetaexampleModal').modal('hide');
            $('#meta_form')[0].reset();
            $('.meta-table').DataTable().ajax.reload();


          },
        });
      });


    </script>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rizwan/tpro/NDMS/resources/views/meta/index.blade.php ENDPATH**/ ?>
