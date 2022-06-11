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
                       <li class="breadcrumb-item active" aria-current="page"><a href="{{route('dash-index')}}">Dashboard & Reports</a></li>

                    </ol>
                  </nav>
                </div>

              
                    <div class="main-content-area">
                      <div class="dashboard-report-area">
                        <div class="heading mb-4">
                          <h5><strong>{{$filecount}}</strong> total files</h5>
                        </div>
                        <div class="inner-content">
                          <div class="report-cards-area">
                            <div class="row display-flex">
                              <div class="col-md-6 col-lg-4">
                                <div class="report-card mb-4">
                                  <a href="{{route('tabs-file','duplicate')}}" class="p-4 h-100 rounded shadow-sm d-block w-100">
                                    <div class="d-flex align-items-center">
                                      <div class="flex-shrink-0">
                                        <i class="far fa-clone"></i>
                                      </div>
                                      <div class="flex-grow-1 ms-4">
                                        <h6 class="text-primary font-600 mb-1">Duplicate</h6>
                                        <p class="mb-0">{{$duplicates}} duplicates found</p>
                                      </div>
                                    </div>
                                  </a>
                                </div>
                              </div>                              
                              <div class="col-md-6 col-lg-4">
                                <div class="report-card mb-4">
                                  <a href="{{route('tabs-file','pending')}}" class="p-4 h-100 rounded shadow-sm d-block w-100">
                                    <div class="d-flex align-items-center">
                                      <div class="flex-shrink-0">
                                        <i class="fas fa-handshake"></i>
                                      </div>
                                      <div class="flex-grow-1 ms-4">
                                        <h6 class="text-primary font-600 mb-1">Pending Approval</h6>
                                        <p class="mb-0">{{$PendingCount}} documents awaiting for approval</p>
                                      </div>
                                    </div>
                                  </a>
                                </div>
                              </div>
                              <div class="col-md-6 col-lg-4">
                                <div class="report-card mb-4">
                                  <a href="{{route('tabs-file','retention')}}" class="p-4 h-100 rounded shadow-sm d-block w-100">
                                    <div class="d-flex align-items-center">
                                      <div class="flex-shrink-0">
                                        <i class="far fa-clock"></i>
                                      </div>
                                      <div class="flex-grow-1 ms-4">
                                        <h6 class="text-primary font-600 mb-1">Nearing Retention End</h6>
                                        <p class="mb-0">{{$nearing_retention}} documents with rentention in the next 30 days.</p>
                                      </div>
                                    </div>
                                  </a>
                                </div>
                              </div>
                              <div class="col-md-6 col-lg-4">
                                <div class="report-card mb-4">
                                  <a href="{{route('tabs-file','nearing')}}" class="p-4 h-100 rounded shadow-sm d-block w-100">
                                    <div class="d-flex align-items-center">
                                      <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-triangle"></i>
                                      </div>
                                      <div class="flex-grow-1 ms-4">
                                        <h6 class="text-primary font-600 mb-1">Nearing Due Date</h6>
                                        <p class="mb-0">{{$nearing}} due or soon to be due document</p>
                                      </div>
                                    </div>
                                  </a>
                                </div>
                              </div>
                              <div class="col-md-6 col-lg-4">
                                <div class="report-card mb-4">
                                  <a href="{{route('tabs-file','all')}}" class="p-4 h-100 rounded shadow-sm d-block w-100">
                                    <div class="d-flex align-items-center">
                                      <div class="flex-shrink-0">
                                        <i class="fas fa-file-alt"></i>
                                      </div>
                                      <div class="flex-grow-1 ms-4">
                                        <h6 class="text-primary font-600 mb-1">All Files</h6>
                                        <p class="mb-0"></p>
                                      </div>
                                    </div>
                                  </a>
                                </div>
                              </div>  
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

@endsection 


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });

        $('.sub-menu ul').hide();
        $(".sub-menu a").click(function () {
          $(this).parent(".sub-menu").children("ul").slideToggle("100");
          $(this).find(".right").toggleClass("fa-chevron-right fa-chevron-down");
        });
        // Equal height columns
        $( document ).ready(function() {
            var heights = $(".report-card").map(function() {
                return $(this).height();
            }).get(),

            maxHeight = Math.max.apply(null, heights);

            $(".report-card").height(maxHeight);
        });
    </script>
 