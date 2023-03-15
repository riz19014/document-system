@extends('layouts.layout')

@section('content')


@section('content_header')
    @include('partials.title')
@endsection




<div id="content">


    <div class="breadcrumb-area mb-4">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" onclick="return false;">Nishat</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
            </ol>
        </nav>
    </div>


    <div class="main-content-area">
        <div class="file-view-area">
            <div class="row">

                <div class="audit-logs">
                    <p class="mb-2 text-primary font-600">User list</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Section</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->department ? $user->department->name : '--' }}</td>
                                    <td>{{ $user->section ? $user->section->name : '--' }}</td>
                                    <td>{{ $user->role->title }}</td>
                                    <td>
                                        <a onclick="if (confirm('Delete selected user?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                                            href="{{ route('delete-manage-user', $user->id) }}" style="cursor: pointer;"
                                            class="delUser" title="Delete User" data-id=""><i
                                                class="fas fa-trash trash-icon"></i></a>

                                        <a onclick="userID('{{$user->id}}')" data-bs-target="#changePasswordModal" data-bs-toggle="modal" href="#" style="cursor: pointer;margin-left: 5px"
                                            class="delUser" title="Change Password" data-id="">
                                            <i class="fas fa-edit trash-icon"></i></a>        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <div  class="row mr-2 ml-2">
              <button id="ChangePasswordMsgError" style="display: none" type="button" class="btn btn-lg btn-block btn-outline-danger mb-2"
                      >Your old password is wrong
              </button>
          </div>

          <div  class="row mr-2 ml-2">
              <button id="ChangePasswordMsgSucc" style="display: none" type="button" class="btn btn-lg btn-block btn-outline-danger mb-2"
              >Your old password is wrong
              </button>
          </div>

           <div class="row  d-flex justify-content-center " style="font: normal normal bold 24px/45px Cairo; color: #48c6ff">

    <p class="text-center">Change user's Password</p>

    </div>
          <form id="changPassForm">
              @csrf
        <input type="hidden" name="user_id" id="user_id">
        <div class="row mt-3 pl-3 pr-3 mr-3 ml-3 d-flex justify-content-center">
           <input id="password" type="password" class="form-control" placeholder="New Password">
            <small id="password_error" class="form-text text-danger"></small>
        </div>
        <div class="row mt-3 pl-3 pr-3 mr-3 ml-3 d-flex justify-content-center">
           <input id="password_confirmation" type="password" class="form-control" placeholder="Confirm New Password">
        </div>
          </form>

      </div>
      <div class="modal-footer pr-5 pt-5 pb-5">
       <button id="changePassword" type="button" class="btn btn-warning">Change</button>

      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New user
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="user_form_change_password" action="" method="post">
                    {{ csrf_field() }}

                    <div class="row">


                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <input required type="password" name="password" class="form-control"
                                    placeholder="Password">
                            </div>
                            <div class="d-none" id='form-meta_name'><span id="error-meta_name"
                                    style="color: red"></span></div>
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


<div class="modal fade" id="UserAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New user
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="user_form" action="" method="post">
                    {{ csrf_field() }}

                    <div class="row">

                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <input required type="text" id="first-name" class="form-control" name="fname"
                                    placeholder="first name">
                            </div>
                            <div class="d-none" id='form-meta_name'>
                                <span id="error-meta_name" style="color: red"></span>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <input required type="text" id="meta-name" class="form-control" name="lname"
                                    placeholder="last name">
                            </div>
                            <div class="d-none" id='form-meta_name'>
                                <span id="error-meta_name" style="color: red"></span>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <input required type="email" id="meta-name" class="form-control" name="email"
                                    placeholder="user email">
                            </div>
                            <div class="d-none" id='form-meta_name'><span id="error-meta_name"
                                    style="color: red"></span></div>
                        </div>


                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <input required type="password" name="password" class="form-control"
                                    placeholder="Password">
                            </div>
                            <div class="d-none" id='form-meta_name'><span id="error-meta_name"
                                    style="color: red"></span></div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <select required id="unit_id" class="form-control" name="unit">
                                    <option value="" disabled="" selected="">Select unit</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3" id="unit_department">
                            <div class="form-group">
                                <select required id="department_id" class="form-control" name="department">
                                    <option value="">Select department</option>
                                    <option v-for='department in departments' :value="department.id">
                                        @{{ department.name }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3" id="department_section">
                            <div class="form-group">
                                <select required id="section_id" class="form-control" name="section">
                                    <option value="">Select section</option>
                                    <option v-for='section in sections' :value="section.id">@{{ section.name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <select required id="roleId" class="form-control" name="role">
                                    <option value="" disabled="" selected="">Select role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->title }}</option>
                                    @endforeach
                                </select>
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



@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script type="text/javascript">
    $(document).on('submit', '#user_form', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('store-user') }}",
            data: $('#user_form').serialize(),
            success: function(data) {
                // alert('respose');
                $('#UserAddModal').modal('hide');
                $('#user_form')[0].reset();
                url: "{{ route('manage-users') }}",
                    location.reload();
            },
        });
    });


    $(document).ready(function() {
        $(document).on('shown.bs.modal', '#UserAddModal', function() {
            $('#user_form')[0].reset();
            $('#first-name').focus();
        });
    });

    $(document).on('change', '#unit_id', function(e) {
        e.preventDefault();
        $.ajax({
            type: "get",
            url: "{{ route('get-unit-departments') }}",
            dataType: 'JSON',
            data: {
                unit_id: $(this).val()
            },
            success: function(response) {
                departmentData.departments = response.departments;
            },
        });
    });

    $(document).on('change', '#department_id', function(e) {
        e.preventDefault();
        $.ajax({
            type: "get",
            url: "{{ route('get-department-sections') }}",
            dataType: 'JSON',
            data: {
                department_id: $(this).val()
            },
            success: function(response) {
                sectionData.sections = response.sections;
            },
        });
    });


    var departmentData = new Vue({

        el: '#unit_department',
        data: {
            departments: ''
        }

    });

    var sectionData = new Vue({

        el: '#department_section',
        data: {
            sections: ''
        }

    });

    $(document).on('click', '#changePassword', function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var password = $('#password').val();
        var passwordConfirmation = $('#password_confirmation').val();

        $.ajax({
            type: 'post',
            url: "{{route('user-changePassword')}}",
            data:{
                userId:$("#user_id").val(),
                password:password,
                password_confirmation:passwordConfirmation
            },
            cache: false,
            success: function (response){

                if(response.status===true){
                    $("#ChangePasswordMsgSucc").text(response.msg);
                    $("#ChangePasswordMsgSucc").css("display", "block");
                    setTimeout(function(){ 
                        $("#ChangePasswordMsgSucc").css("display", "none"); 
                        $('#changePasswordModal').modal('hide');
                    }, 1000);
                }
                if(response.status===false){
                    $("#ChangePasswordMsgError").text(response.msg);
                    $("#ChangePasswordMsgError").css("display", "block");
                    setTimeout(function(){ $("#ChangePasswordMsgError").css("display", "none"); }, 4000);
                }

            }, error: function (reject){
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function(key, val){
                    $("#" + key + "_error").text(val[0]);
                });
            }
        });
    });

    function userID(id){
        $("#user_id").val(id);
    }


</script>
@endsection
