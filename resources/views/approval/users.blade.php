@extends('layouts.layout')

@section('content')


@section('content_header')

  @include('partials.title')

@endsection


 <div class="right-btns">
    <a data-bs-toggle="modal" data-bs-target="#ApprovalModal" href="#" class="btn btn-primary ">Add Approval Users</a>
 </div>

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



                            <div class="audit-logs">
                              <p class="mb-2 text-primary font-600">User list</p>
                              <table class="table table-striped"  id="table_data">
                                <thead>
                                  <tr>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>position</th>
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




<div class="modal fade" id="ApprovalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New user
</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="invite_user" action="" method="post">
            {{csrf_field()}}

          <div class="mb-3">
          <div class="form-group">
          	 <select  id="roleId" class="form-control" name="email">
                  <option value="" selected="" disabled>choose type</option>
                  @foreach ($users as $user)
                   <option value="{{$user->id}}">{{$user->email}}</option>
                  @endforeach
              </select>
                          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Invite</button>
          </div>
          </div>
            <div class="d-none" id='form-meta_name'><span id="error-meta_name" style="color: red"></span></div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>



@endsection



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">



$(function () {
var table = $('#table_data').DataTable({

     "paging": false,
     "ordering": false,
     "searching": false,
     "info": false,
     // "lengthChange": false
     language : {
        "zeroRecords": " "
    },
      ajax: {
          url:"{!! route('user-invite-table') !!}",
          method: "get",
        },
        columns: [

            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'position', name: 'position'},
            {data: 'action', name: 'action'},

        ]
    });

  });

$(document).on('click','.delUser',function(e){
     e.preventDefault();
      var user_id = $(this).data('id');
        $.ajax({
          type: "get",
          url: "{{ route('delete-user') }}",
         data: {userid:user_id},
          success: function(data) {
            $('#table_data').DataTable().ajax.reload();

          },
        });


});


    $(document).on('submit','#invite_user',function(e){
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: "{{ route('invite-user') }}",
         data: $('#invite_user').serialize(),
          success: function(data) {
            // alert('respose');
            $('#ApprovalModal').modal('hide');
            $('#invite_user')[0].reset();
            $('#table_data').DataTable().ajax.reload();



          },
        });
      });

</script>










