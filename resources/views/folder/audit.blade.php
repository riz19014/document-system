@extends('layouts.layout')

@section('content')


@section('content_header')

  @include('partials.title')

@endsection




<div id="content">

  <h3 class="mb-2 text-primary font-600">Audits</h3>


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
                          <div class="col-lg-9">



                            <div class="audit-logs">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Time</th>
                                    <th>User</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                   @foreach ($folder_audits as $audit)
                                  <tr>
                                    <td>{{$audit->date}}</td>
                                    <td>{{$audit->User->email}}</td>
                                    <td>
                                       @php
                                       $str = $audit['object_id'];
                                       $idexplode = explode("-",$str);
                                       @endphp
                                     @if(@$idexplode[1] == 'fi')

                                      {{$audit->action}}
                                        <a style="color: #1ea1d7;" href="{{route('file-view',$idexplode[0])}}">{{$audit->Objectfile->doc_name}}</a>
                                      @endif

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






@endsection



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">



</script>










