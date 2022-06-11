@extends('layouts.layout')

@section('content')


@section('content_header')

  @include('partials.title')

@endsection



<div id="content">

	  <div class="breadcrumb-area mb-4">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#" onclick="return false;">{{Auth::user()->name}}</a></li>       
                      <li class="breadcrumb-item active" aria-current="page">History</li>
                    </ol>
                  </nav>
                </div>

             <div class="main-content-area">
                      <div class="file-view-area">
                        <div class="row">
                          <div class="col-lg-12">


                            <div class="audit-logs">
                              <p class="mb-2 text-primary font-600">Approval History</p>
                              <table  class="table table-striped" id="table_data">
                                <thead>
                                  <tr>
                           
                                    <th>Name</th>
                                    <th>Approval status</th>
                                    <th>My decision</th>
                                    <th>Remarks</th>
                                    <th>Approval time</th>
 
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($files as $file)
                                  <tr>
                                    <td>
                                      @if($file->approval_status == 1)
                                      <span style="background-color: #fabd17;" class="status-ball" title="Pending"></span>
                                      @elseif($file->approval_status == 2)
                                       <span style="background-color: #00aa00;" class="status-ball" title="Approved"></span>

                                      @elseif($file->approval_status == 3)
                                       <span style="background-color: #cc0000;" class="status-ball" title="Rejected"></span>

                                      @endif

                                      <a href="{{route('reso-view',$file->id)}}">{{$file->file->doc_name}}</a>
                                    </td>
                                    <td>


                                      @if($file->approval_status == 1)
                                        Pending
                                      @elseif($file->approval_status == 2)
                                       
                                       Approved
                                      @elseif($file->approval_status == 3)
                                      
                                       Rejected
                                      @endif

                                    </td>
                                    <td>
                                      
                                        @if($file->approval_status == 2)
                                        Approved
                                      @elseif($file->approval_status == 3)
                                       
                                       Rejected
                                      @endif


                                    </td>
                                     <td>{{$file->resolution}}</td>
                                     <td style="display:block; box-sizing:border-box; clear:both">
                                      {{$file->approval_date != null ? $file->approval_date->format('d M Y | h:i A') :'--' }}
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
</div>




<div class="modal fade" id="StatusModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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








