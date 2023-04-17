@extends('layouts.layout')
@section('content')
@section('content_header')
@include('partials.title')
@endsection
               
    <!-- Page Content  -->
    <div id="content">
      <div class="breadcrumb-area mb-4">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#" onclick="return false;">{{Auth::user()->name}}</a></li>
              @foreach($parents as $folder)
               <li class="breadcrumb-item"><a href="{{route('folder-index',$folder->id)}}">{{$folder->description}}</a></li>
              @endforeach 
             
              {{--<li class="breadcrumb-item active" aria-current="page">Projects</li>--}}
            </ol>
          </nav>
        </div>


  <div class="main-content-area">

     @if(Auth::user()->role_id == 1)
    <div id="submit_file" class="uploads-files-area d-none">
      <div id="dropzone">
        <div class="user-image mb-3 text-center">
          <div class="imgGallery"> 
            <!-- Image preview -->
          </div>
        </div>

        <form class="form-horizontal" id="files_upload" enctype="multipart/form-data" action="" method="post">
        {{csrf_field()}}
          <div class="form-group" style="padding-bottom: 15px">                            
              
               <input required type="file" id="chooseFile" class="form-control" name="filenames[]" placeholder="address" multiple>

                <input type="hidden" name="FolderId" id="file_folder_id" value="asdf">

          </div>
           <button type="submit" class="btn btn-success" style="margin-top:10px">Submit</button>
        </form>



              </div>


            </div>

@endif

              <table class="table table-striped table-hover main-table" style="width:100%;">
                    
                    <thead>
                   
                        <tr>
                          <th class="noVis">
              <div class="custom-control custom-checkbox custom-checkbox1 d-inline-block">
                <input type="checkbox" class="custom-control-input check-all1" name="check_all" id="check-all">
                <label class="custom-control-label" for="check-all"></label>
              </div>
            </th>
                     
                            <th > Name </th>
                            <th > Date </th> 
                            <th > Due date </th> 
                            <th > Notes </th> 
                            <th > Size </th>
                            <th > Tags </th>
                            <th></th>
                            
                            

                        </tr>
                    
                    </thead>
                  <tbody>
                  </tbody>
                  
               </table>


          </div>

            
    

          

      </div>
   

 
        <!-- Columns Modal -->
<div class="modal fade" id="ColumnsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Meta-Tags for folder "{{$foldered->description}}"</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="column_Part" action="" method="post">
        {{csrf_field()}}
          <div class="mb-3">
            
            {{--<div>
        Toggle column: <a class="toggle-vis" data-column="0">CheckBox</a> - <a class="toggle-vis" data-column="1">Name</a> - <a class="toggle-vis" data-column="2">Date</a> - <a class="toggle-vis" data-column="3">Due date</a> - <a class="toggle-vis" data-column="4">Signature</a> - <a class="toggle-vis" data-column="5">Size</a> - <a class="toggle-vis" data-column="6">Tags</a>
    </div>--}}

@foreach($metaTagNames as $meta)

  <ul style="list-style: none;"><li>
            {{-- {{$metaTags->contains('folder_id',$foldered->id)}}
            {{ $foldered->id }} --}}
          {{-- {{ $meta->tagstatus[1]->folder_id }} --}}

      <div class="form-check">
            <input style="height: 35px;width: 40px;" class="form-check-input batchCheckbox" name="column_folder[]" type="checkbox" value="{{$meta->id}}" id="flexCheckDefault" {{($metaTags->contains('meta_tag_id',$meta->id)) ? 'checked' : ''}} />

          <label class="form-check-label" for="flexCheckDefault" style="font-size: 25px;padding-left: 0.4em;">
            {{$meta->tagging_name}}  
          </label>
      </div> 
    </li>
  </ul>
@endforeach 

  
            <input type="hidden" name="folder_id_col" id="col_folder_id" value="{{ $foldered->id }}" />
          </div>
          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary disbtn">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>            

        <!-- New Foldar Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Foldars</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="folder_part" action="" method="post">
        {{csrf_field()}}
          <div class="mb-3">
            <label>Foldar Name</label>
            <input type="text" name="foldar_name" id="fname" class="form-control">
            <div class="d-none" id='form-fname'><span id="error-fname" style="color: red"></span></div>
            <input type="hidden" name="folder_id" id="fid" value="">
          </div>
          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>         
            <!-- Page Content  -->
    


<div class="modal fade" id="FileRetentionModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit retention</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <small><h3 style="    font-size: 1.0rem;">You can choose to have files in this folder to be automatically move to recyle bin after certain time.
        </h3></small>
        <form id="file_retention" action="" method="post">
         @csrf
          <div class="mb-3">
            <div class="row">
            <div class="col-8">
              <input type="number" min="0" name="count_value" class="form-control" placeholder="After">
            </div>
            <div class="col-4">
              <select class="form-control" name="time_period">
                <option value="1">Days</option>
                <option value="2">Weeks</option>
                <option value="3">Months</option>
                <option value="4">Years</option>
              </select>
            </div>
           </div>
          
          </div>
          <div class="mb-3" >
            <input class="form-check-input" type="radio" name="approval" id="acme" checked> Move to Recycle Bin
          </div>
          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> 



<!-- create company model -->

<div class="modal fade" id="changeNameModal" tabindex="-1" aria-labelledby="    exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Name</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="company_form" action="" method="post">
              {{csrf_field()}}

            <div class="mb-3">
            <div class="form-group">
              <label>Location Name</label>
              <input required type="text" id="company-name" class="form-control" name="name">

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


    <style>
    .container {
      max-width: 450px;
    }
    .imgGallery img {
      padding: 8px;
      max-width: 100px;
    }    
  </style>


    @endsection 

     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      
    <script type="text/javascript">



  

 $(function () {
   valfol = '{{$folid}}';
    var table = $('.main-table').DataTable({
         
         "paging": false,
         "ordering": false,
         "searching": false,
         "info": false,
          fnDrawCallback: function (settings) {
        $(".main-table").parent().toggle(settings.fnRecordsDisplay() > 0);
    },
         // "lengthChange": false
         language : {
            "zeroRecords": " "             
        },
          ajax: {
              url:"{!! route('main-data') !!}",
                data: function(data) { 
              data.folderid = valfol;
           },

              method: "get",
            },
            columns: [
                { data: 'checkbox', name: 'checkbox' },
                {data: 'action', name: 'action'},
                {data: 'created_at', name: 'created_at'}, 
                {data: 'due_date', name: 'due_date'},
                // {data: 'signed_by', name: 'signed_by'},
                {data: 'notes', name: 'notes'},
                {data: 'filesize', name: 'filesize'},
                {data: 'tags', name: 'tags'},
                {data: 'listAction', name: 'listAction'},
                                           
            ]
        });

    //     $('a.toggle-vis').on( 'click', function (e) {
    //     e.preventDefault();
 
    //     // Get the column API object
    //     var column = table.column( $(this).attr('data-column') );
 
    //     // Toggle the visibility
    //     column.visible( ! column.visible() );
    // } );
        
      });




$(document).ready(function(){

$('#exampleModal').on('shown.bs.modal', function() {
    $('#fname').focus();
  })
});




$(document).on('click', '.btn-file', function () {
  $("#submit_file").removeClass('d-none');
  $("#chooseFile").click();
});

$(document).on('click', '.check-all1', function () {
    // alert('proceed to invoice');

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


$(document).on('click', '#folderdelete', function(){

   var selected_quots = [];
       var check_idd = 1;
      $("input.check1:checked").each(function() {
        selected_quots.push($(this).val());

         alert(selected_quots);
      });
});


$('.main-table').on('dblclick', 'td form input', function() {
    alert('caught')
});


$(document).on('submit','#file_retention',function(e){   
   e.preventDefault(); 

    var file_ids = [];
    $("input.check1:checked").each(function() {
      file_ids.push($(this).val());
    });
    let formData = new FormData(this); 
    formData.append('file_ids', file_ids);

    $.ajax({
         type: "POST",
         url: "{{ route('file-retention') }}",
         data: formData,
         contentType: false,
         processData: false,
        success: function(data) {
          $('.folderitem').removeClass('d-none');
          $('.checkitem').addClass('d-none');
          $("#FileRetentionModel").find("#file_retention")[0].reset();
          $('#FileRetentionModel').modal('hide');
          $('.main-table').DataTable().ajax.reload();

      },
    }); 

  });           



$(document).on('click', '.check1', function () {

    // $(this).removeClass('d-none');
       // $('.cancel-quotations').removeClass('d-none');
       // $('.revert-quotations').removeClass('d-none');

       

        var cb_length = $( ".check1:checked" ).length;
        var st_pieces = $(this).parents('tr').attr('data-pieces');

        if(this.checked == true){

          // alert(cb_length);

          
          $('.checkitem').removeClass('d-none');
         $('.folderitem').addClass('d-none');
             var selected_quots = [];
             var check_idd = 1;
            $("input.check1:checked").each(function() {
              selected_quots.push($(this).val());
            });

         // $.ajax({

         //  method:"get",
         //  dataType:"json",
         //  data: {quotations : selected_quots, check_id: check_idd },
         //  url:"{{ route('proceed-invoice-order') }}",
         //  success:function(result){
         //    if(result.status == 35){
         //      $('.cancel-quotations').removeClass('d-none');
         //      $('.proceed-invoice').addClass('d-none');
         //      $(this).parents('tr').addClass('selected');
         //    }
         //    if(result.status == 34){
         //     $('.cancel-quotations').removeClass('d-none');
         //     $('.proceed-invoice').removeClass('d-none');
         //     $(this).parents('tr').addClass('selected');
         //    }
         //    }
         //  });
         }else{

                


              $(this).parents('tr').removeClass('selected');
              if(cb_length == 0){

                 $('.checkitem').addClass('d-none');
                 $('.folderitem').removeClass('d-none');


               // $('.selected-item').addClass('d-none');
               $('.cancel-quotations').addClass('d-none');
               $('.proceed-invoice').addClass('d-none');
           }

       }

    });









$(document).ready(function () {
    // Multiple images preview with JavaScript
       var multiImgPreview = function(input, imgPreviewPlaceholder) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

      $('#chooseFile').on('change', function() {
        var fol_id = "{{$foldered->id}}";
      // alert(fol_id);
      $('#file_folder_id').val(fol_id);
        multiImgPreview(this, 'div.imgGallery');
      });
    }); 





      $(document).on('click', '#folderid', function(){
         document.getElementById("folder_part").reset();
          var edit_id = $(this).data('id');
          $('#fid').val(edit_id);
            // alert(edit_id);
         });  

         $(document).on('click', '#column_folder_id', function(){
            // $('.disbtn').prop('disabled', true);
           
          var folder_col_id = $(this).data('id');
          $('#col_folder_id').val(folder_col_id);
            // alert(folder_col_id);
         });


$(document).on('click', '.delete-folder', function(e){
e.preventDefault();
  var folder_id = $(this).data('id');
swal({
    title: "Delete Folder?",
    text: "Are you sure, you want to delete this folder. ?",
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
          url: "{{ route('delete-folder-section') }}",
         data: { folder_id: folder_id},
          success: function(data) {

             $('.main-table').DataTable().ajax.reload();

          },
        });
        }
    });
});


// $(document).ready(function(){
//          function validate() {
//     if (document.getElementById('LetterNeed').checked) {
//         $('.disbtn').prop('disabled', false);
//     } else {
//         $('.disbtn').prop('disabled', true);
//     }
// }

//    document.getElementById('LetterNeed').addEventListener('change', validate);
// });


       $(document).on('submit','#folder_part',function(e){   

             e.preventDefault(); 
             var folder = $('#fname').val();
            //  alert(folder);
            //  return false;
              if (folder.length<1) {
         $("#form-fname").removeClass('d-none');
          document.getElementById('error-fname').innerHTML = "Folder name is required. *";
         setTimeout(function(){ $('#form-fname').addClass('d-none'); }, 4000); 
    }
    if(folder.length<1){
        return false;
    }
        $.ajax({
          type: "POST",
          url: "{{ route('add-folder') }}",
         data: $('#folder_part').serialize(),
          success: function(data) {
            // alert('respose');
            $('#exampleModal').modal('hide');
            $('.main-table').DataTable().ajax.reload();


          },
        });
      });

       

    $(document).on('click','#change_folder_name',function(e){  
         var selected_quots = [];
          $("input.check1:checked").each(function() {
            selected_quots.push($(this).val());
          });
          alert(selected_quots.length);
    });



    $(document).on('submit','#files_upload',function(e){  

        var $fileUpload = $("input[type='file']");
        if (parseInt($fileUpload.get(0).files.length)>30){
         alert("You can only upload a maximum of 30 files");
         document.getElementById("files_upload").reset();
         return false
        }
      e.preventDefault();
      let formData = new FormData(this);  
    $.ajax({
        type: "POST",
        url: "{{ route('image-upload') }}",
       data: formData,
       contentType: false,
         processData: false,
        success: function(data) {
          document.getElementById("files_upload").reset(); 
          $("#submit_file").addClass('d-none');
             $('.main-table').DataTable().ajax.reload();
          },
        });

  });

  $(document).on('submit','#column_Part',function(e){   
        e.preventDefault(); 
        $.ajax({
        type: "POST",
        url: "{{ route('add-column-folder') }}",
        data: $('#column_Part').serialize(),
          // data: {
          //      'batch[]': getValueCheckbox(),
          //       '_token': $('input[name=_token]').val(),
          //     },
        success: function(data) {
        // alert('respose');
        $('#ColumnsModal').modal('hide');

        },
        });
        });     
    </script>     