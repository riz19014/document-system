@extends('layouts.layout')

@section('content_headerr')


                <!-- Page Content  -->
             @if($status_data->approval_status == 1)   
                <div id="content">
                      <div class="main-content-area">
                      <div class="accept-reject-form">
                        <div class="row justify-content-center">
                          <div class="col-md-6">
                            <div class="topicone text-center mb-4">
                              <i class="fas fa-file-alt"></i>
                            </div>
                            <h5 class="font-600 text-center mb-4">You have been asked to approve a documnet</h5>
          

                              <div class="mb-3">
                                <div class="input-group position-relative field-icon rounded border border-2">
                                  <input type="text" class="form-control bg-white border-end-0 border-0" value="" readonly="">
                                  <span class="field-text">{{$status_data->file->doc_name}}</span>
                                  <i class="fas fa-file-alt"></i>


                                  <a href="{{route('download-file',$status_data->file_id)}}" class="btn text-primary btn-download" type="button"><i class="fas fa-download"></i></a>


                              

                                <a href="{{asset('storage/'.$status_data->file->foldername->description.'/'.$status_data->file->doc_name)}}" class="btn text-primary btn-searchfile" type="button" data-lity><i class="far fa-file-alt"></i></a>   


    {{--<a class="btn text-primary btn-searchfile" type="button" data-lity data-lity-target="{{asset('storage/'.$status_data->file->foldername->description.'/'.$status_data->file->doc_name)}}"><i class="far fa-file-alt"></i></a>--}}





                                </div>
                              </div>
                              <div class="mb-3">
                                {{--<h6 class="mb-1 font-600 text-primary">Resolution</h6>
                                <p>Is this version ok?</p>--}}
                              </div>
                              <div class="mb-3">
                                <div class="border border-top-2"></div>
                              </div>
                              <div class="mb-5">
                                <h6 class="font-600 mb-3">Users in this approval workflow</h6>
                                @foreach($users as $user)
                                <div class="form-check">
                                  @if(Auth::user()->id == $user->User->id)
                                  <input class="form-check-input" type="radio" name="approval" id="acme" checked>
                                  @else
                                  <input class="form-check-input" type="radio" name="approval" id="acme" disabled>
                                    {{-- @if ($approval_status[0]['approval_status']==2)
                                        <h4>Aprroved</h4>
                                    @endif --}}
                                  @endif
                                  <label class="form-check-label" for="acme">
                                    {{$user->User->email}}
                                  </label>
                                </div>
                                @endforeach
                              </div>
                              <div class="mb-3">
                                <label>Comment</label>
                                <textarea class="form-control comField" name="comment" rows="6"></textarea>
                              </div>
                         
                              <div class="mb-3 text-center">
                                <button type="submit" value="2" class="btn btn-success btn-sm text-upppercase font-600 me-4 approve_btn">Approve</button>
                                <button type="button" value="3" class="btn btn-danger btn-sm text-upppercase font-600 reject_btn">Reject</button>
                              </div>



                              
                       
                          </div>
                        </div>                            
                      </div>
                    </div>
                  </div>

             @else


                <div id="content">              
                    <div class="main-content-area">
                      <div class="accept-reject-form">
                        <div class="row justify-content-center">
                          <div class="col-md-6">
                            <div class="topicone text-center mb-4">
                              <i class="fas fa-file-alt"></i>
                            </div>
                            <h5 class="font-600 text-center mb-4">You have been asked to approve a documnet</h5>
                              <div class="mb-3">
                                <div class="input-group position-relative field-icon rounded border border-2">
                                  <input type="text" class="form-control bg-white border-end-0 border-0" value="" readonly="">
                                  <span class="field-text">{{$status_data->file->doc_name}}</span>
                                     <i class="fas fa-file-alt"></i>

                                  <a href="{{route('download-file',$status_data->file_id)}}" class="btn text-primary btn-download" type="button"><i class="fas fa-download"></i></a>
                                <a href="{{asset('storage/'.$status_data->file->foldername->description.'/'.$status_data->file->doc_name)}}" class="btn text-primary btn-searchfile" type="button" data-lity><i class="far fa-file-alt"></i></a>   
                                </div>
                              </div>
                              {{--<div class="mb-3">
                                <h6 class="mb-1 font-600 text-primary">Resolution</h6>
                                <p>Is this version ok?</p>
                              </div>--}}
                              <div class="mb-3">
                                <div class="border-top border-top-2"></div>
                              </div>


                              <div class="mb-3">
                                <h6 class="font-600 mb-3 text-primary">Your Decision</h6>
                                <p class="mb-1"><strong>Comment</strong></p>
                                <p>{{$status_data->resolution}}</p>
                              </div>

                              <div class="mb-3">
                                <p class="mb-1"><strong>Status</strong></p>
                                @if($status_data->approval_status == 2) 
                                <p><i class="fas fa-check-circle text-success"></i> &nbsp;Approved</p>
                                @elseif($status_data->approval_status == 3) 
                                <p><i class="fas fa-times-circle text-danger"></i> &nbsp;Rejected</p>
                                @endif
                              </div>
                              <div class="mb-3">
                                <div class="border-top border-top-2"></div>
                              </div>


                              <div class="mb-3">
                                <h6 class="font-600 mb-3 text-primary">Resolution Result</h6>

                                 @if($status_data->approval_status == 2) 
                               <p><i class="fas fa-check-circle text-success"></i> &nbsp;Approved</p>
                                @elseif($status_data->approval_status == 3) 
                               <p><i class="fas fa-times-circle text-danger"></i> &nbsp;Rejected</p>
                                @endif   
                              </div>
                              <div class="mb-3">
                                <div class="border-top border-top-2"></div>
                              </div>
                              <div class="mb-3">
                                <h6 class="font-600 mb-3">Users in this approval workflow</h6>
                                 @foreach($users as $user)
                                <p>
                                  @if($status_data->approval_status == 2) 
                                  <i class="fas fa-circle text-success" title="Approved"></i>
                                  @elseif($status_data->approval_status == 3)
                                  <i class="fas fa-circle text-danger" title="Rejected"></i>
                                  @endif

                                  &nbsp; {{$user->User->email}}</p>
                                <div class="ms-3">
                                  <p class="mb-2"><i class="far fa-clock"></i>&nbsp; {{\Carbon\Carbon::parse($status_data->updated_at)->timezone('Asia/Karachi')->format('d M Y, H:i:s')}}</p>
                                  @if($status_data->resolution != null)
                                  <p class="mb-2"><i class="far fa-comment"></i>&nbsp; {{$status_data->resolution}}</p>
                                  @endif
                                </div>
                                @endforeach
                              </div>                
                          </div>
                        </div>                            
                      </div>
                    </div>
                  </div>
         @endif         


@endsection 


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">





 $(document).on('click', '.reject_btn', function(e){
e.preventDefault();
  btns = $('.reject_btn').val();
  comment = $('.comField').val();
  mfile= '{{$status_data->file_id}}';
swal({
    title: "Reject Document?",
    text: "Are you sure, you want to reject this document. ?",
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
          url: "{{ route('reso-status') }}",
         data: { file: mfile, btnstatus:btns, comment:comment },
          success: function(data) {

            // var url = '{{ route("reso-view", ":slug") }}';
            //     url = url.replace(':slug', data.fileId);
            var url = '{{ route("file-approval-history") }}';
            window.location =  url;

          },
        });
        }
    });
});


$(document).on('click', '.approve_btn', function(e){
e.preventDefault();
   btns = $('.approve_btn').val();
   comment = $('.comField').val();
   mfile= '{{$status_data->file_id}}';
swal({
    title: "Approve Document?",
    text: "Are you sure, you want to approve this document. ?",
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
          // type: "get",
          url: "{{ route('reso-status') }}",
         data: { file: mfile, btnstatus:btns, comment:comment},
          success: function(data) {
               // var url = '{{ route("reso-view", ":slug") }}';
               //  url = url.replace(':slug', data.fileId);
               var url = '{{ route("file-approval-history") }}';  
               window.location =  url;

          },
        });
        }
    });
});


</script>