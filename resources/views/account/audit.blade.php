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
              <li class="breadcrumb-item active" aria-current="page">Account-Audit</li>
            </ol>
          </nav>
    </div>


   <div class="main-content-area">
        <div class="file-view-area">
          <div class="row">
              <div class="audit-logs">
                <p class="mb-2 text-primary font-600">Audits</p>
                <table class="table table-striped audit-table" >
                  <thead>
                    <tr>
                      <th>Sr #</th>
                      <th>Time</th>
                      <th>User</th>
                      <th>Object type</th>
                      <th>Object</th>
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

@endsection



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">



  $(function () {
var table = $('.audit-table').DataTable({

     "paging": false,
     "ordering": false,
     "searching": false,
     "info": false,
     // "lengthChange": false
     language : {
        "zeroRecords": " "
    },
      ajax: {
          url:"{!! route('audit-table-data') !!}",
          method: "get",
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'date', name: 'date'},
            {data: 'user', name: 'user'},
            {data: 'obj_type', name: 'obj_type'},
            {data: 'object', name: 'object'},
            {data: 'action', name: 'action'},

        ]
    });

  });



</script>










