
  <div class="container-xxl">
    <div class="wrapper">
        <!-- Sidebar  -->
        <div class="row">
          <div class="col-lg-3 left-sidebar-area">
              <nav id="sidebar">

                   <ul class="list-unstyled components">
                    @if(Auth::user()->role_id !== 4)
                    <li>
                        <a href="#">Index&nbsp;<i class="fas fa-envelope text-primary"></i></a>
                    </li>
                    <li><a href="#">#team</a></li>
                    @foreach($sidebars as $side)
                     <li><a id="sinfo" data-id="{{$side->id}}" href="{{route('folder-index',$side->id)}}">{{$side->description}}</a></li>
                    @endforeach
                    <div id="line_items"></div>

                    <li class="mb-5"><a id="sectionId" href="#" data-bs-toggle="modal" data-bs-target="#createnewsection"><i class="fas fa-plus-circle text-primary"></i> &nbsp;Create New Section</a></li>

                    <li><p class="heading-sidebar">Admin tools</p></li>
                    <li><a href="{{route('dash-index')}}"><i class="fas fa-flag"></i>&nbsp; Dashboard & Reports</a></li>


                    <li><a href="{{route('recycle-bin')}}"><i class="fas fa-trash-alt"></i>&nbsp; Recycle bin</a></li>
                    <li class='sub-menu'><a href='javascript:void(0)'><i class="fas fa-chevron-right right"></i>&nbsp;More Tools</a>
                      <ul class="p-0 list-unstyled">
                        {{--<li><a href='#'><i class="fas fa-share-alt"></i>&nbsp;Share</a></li>--}}
                        <li><a href='#'><i class="fas fa-user"></i>&nbsp;Access Overview</a></li>
                        <li><a href="{{route('meta-index')}}"><i class="fas fa-tag"></i>&nbsp;Meta</a></li>
                        {{--<li><a href='#'><i class="fas fa-list-ol"></i>&nbsp;Numbering</a></li>--}}
                        <li><a href="{{route('approve-users')}}"><i class="fas fa-check"></i>&nbsp;Approval Workflow</a></li>
                        <li><a href="{{route('audit-log')}}"><i class="fas fa-file-alt"></i>&nbsp;Audit Log</a></li>
                      </ul>
                    </li>
                  @endif



                  @if(Auth::user()->role_id == 4)

                  <li><a href="{{route('manage-company')}}"><i class="fas fa-map-marker-alt"></i>&nbsp; Location</a></li>

                  <li><a href="{{route('manage-units')}}"><i class="fas fa-code-branch"></i>&nbsp; Operating Unit</a></li>

                    <li><a href="{{route('manage-departments')}}"><i class="fa fa-server"></i>&nbsp; Departments</a></li>

                    <li><a href="{{route('manage-sections')}}"><i class="fa fa-cubes"></i>&nbsp; Sections</a></li>

                    <li><a href="{{route('manage-users')}}"><i class="fas fa-users"></i>&nbsp; Manage Users</a></li>
                    {{--<li><a href="#"><i class="fas fa-users"></i>&nbsp; Manage User Groups</a></li>--}}

                  @endif

                </ul>
            </nav>
          </div>
          <div class="col-lg-9">

            <!-- Page Content  -->
             <div style="margin-bottom: -10px; text-align: center;background-color: #f9f8f8">
            @if(Auth::user()->role_id !== 4)
                      
                       {{Auth::user()->company->company_name}} <i style="color: #b3acac" class="fas fa-angle-right"></i>
                       {{Auth::user()->unit->unit_name}} <i style="color: #b3acac" class="fas fa-angle-right"></i>
                       {{Auth::user()->department->name}} <i style="color: #b3acac" class="fas fa-angle-right"></i>
                       {{Auth::user()->section->name}} <i style="color: #b3acac" class="fas fa-angle-right"></i>
                       {{Auth::user()->name}}
                  
              @else
                   
                      {{Auth::user()->name}}
                   
              @endif
               
               
             </div>
             @yield('content')

          </div>



        </div>



    </div>



  </div>


  <!-- New Section Modal -->


    <div class="modal fade" id="createnewsection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Section</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="section_part" action="" method="post">
                {{csrf_field()}}
              <div class="mb-3">
                <label>Section Name</label>
                <input type="text" name="folder_name" id="folderName" class="form-control">
                <div class="d-none" id='form-folder_name'><span id="error-folder_name" style="color: red"></span></div>
              </div>
              <div class="mb-3 text-end">
                <button type="submit" class="btn btn-primary">Create</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
