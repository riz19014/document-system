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
                    <th>Location</th>
                    <th>Total section</th>
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
              {{csrf_field()}}

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
                 <select required id="company_id" class="form-control" name="company">
                    <option value="" disabled="" selected="">Select location</option>
                    @foreach ($companies as $company)
                     <option value="{{$company->id}}">{{$company->company_name}}</option>
                    @endforeach
                </select>
                </div>
            </div>

            <div class="mb-3" id="unit_company">
                <div class="form-group">
                    <select required id="unit_id" class="form-control" name="unit">
                        <option value="">Select unit</option>
                        <option v-for='unit in units' :value="unit.id">@{{ unit.unit_name }}
                        </option>
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
           {{csrf_field()}}
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


<div class="modal fade" id="viewSectionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Section list</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <div v-if="!!sections" class="table-responsive" id="view_department_section">
          <label style="color:red;" v-if="sections.length ==0">Sections are not created against this department</label>
          <table class="table" v-if="sections.length >0">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>created at</th>

                  </tr>
              </thead>
              <tbody>

                  <tr v-for="section in sections">
                      <td>@{{ section.name }}</td>
                      <td>@{{ section.created_at }}</td>
                  </tr>

              </tbody>
          </table>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection

 @section('js')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
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
            url:"{!! route('department-table-data') !!}",
            data: function(data) { 
               data.search_grid = $('#search_grid').val()
           },
            method: "get",
          },
          columns: [

              {data: 'name', name: 'name'},
              {data: 'unit', name: 'unit'},
              {data: 'company', name: 'company'},
              {data: 'total_section', name: 'total_section'},
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
          url: "{{ route('store-department') }}",
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
          url: "{{ route('department-delete') }}",
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

$(document).on('change', '#company_id', function(e) {
        e.preventDefault();
        $.ajax({
            type: "get",
            url: "{{ route('get-unit-company') }}",
            dataType: 'JSON',
            data: {
                company_id: $(this).val()
            },
            success: function(response) {
                unitData.units = response.units;
            },
        });
    });


$(document).on('click','.viewSection',function(e){
      e.preventDefault();
      $.ajax({
          url: "{{ route('get-department-sections') }}",
          type: 'get',
          dataType: 'JSON',
          data: {
              'department_id': $(this).data("id"),
          },
          success: function(response) {
            $('#viewSectionModal').modal('show');
            viewDepartmentSection.sections = response.sections;
              
          },
          error: function(response) {
              console.log(response);
          }
      });
      
    });

var unitData = new Vue({

        el: '#unit_company',
        data: {
            units: ''
        }

    });

var viewDepartmentSection = new Vue({

        el: '#view_department_section',
        data: {
            sections: ''
        }

    });
</script>

@endsection



