@extends('layouts.layout')

@section('content')


@section('content_header')

  @include('partials.title')

@endsection

<div id="content">
    <div class="breadcrumb-area mb-4">
      <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb"  >
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" onclick="return false;">Nishat</a></li>
            <li class="breadcrumb-item active" aria-current="page">company</li>
          </ol>
      </nav>
    </div>
  <div class="main-content-area">
      <div class="file-view-area">
        <div class="row">
            <div class="audit-logs">
              <p class="mb-2 text-primary font-600">company</p>
              <table class="table table-striped company-table" >
                <thead>
                  <tr>
                    <th>Location Name</th>
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


<!-- create company model -->

<div class="modal fade" id="companyAddModal" tabindex="-1" aria-labelledby="    exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Location</h5>
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


<!-- delete company model -->

<div class="modal fade" id="companyDelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <p>Are you sure you want to delete company?</p>
        <form id="company_delete" action="" method="post">
           {{csrf_field()}}
          <div class="mb-3">
            <div class="d-none" id='form-fname'><span id="error-fname" style="color: red"></span></div>
            <input type="hidden" name="company_id" id="companyDel" >
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

@endsection

 @section('js')

 <script type="text/javascript">


  /* ---- company list ----  */

  $(function () {
       var table = $('.company-table').DataTable({
       "paging": false,
       "ordering": false,
       "searching": false,
       "info": false,
       // "lengthChange": false
       language : {
          "zeroRecords": " "
      },
        ajax: {
            url:"{!! route('company-table-data') !!}",
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

  /* ---- company sotre ----  */

    $(document).on('submit','#company_form',function(e){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "{{ route('store-company') }}",
         data: $('#company_form').serialize(),
          success: function(data) {
            if(data.success){
              $('#companyAddModal').modal('hide');
              $('#company_form')[0].reset();
              $('.company-table').DataTable().ajax.reload();
            }else{
              $("#form-meta_name").removeClass('d-none');
              document.getElementById('error-meta_name').innerHTML = "Company name already exists.";
              setTimeout(function(){ $('#form-meta_name').addClass('d-none'); }, 4000);
            }

          },
        });
      });


  /* ---- company delete ----  */

    $(document).on('click','.delCompany',function(e){
      var name = $(this).data("name");
      $('#companyDel').val($(this).data("id"));
      $('#textTitle').html('"'+name+'"');
      $('#companyDelModal').modal('show');
    });

  /* ---- reset company create form ----  */

    $(document).ready(function(){
      $(document).on('shown.bs.modal','#companyAddModal', function () {
        $('#company_form')[0].reset();
        $('#company-name').focus();
      });
    });

  /* ---- delete company ----  */

    $(document).on('submit','#company_delete',function(e){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "{{ route('delete-company') }}",
          data: $('#company_delete').serialize(),
          success: function(data) {
              $('#companyDelModal').modal('hide');
              $('.company-table').DataTable().ajax.reload();
          },
        });
      });

  /* ---- search company ----  */

    $(document).on('keyup','#search_grid', function(e) {
      $('.company-table').DataTable().ajax.reload(); 
    });

    document.addEventListener('DOMContentLoaded', function () {
       document.getElementById('search_grid').placeholder = 'Search company..';
    }) 


</script>


@endsection
