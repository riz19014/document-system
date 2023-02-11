@extends('layouts.layout')

@section('content')


@section('content_header')

  @include('partials.title')

@endsection




<div id="content">


	  <div class="breadcrumb-area mb-4">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#" onclick="return false;">Nishat</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
                    </ol>
                  </nav>
                </div>


             <div class="main-content-area">
                      <div class="file-view-area">
                        <div class="row">
                          <div class="col-lg-9">

                            <div class="audit-logs">
                              <p class="mb-2 text-primary font-600">User list</p>
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                	@foreach ($users as $user)
                                  <tr>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->role->title}}</td>
                                    <td><a style="cursor: pointer;" class="delUser" title="Delete User" data-id=""><i class="fas fa-trash trash-icon"></i></a></td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
</div>




<div class="modal fade" id="UserAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New user
</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="user_form" action="" method="post">
            {{csrf_field()}}

          <div class="mb-3">
          <div class="form-group">
            <input required type="text" id="meta-name" class="form-control" name="fname" placeholder="first name">
          </div>
            <div class="d-none" id='form-meta_name'><span id="error-meta_name" style="color: red"></span></div>
          </div>

          <div class="mb-3">
          <div class="form-group">
            <input required type="text" id="meta-name" class="form-control" name="lname" placeholder="last name">
          </div>
            <div class="d-none" id='form-meta_name'><span id="error-meta_name" style="color: red"></span></div>
          </div>

          <div class="mb-3">
          <div class="form-group">
            <input required type="email" id="meta-name" class="form-control" name="email" placeholder="user email">
          </div>
            <div class="d-none" id='form-meta_name'><span id="error-meta_name" style="color: red"></span></div>
          </div>

           <div class="mb-3">
          <div class="form-group">
            <input required type="password" name="password" class="form-control" placeholder="Password" >
          </div>
            <div class="d-none" id='form-meta_name'><span id="error-meta_name" style="color: red"></span></div>
          </div>
          <div class="mb-3">
              <div class="form-group">
               <select required id="section_id" class="form-control" name="section">
                  <option value="" disabled="" selected="">Select section</option>
                  @foreach ($sections as $section)
                   <option value="{{$section->id}}">{{$section->name}}</option>
                  @endforeach
              </select>
              </div>
          </div>
          <div class="mb-3">
          <div class="form-group">
      	     <select required id="roleId" class="form-control" name="role">
                <option value="" disabled="" selected="">Select role</option>
                @foreach ($roles as $role)
                 <option value="{{$role->id}}">{{$role->title}}</option>
                @endforeach
            </select>
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



@endsection

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">


    $(document).on('submit','#user_form',function(e){
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

</script>










