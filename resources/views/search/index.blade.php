@extends('layouts.layout')
@section('content')
@section('content_header')
@include('partials.title')
@endsection
            
                {{--<div class="pull-right" style="float: right;">
                     @include('partials.search')
                </div>--}}
                
                    
            
            <!-- Page Content  -->
            <div id="content">
         
  
    <h3>Search results</h3>
      <table class="table table-striped table-hover search-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
             @foreach($mix_searches as $search)

                <tr>
                   <td>
                      <span>

                      @if($search['object_type'] == 1)

                        <a href="{{route('folder-index',$search['id'])}}"><i class='fas fa-folder' style='font-size:18px; margin-right: 0.4em;'></i>{{$search['doc_name']}}</a>


                      @else

                       <a href="{{route('file-view',$search['id'])}}"><i class='fas fa-file-alt' style='font-size:18px; margin-right: 0.4em;'></i>{{$search['doc_name']}}</a>


                      @endif 
                      </span><br/>

                @php 
                     $count = 0;

                   if($search['object_type'] == 1){

                   $id = $search['id'];

                 }else{

                 $id = $search['folder_id']; 

               }
                 
                  
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
                <span>
                 <small>
                   
                         @foreach($objects as $folder)
                      <a href="{{route('folder-index',$folder->id)}}">{{$folder->description}}</a>
                      @if($check != $count)
                       <span class="separator">&gt;</span>
                       @php $check++; @endphp
                       @endif
                         @endforeach 
          

                   </small></span>


                    </td>
                    <td> {{ \Carbon\Carbon::parse( $search['created_at'] )->format('d M Y') }}
 </td>
                </tr>
              @endforeach

        </tbody>

    </table>

      

                </div>
        

                

               
    @endsection 

   