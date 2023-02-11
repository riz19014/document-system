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
                      @foreach($parents as $folder)
                       <li class="breadcrumb-item"><a href="{{route('folder-index',$folder->id)}}">{{$folder->description}}</a></li>
                      @endforeach

                      <li class="breadcrumb-item">{{$file->doc_name}}</li>

                      {{--<li class="breadcrumb-item active" aria-current="page">Projects</li>--}}
                    </ol>
                  </nav>
                </div>
             <div class="main-content-area">
                      <div class="file-view-area">
                        <div class="row">
                          <div class="col-lg-9">
                            <div class="img-icon mb-3">
                              {{--<i class="far fa-images"></i>&nbsp;&nbsp; <a href="#">Screenshot from 2021-07-28 23-20-40.png</a>--}}





                        @if(strpos($file->doc_name, '.png') || strpos($file->doc_name, '.jpg')
                        || strpos($file->doc_name, '.jpeg') || strpos($file->doc_name, '.svg'))



                        <a title="View" href="{{asset('storage/'.$fname->description.'/'.$file->doc_name)}}" data-lity><i class='fas fa-images'></i>&nbsp;&nbsp;</a>


                        @elseif(strpos($file->doc_name, '.odt') || strpos($file->doc_name, '.txt'))

                         <i class='fas fa-file-alt'></i>&nbsp;&nbsp;



                           <a href="" data-lity data-lity-target="{{asset('storage/'.$fname->description.'/'.$file->doc_name)}}">Image</a>
                        @else
                        <a title="View" href="{{asset('storage/'.$fname->description.'/'.$file->doc_name)}}" data-lity><i class='fas fa-file-alt'></i>&nbsp;&nbsp;</a>



                         @endif
                         <a href="{{route('download-file',$file->id)}}">

                            {{$file->doc_name}}</a>
                            </div>


                            @if($approve_status== 0)
                              <div class="mb-4">
                                <p class="mb-0 text-danger font-600">File is under approval!</p>
                              </div>
                            @endif

                            @if($file->file_locked == 1)
                              <div class="mb-4">
                                <p class="mb-0 text-danger font-600">File is locked!</p>
                              </div>
                            @endif



                                <div class="mb-4">
                                  <p class="mb-0 text-primary font-600">Notes</p>
                                  <p class="mb-0">{{$file->note}}</p>
                                </div>


                                <div class="mb-4">
                                  <p class="mb-0 text-primary font-600">Tags</p>
                                  <p class="mb-0">{{$file->tags}}</p>
                                </div>


                                 <div class="mb-4">
                                  <p class="mb-0 text-primary font-600">Signed by</p>
                                  <p class="mb-0">{{$file->signed_by}}</p>
                                </div>



                            <div class="row">
                              <div class="col-md-4">
                                <div class="mb-4">
                                  <p class="mb-0 text-primary font-600">Document ID</p>
                                  <p class="mb-0">{{$file->id}}</p>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <p class="mb-0 text-primary font-600">Date</p>
                                <p class="mb-0">
                                  @if($file->date != null)
                                  {{ \Carbon\Carbon::parse( $file->date )->format('Y-m-d') }}
                                  @endif

                                </p>
                              </div>
                              <div class="col-md-4">
                                <p class="mb-0 text-primary font-600">Due Date</p>
                                <p class="mb-0">
                                  @if($file->date != null)
                                  {{ \Carbon\Carbon::parse( $file->due_date )->format('Y-m-d') }}
                                  @endif
                              </p>
                              </div>
                            </div>






                                @if($fileScans->isEmpty())

              @foreach($folcols as $fol)



          <div class="mb-4">
                                  <p class="mb-0 text-primary font-600">{{$fol->tagname->tagging_name}}</p>
                                </div>



        @endforeach

      @else

           @foreach($fileScans as $fileScan)


         <div class="mb-4">
                                  <p class="mb-0 text-primary font-600">{{$fileScan->metaname->tagging_name}}</p>
                                  <p class="mb-0">{{$fileScan->meta_tag_value}}</p>
                                </div>



        @endforeach
        @endif




                            {{--<div class="row">
                              <div class="col-md-4">
                                <div class="mb-4">
                                  <p class="mb-0 text-primary font-600">ORC language</p>
                                  <p class="mb-0">123456789</p>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <p class="mb-0 text-primary font-600">Document Number</p>
                              </div>
                            </div>
                            <p class="mb-5 text-primary font-600">Covid</p>
                            <p class="mb-2 text-primary font-600">Related Files</p>
                            <div class="related-files mb-5">
                              <a href="#"><i class="far fa-images"></i>&nbsp;&nbsp; Screenshot from 2021-07-28 23-20-40.png</a>
                            </div>--}}
                            <div class="audit-logs">
                              <p class="mb-2 text-primary font-600">Audit Log</p>
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Time</th>
                                    <th>User</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>


                                @foreach($file_audits as $audit)
                                  <tr>
                                    <td>{{$audit->date}}</td>
                                    <td>{{$audit->User->email}}</td>
                                    <td>

                                      {{$audit->action}}

                                    </td>
                                  </tr>
                                    @endforeach

                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="reminder-area">
                              <h6 class="text-primary font-600 mb-3">Reminders:</h6>
                              <ul class="p-0 m-0 list-unstyled reminders">
                                <li class="justify-content-between d-flex">
                                  <a href="#">2021-08-25 @ 16:26</a>
                                  <a href="#"><i class="fas fa-trash"></i></a>
                                </li>
                                <li><a href="#" data-bs-toggle="modal" data-bs-target="#reminders-modal"><i class="far fa-bell"></i>&nbsp; Add New Reminder</a></li>
                              </ul>
                              {{--<div class="shared-to mb-4">
                                <h6 class="text-primary font-600 mb-3 mt-3">Shared To:</h6>
                                <a href="#"><i class="fas fa-share-alt"></i>&nbsp; Edit</a>
                              </div>--}}
                              <div class="Retention">
                                <h6 class="text-primary font-600 mb-0 mt-3">Retention:</h6>
                                @if($retention_end != null)
                                <a href="javascript:void(0);"><i class="fas fa-history"></i>&nbsp;  Moved to the Recycle Bin at
                                  {{$retention_end}}
                                </a>
                                @else
                                 <a href="javascript:void(0);"><i class="fas fa-clock"></i>&nbsp;
                                  Infinite
                                </a>

                                @endif
                              </div>
                            </div>
                            <div class="right-btns">
                              {{-- <a  id="lock_file" data-id="{{$file->id}}" data-bs-toggle="modal" data-bs-target="#filedelModal" href="#"><i class="fas fa-trash"></i><br> Delete</a> --}}
                              @if ($approve_status== 1)

                                  @if ($file->file_locked==0)
                                   <a href="#" id="lock_file" class="btn btn-primary btn-sm d-block font-600 mb-3" data-bs-toggle="modal" data-bs-target="#filelockModal" data-id="{{$file->id}}">Lock File</a>
                                  @elseif ($file->file_locked==1)
                                    <a href="#" id="unlock_file" class="btn btn-primary btn-sm d-block font-600 mb-3" data-bs-toggle="modal" data-bs-target="#fileunlockModal" data-id="{{$file->id}}">Unlock File</a>
                                  @endif

                              @endif




                                @if ($file->file_locked==0)
                                <a id="update_file" class="btn btn-primary btn-sm d-block font-600 mb-3"href="#" data-bs-toggle="modal" data-bs-target="#fileupdateModal" data-id="{{$file->id}}" >Upload New Version</a>
                                @endif


                                <a href="#" class="btn btn-primary btn-sm d-block font-600 mb-3">View Approval Workflow</a>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
</div>

<!-- end view Content part  -->


   <div class="modal fade" id="filedelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <p>Are you sure you want to delete this file?</p>
        <form id="file_delete" action="" method="post">
        {{csrf_field()}}
          <div class="mb-3">
            <div class="d-none" id='form-fname'><span id="error-fname" style="color: red"></span></div>
            <input type="hidden" name="file_del" id="FileDel" value="">
            <div class="big" style="font-size: 2.2rem;">"{{$file->doc_name}}"</div>
          </div>
          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


{{-- File update model --}}
<div class="modal fade" id="filelockModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <p>Are you sure you want to lock this file?</p>
        <form id="file_lock" action="" method="post">
        {{csrf_field()}}
          <div class="mb-3">
            <div class="d-none" id='form-fname'><span id="error-fname" style="color: red"></span></div>
            <input type="hidden" name="file_id" id="FileLock" value="{{$file->id}}">
            <div class="big" style="font-size: 2.2rem;">"{{$file->doc_name}}"</div>
          </div>
          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Lock</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- File update model --}}
<div class="modal fade" id="fileunlockModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <p>Are you sure you want to unlock this file?</p>
        <form id="file_unlock" action="" method="post">
        {{csrf_field()}}
          <div class="mb-3">
            <div class="d-none" id='form-fname'><span id="error-fname" style="color: red"></span></div>
            <input type="hidden" name="file_id" id="FileUnlock" value="{{$file->id}}">
            <div class="big" style="font-size: 2.2rem;">"{{$file->doc_name}}"</div>
          </div>
          <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Unlock</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


{{-- File update model --}}
<div class="modal fade" id="fileupdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style=" text-align: left;">
        <h4>Update file</h4>
        <div class="user-image mb-3 text-center">
          <div id="imgGallery">
            <img id="img" width="100" height="100"/>
          </div>
        </div>
        <form class="form-horizontal" id="file_update" enctype="multipart/form-data"  method="post">
          {{csrf_field()}}
            <div class="form-group" style="padding-bottom: 15px">
              <input type="file" class="form-control" id="chooseFile" name="image"
              onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])
              ">
                <input type="hidden" name="file_id" id="FileUpdate" value="{{$file->id}}">
                <input type="hidden" name="folder_des" id="FolderDes" value="{{$folder->description}}">


            </div>
             <button type="submit" class="btn btn-success" style="margin-top:10px">Submit</button>
          </form>
      </div>
    </div>
  </div>
</div>

@endsection



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">


       $(document).on('click', '#file_id', function(){
          var file_del_id = $(this).data('id');
          // alert(file_del_id);
          $('#FileDel').val(file_del_id);
         });




    $(document).on('submit','#file_lock',function(e){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "{{ route('file-lock') }}",
         data: $('#file_lock').serialize(),
          success: function(data) {
            $('#filelockModal').modal('hide');
              location.reload();
          },
        });
      });


      $(document).on('submit','#file_unlock',function(e){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "{{ route('file-unlock') }}",
         data: $('#file_unlock').serialize(),
          success: function(data) {
            $('#fileunlockModal').modal('hide');
            location.reload();
          },
        });
      });

      $(document).on('submit','#file_update',function(e){
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
          type: "POST",
          data: formData,
          url: "{{ route('file-update') }}",
          contentType: false,
         processData: false,
          success: function(data) {
            $('#fileupdateModal').modal('hide');
            location.reload();
          },
        });
      });



  $(document).on('submit','#file_delete',function(e){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "{{ route('file-delete') }}",
         data: $('#file_delete').serialize(),
          success: function(data) {
            $('#filedelModal').modal('hide');
            window.location.href = "/folder/index/"+data.folderid;

          },
        });
      });


      // $('#chooseFile').on('change', function() {
      //   $("#imgGallery").removeClass('d-none');
      // });
      // $(document).on('click', '.btn_update-file', function () {
      //   $("#chooseFile").click();
      // });


</script>
