@extends('layouts.layout')

@section('content')


@section('content_header')

  @include('partials.title')

@endsection



<div id="content">

 <div class="main-content-area">
          <div class="file-view-area">
            <div class="row">
              <div class="col-lg-9">


                <div class="audit-logs">
                  <p class="mb-2 text-primary font-600" style="font-size: 1.3rem;">
                  Files that need my approval:
                  </p>

                </div>
                 <div class="row">
                <div class="col-lg-5">
                   
                  ({{$filecount}}) Files
                </div>
                <div class="col-lg-2">
                    @if($filecount !=0)
                    <a href="{{route('file-approval-view')}}" class="btn btn-primary ">View</a>
                    @endif


                </div>


              </div>
            
              </div>
                <div class="row" style="text-align: right;" >
                     <div class="bg-light" >
  
                    
                    <a href="{{route('file-approval-history')}}" style="color: #1ea1d7;">
                      <span>My Approval History</span>
                    </a>


                </div>
              </div>

            </div>
          </div>
        </div> 
</div>



@endsection 










