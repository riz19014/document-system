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
                      <div class="dublicates-area dash-report-area">
                        <div id="tabs_id">
                        <ul class="nav nav-pills nav-justified bg-light mb-3" id="pills-tab" role="tablist">
                    
                          <li class="nav-item" role="presentation">
                            <a href="{{route('tabs-file','duplicate')}}"  class="nav-link @if($tabs === 'duplicate') active @endif" id="dublicates" role="tab" aria-selected="true">Duplicates</a>
                          </li>

                          <li class="nav-item" role="presentation">
                            <a class="nav-link @if($tabs === 'pending') active @endif" id="pending-approval" href="{{route('tabs-file','pending')}}" role="tab" aria-selected="false">Pending Apporval</a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a class="nav-link @if($tabs === 'retention') active @endif" id="nearing-retention" href="{{route('tabs-file','retention')}}" role="tab" aria-selected="false">Nearing Rentention End</a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a class="nav-link @if($tabs === 'nearing') active @endif" href="{{route('tabs-file','nearing')}}" id="nearing-duedate"  role="tab" aria-selected="false">Nearing Due Date</a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a class="nav-link @if($tabs === 'all') active @endif" id="all-files" href="{{route('tabs-file','all')}}" role="tab" aria-selected="false">All Files</a>
                          </li>
                        </ul>
                      </div>
                        <div class="tab-content mt-4" id="pills-tabContent">

                         @if($tabs == 'duplicate')
                          <div class="tab-pane fade show active" id="duplicate" role="tabpanel">
                            <div class="tab-inner-content">
                              <div class="d-flex justify-content-between">
                                <h5 class="mb-0 font-600 pt-3"><span class="font-700">{{$duplicates->count()}}</span> duplicates found</h5>
                                <div class="download-report font-600">
                                  Download Report: <a id="duplicate_exp" href="#" class="text-white font-400 text-decoration-underline">XLSX</a>
                                </div>
                              </div>
                              <div class="table-responsive mt-5">
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>File Name</th>
                                      <th>Location</th>
                                      <th>Added onjjj</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($duplicates as $dup)
                                    <tr>
                                     
                                      <td>

                                        <i class="fas fa-file-alt"></i>

                                        <a href="{{route('file-view',$dup->id)}}">{{$dup->doc_name}}</a>

                                      </td>
                                      <td>

                                       @php
                                           $id = $dup->folder_id; 
                                           $count = 0;               
                                            do{
                                                $count++;
                                                $folder = App\Models\DmSection::find($id);
                                                if($folder->parent_id == null){
                                                 $parents[] = $folder;
                                              }else{
                                                  $parents[] = $folder;         
                                              }
                                              $id = $folder->parent_id;

                                          } while ($id != null);
                                                $objects = array_reverse($parents);
                                                $parents = null;
                                           $count = $count - 1;
                                           $check = 0;     
                                          @endphp      

                                <small>                                            
                                 @foreach($objects as $folder)                     
                                  <a href="{{route('folder-index',$folder->id)}}">{{$folder->description}}</a>
                                  @if($check != $count)
                                  <span class="separator">&gt;</span>
                                  @php $check++; @endphp
                                  @endif
                                 @endforeach          
                                 </small>
                                      </td>
                                      <td>
                                        {{ \Carbon\Carbon::parse( $dup->created_at )->format('d M Y') }}
                                      </td>
                                    </tr>
                                  @endforeach
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          @elseif($tabs == 'pending')


                          <div class="tab-pane fade show active" id="pending" role="tabpanel">
                            <div class="tab-inner-content">
                              <div class="d-flex justify-content-between">
                                <h5 class="mb-0 font-600 pt-3"><span class="font-700">{{$PendingFiles->count()}}</span> documents awaiting for approval</h5>
                                <div class="download-report font-600">
                                  Download Report: <a href="#" class="text-white font-400 text-decoration-underline">XLSX</a> / <a href="#" class="text-white font-400 text-decoration-underline">ODS</a> / <a href="#" class="text-white font-400 text-decoration-underline">CSV</a>
                                </div>
                              </div>
                              <div class="table-responsive mt-5">
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>File name</th>
                                      <th>Workflow started</th>                                     
                                      <th>Awaiting for</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($PendingFiles as $pfile)
                                    <tr>
                                      <td>{{$pfile->id}}</td>
                                      <td><i class="fas fa-file-alt"></i> {{$pfile->file->doc_name}}</td>
                                      <td>
                                         {{ \Carbon\Carbon::parse( $pfile->created_at )->format('d M Y') }}
                                      </td>
                                      <td>{{$pfile->UserName->email}}</td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

                           @elseif($tabs === 'retention')
                          <div class="tab-pane fade show active" id="nearing-rettab" role="tabpanel">
                            <div class="tab-inner-content">
                              <div class="d-flex justify-content-between">
                                <h5 class="mb-0 font-600 pt-3"><span class="font-700">{{$retentionFiles->count()}}</span> documents with retention end in the next 30 days</h5>
                                <div class="download-report font-600">
                                  Download Report: <a href="#" class="text-white font-400 text-decoration-underline">XLSX</a> / <a href="#" class="text-white font-400 text-decoration-underline">ODS</a> / <a href="#" class="text-white font-400 text-decoration-underline">CSV</a>
                                </div>
                              </div>
                              <div class="table-responsive mt-5">
                                <table class="table table-striped table-bordered">
                                  <thead>                                  
                                    <tr>
                                      <th>No</th>
                                      <th>File Name</th>
                                      <th>Retention End</th>
                                      <th>Action</th>
                                    </tr>                                   
                                  </thead>
                                  <tbody>
                                     @foreach($retentionFiles as $rfile)
                                    <tr>
                                      <td>{{$rfile->id}}</td>
                                      <td><i class="fas fa-file-alt"></i>
                                      <a href="{{route('file-view',$rfile->file_id)}}">{{$rfile->file->doc_name}}</a>
                                        </td>
                                      <td>in {{$rfile->count_value}} days</td>
                                      <td>Moved to the Recycle Bin</td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

                          
                          @elseif($tabs == 'nearing')
                          <div class="tab-pane fade show active" id="nearing-duetab" role="tabpanel">
                            <div class="tab-inner-content">
                              <div class="d-flex justify-content-between">
                                <h5 class="mb-0 font-600 pt-3"><span class="font-700">{{$nearing_files->count()}}</span> documents that have due date in the next 30 days</h5>
                                <div class="download-report font-600">
                                  Download Report: <a href="#" class="text-white font-400 text-decoration-underline">XLSX</a> / <a href="#" class="text-white font-400 text-decoration-underline">ODS</a> / <a href="#" class="text-white font-400 text-decoration-underline">CSV</a>
                                </div>
                              </div>
                              <div class="table-responsive mt-5">
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>File Name</th>
                                      <th>Due in</th>
                                    </tr>
                                  </thead>
                                  <tbody>                                   
                                    @foreach($nearing_files as $nfile)
                                    <tr>
                                      <td>{{$nfile->id}}</td>
                                      <td><i class="fas fa-file-alt"></i>
                                      <a href="{{route('file-view',$nfile->id)}}">{{$nfile->doc_name}}</a>
                                       </td>
                                      <td>
                                        @php
                                         $diff = strtotime($nfile->due_date) - strtotime($nfile->date);
                                         $diff = $diff / 86400;
                                         @endphp
                                         @if($diff > 0)
                                         due in {{$diff}} days
                                         @else
                                         due {{abs($diff)}} days ago
                                         @endif
                                      </td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

                          @elseif($tabs == 'all')
                          <div class="tab-pane fade show active" id="all-files" role="tabpanel">
                            <div class="tab-inner-content">
                              <div class="d-flex justify-content-between">
                                <!-- <h5 class="mb-0 font-600 pt-3"><span class="font-700">8</span> duplicates found</h5> -->
                                <!-- <div class="download-report font-600">
                                  Download Report: <a href="#" class="text-white font-400 text-decoration-underline">XLSX</a> / <a href="#" class="text-white font-400 text-decoration-underline">ODS</a> / <a href="#" class="text-white font-400 text-decoration-underline">CSV</a>
                                </div> -->
                              </div>
                              <div class="table-responsive mt-5">
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>File Name</th>
                                      <th>Location</th>
                                      <th>Added on</th>
                                    </tr>
                                  </thead>
                                  <!-- <tbody>
                                    <tr>
                                      <td>1</td>
                                      <td><i class="fas fa-file-alt"></i> Payment.png</td>
                                      <td>GGL>Accounts>Bank Payment Vouchers</td>
                                      <td>28 Jun 2021</td>
                                    </tr>
                                    <tr>
                                      <td>1</td>
                                      <td><i class="fas fa-file-alt"></i> Payment.png</td>
                                      <td>GGL>Accounts>Bank Payment Vouchers</td>
                                      <td>28 Jun 2021</td>
                                    </tr>
                                    <tr>
                                      <td>1</td>
                                      <td><i class="fas fa-file-alt"></i> Payment.png</td>
                                      <td>GGL>Accounts>Bank Payment Vouchers</td>
                                      <td>28 Jun 2021</td>
                                    </tr>
                                    <tr>
                                      <td>1</td>
                                      <td><i class="fas fa-file-alt"></i> Payment.png</td>
                                      <td>GGL>Accounts>Bank Payment Vouchers</td>
                                      <td>28 Jun 2021</td>
                                    </tr>
                                    <tr>
                                      <td>1</td>
                                      <td><i class="fas fa-file-alt"></i> Payment.png</td>
                                      <td>GGL>Accounts>Bank Payment Vouchers</td>
                                      <td>28 Jun 2021</td>
                                    </tr>
                                  </tbody> -->
                                </table>
                              </div>
                            </div>
                          </div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>

    
     <form action="{{route('excel-duplicate')}}" method="POST" id="dupexports">
                  {{csrf_field()}}     
  </form>              

@endsection
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  
    $(document).on('click','#duplicate_exp',function(e){
      alert();
      e.preventDefault();
      $('#dupexports').submit();
    });

</script>
