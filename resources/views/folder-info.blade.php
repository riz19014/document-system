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
              <li class="breadcrumb-item"><a href="#" onclick="return false;">{{Auth::user()->name}}</a></li>
             
              <li class="breadcrumb-item active" aria-current="page">index</li>

              <li class="breadcrumb-item"><a href="{{route('folder-information', 1)}}">{{$id == 1 ? 'folder' : 'files'}}</a></li>


            </ol>
          </nav>
        </div>

        <div class="main-content-area">
             

              <div class="main-section">

                @foreach($sections as $section)

                  <div class="dashbord email-content">
                    <div class="title-section">
                      <strong>{{$section->description}}</strong>
                    </div>


                    <div class="icon-text-section">
                      <div class="icon-section">
                        <i class="fa fa-folder"></i>
                      </div>
                      <div class="text-section">
                        <h1>{{$section->children->count()}}</h1>
                        <span>Folder</span>
                      </div>
                      <div style="clear:both;"></div>
                    </div>

                    <div class="icon-text-section">
                      <div class="icon-section">
                        <i class="fa fa-file"></i>
                      </div>
                      <div class="text-section">
                        <h1> {{$section->FolderName->count()}}</h1>
                        <span>File</span>
                      </div>
                      <div style="clear:both;"></div>
                    </div>


                    <div class="detail-section">
                      <a href="#">
                        <p>View Detail</p>
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      </a>
                    </div>
                  </div>

                  @endforeach




  </div>

        </div>



 <style>

.main-section{
  width:80%;
  margin:0 auto;
}
.dashbord{
  margin-top:30px;
  margin-right: 10px;
  display: inline-block;
  width:30%;
  color:#959595;
  border-radius: 3px;
}
.title-section{
  border-radius: 5px 5px 0px 0px;
  text-align: center;
  background-color:#f5f5f5;
  padding:7px 0px;
}
.title-section p{
  margin:0px;
  font-size:13px;
}
.icon-text-section{
  background-color:#f1f1f1;
  padding:5px 10px;
}
.icon-section{
  font-size:50px;
  float:left;
  width:20%;
  color:#c7c7c7;
}
.text-section{
  width:80%;
  float:right;
  text-align: right;
}
.text-section h1{
  margin:0px;
  font-size:25px;
}
.detail-section{
  background-color: #b3b3b3;
  cursor: pointer;
  border-radius: 0px 0px 5px 5px;
}
.detail-section a{
  color:#fff;
}
.detail-section a p{
  display: inline-block;
  margin: 0px;
  font-size: 12px;
  padding:10px;
}
.detail-section a i{
  float:right;
  padding: 10px 5px 0px 0px;
}
.dashbord .detail-section:hover{
  background-color:#d9d9d9;
}
.download-content .title-section{
  background-color:#B0DA7A;
}
.download-content .icon-text-section{
  background-color: #9CD159;
}
.download-content .detail-section{
  background-color: #8DBC50;
}
.download-content .icon-section{
  color:#B9DE8A;
}
.product-content .title-section{
  background-color:#FF7979;
}
.product-content .icon-text-section{
  background-color:#FF5757;
}
.product-content .icon-section{
  color:#FF8989;
}
.product-content .detail-section{
  background-color:#E64F4F;
}
  </style>
 

    @endsection 

    <script type="text/javascript">


    </script>     