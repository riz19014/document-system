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
                      <li class="breadcrumb-item"><a href="#" onclick="return false;">Softpyramid</a></li>
                      @foreach($parents as $folder)
                       <li class="breadcrumb-item"><a href="{{route('folder-index',$folder->id)}}">{{$folder->description}}</a></li>
                      @endforeach 

                      <li class="breadcrumb-item"><a href="{{route('file-view',$file->id)}}">{{$file->doc_name}}</a></li>
                     
                      {{--<li class="breadcrumb-item active" aria-current="page">Projects</li>--}}
                    </ol>
                  </nav>
                </div>


        


          <div class="main-content-area">
                      <div class="file-view-area">
                        <div class="row">
                          <div class="col-lg-9">
                            <div class="img-icon mb-0">



                              <i class="fas fa-images"></i>&nbsp;&nbsp; <a href="#">{{$file_name}}</a>



                            </div>
                            <p class="mb-4 text-primary font-400">Upload new version</p>
                            <div class="edit-form-file">
                              <form action="" method="" id="folder_file">
                                {{csrf_field()}}
                                <div class="mb-4">
                                  <label class="font-600 text-primary">Name</label>
                                  <div class="input-group mb-3">
                                     <input type="text" id="docname" name="doc_name" value="{{$file_name}}" class="form-control">
                                    <span class="input-group-text" id="basic-addon1">.{{$file_ext}}</span>
                                       <input type="hidden" name="file_ext" value=".{{$file_ext}}">
                                       <input type="hidden" name="file_id" value="{{$fileid}}">
                                  </div>
                                </div>
                                  <div class="mb-4">
                                  <label class="font-600 text-primary">Tags</label>
                                  <div class="input-group mb-3">
                                   <input type="text" id="docname" name="doc_tag" value="{{$file->tags}}" class="form-control" />
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-4">
                                      <label class="font-600 text-primary">Date</label>
                                      <input type="date" name="date" class="form-control" @if($file->date != null)
                                      value ={{ \Carbon\Carbon::parse( $file->date )->format('Y-m-d') }}
                                      @endif/>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-4">
                                      <label class="font-600 text-primary">Due Date</label>
                                      <input type="date" name="due_date" class="form-control" @if($file->date != null)
                                      value = {{ \Carbon\Carbon::parse( $file->due_date )->format('Y-m-d') }}
                                      @endif>
                                    </div>
                                  </div>
  
                                  <div class="col-md-12">
                                    <div class="mb-4">
                                      <label class="text-primary font-600" >Notes</label>
                                      <textarea class="form-control" name="note" id="note" rows="3">{{$file->note}}</textarea>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <p class="text-primary font-600 mb-0">Custom Metadata Fields</p>
                                      <label class="text-primary">Manage all metadata fields</label>
                                  </div>

                                  @if($editfiles->isEmpty()) 
                                  @foreach($editcols as $editcol) 
                                  
                                  <div class="col-md-6">
                                    <div class="mb-3">
                                      <span class="form-control metavalue">{{$editcol->tagname->tagging_name}}</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3">
                                      <input type="text" id="docname" name="meta[{{$editcol->meta_tag_id}}]" class="form-control" />
                                    </div>
                                  </div>
                                  @endforeach 
                                  @else
                                   @foreach($editfiles as $editfile)

                                      <div class="col-md-6">
                                    <div class="mb-3">
                                      <span class="form-control metavalue">{{$editfile->metaname->tagging_name}}</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3">
                                      <input type="text" id="docname" name="meta[{{$editfile->meta_tag_id}}]" value="{{$editfile->meta_tag_value}}" class="form-control" />
                                    </div>
                                  </div>

                                  @endforeach
                                  @endif



                                </div>
                                <div class="row moveonright">
                                  <div class="col-md-3">
                                    <a class="btn btn-primary font-600 text-uppercase d-block cancelbtn" href="{{route('file-view',$file->id)}}">
                                        Cancel
                                    </a>
                                  </div>
                                  <div class="col-md-4">
                                    <button class="btn btn-primary font-600 text-uppercase d-block w-100">Save</button>
                                  </div>
                                </div>

                              </form>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>


@endsection 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">



     $(document).on('submit','#folder_file',function(e){  
        e.preventDefault(); 
        $.ajax({
          type: "POST",
          url: "{{ route('edit-file-form') }}",
         data: $('#folder_file').serialize(),
          success: function(data) {
            // alert(data.fileid);
            $('#exampleModal').modal('hide');
              window.location.href = "/file/view/"+data.fileid;

          },
        });
      });




  $(document).on('click', '#send_btn', function(){
       value = 34;
       
         $.ajax({
      url: "{{ route('edit-file-form')}}",
      method: 'post',
      data: $('#contact_us').serialize(),

      success: function(response){
         //------------------------
            $('#send_form').html('Submit');
            $('#res_message').show();
            $('#res_message').html(response.msg);
            $('#msg_div').removeClass('d-none');
 
            document.getElementById("contact_us").reset(); 
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },10000);
         //--------------------------
      }});
        
         });
  
  $(document).ready(function(){
$('#send_form').click(function(e){
   e.preventDefault();
 
   $('#send_form').html('Sending..');
   
   /* Submit form data using ajax*/
   $.ajax({
      url: "{{ url('edit-form')}}",
      method: 'post',
      data: $('#contact_us').serialize(),
      success: function(response){
         //------------------------
            $('#send_form').html('Submit');
            $('#res_message').show();
            $('#res_message').html(response.msg);
            $('#msg_div').removeClass('d-none');
 
            document.getElementById("contact_us").reset(); 
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },10000);
         //--------------------------
      }});
   });
});
</script>








