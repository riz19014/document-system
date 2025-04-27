<div class="container-xxl">
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="row">
            <div class="col-lg-2 left-sidebar-area">
                <nav id="sidebar">
                    <ul class="list-unstyled components">
                        @if(Auth::user()->role_id !== 4)
                            <li>
                                <a href="{{route('folder-information', 1)}}">Index&nbsp;<i class="fas fa-hashtag text-primary"></i></a>
                            </li>
                                                      <!-- Check if there are more than 10 items in the sidebar -->
                              @if(count($sidebars) > 10)
                                  <!-- Search Box -->
                                  <input type="text" id="searchSidebar" placeholder="Search..." class="form-control mb-3" style="border-radius: 5px; padding: 10px;">
                              @endif

                              <!-- Sidebar List (with scrolling when there are more than 10 items) -->
                              <div id="sidebar-list" style="max-height: 200px; overflow-y: scroll; border: 2px solid #e5e5e5; border-radius: 5px; 
                                                             padding: 10px 5px; /* Increased top and bottom padding */
                                                             margin-top: 10px; /* Added margin from top */
                                                             margin-bottom: 10px; /* Added margin from bottom */
                                                             scrollbar-width: thin; /* Firefox */
                                                             scrollbar-color: #1ea1d7 #f1f1f1; /* Firefox */
                                                            ">
                                  @foreach($sidebars as $side)
                                      <li><a id="sinfo" data-id="{{$side->id}}" href="{{route('folder-index',$side->id)}}">{{$side->description}}</a></li>
                                  @endforeach
                              </div>


                            <div id="line_items"></div>

                            <li class="mb-5"><a id="sectionId" href="#" data-bs-toggle="modal" data-bs-target="#createnewsection"><i class="fas fa-plus-circle text-primary"></i> &nbsp;Create New Section</a></li>

                            <li><p class="heading-sidebar">Admin tools</p></li>
                            <li><a href="{{route('dash-index')}}"><i class="fas fa-flag"></i>&nbsp; Dashboard & Reports</a></li>
                            <li><a href="{{route('recycle-bin')}}"><i class="fas fa-trash-alt"></i>&nbsp; Recycle bin</a></li>
                            <li class='sub-menu'><a href='javascript:void(0)'><i class="fas fa-chevron-right right"></i>&nbsp;More Tools</a>
                                <ul class="p-0 list-unstyled">
                                    <li><a href='#'><i class="fas fa-user"></i>&nbsp;Access Overview</a></li>
                                    <li><a href="{{route('meta-index')}}"><i class="fas fa-tag"></i>&nbsp;Meta</a></li>
                                    <li><a href="{{route('approve-users')}}"><i class="fas fa-check"></i>&nbsp;Approval Workflow</a></li>
                                    <li><a href="{{route('audit-log')}}"><i class="fas fa-file-alt"></i>&nbsp;Audit Log</a></li>
                                </ul>
                            </li>
                        @endif

                        @if(Auth::user()->role_id == 4)
                        <li><a href="{{route('manage-company')}}" class="menu-item"><i class="fas fa-building"></i>&nbsp; Company</a></li>
<li><a href="{{route('manage-units')}}" class="menu-item"><i class="fas fa-code-branch"></i>&nbsp; Operating Unit</a></li>
<li><a href="{{route('manage-departments')}}" class="menu-item"><i class="fa fa-server"></i>&nbsp; Departments</a></li>
<li><a href="{{route('manage-sections')}}" class="menu-item"><i class="fa fa-cubes"></i>&nbsp; Sections</a></li>
<li><a href="{{route('manage-users')}}" class="menu-item"><i class="fas fa-users"></i>&nbsp; Manage Users</a></li>

                           


                            
                        @endif
                    </ul>
                </nav>
            </div>

            <!-- Page Content -->
            <div class="col-lg-10">
                <div style="margin-bottom: -10px; text-align: center; padding: 10px; display: flex; justify-content: center; flex-wrap: wrap; gap: 5px;">
    @if(Auth::user()->role_id !== 4)
        <span style="background-color: #e3f2fd; padding: 5px 10px; border-radius: 5px;">
            {{ Auth::user()->company->company_name }}
        </span>
        <i style="color: #b3acac; margin: 0 5px; position: relative; top: 8px;" class="fas fa-angle-right"></i>

        
        <span style="background-color: #e8f5e9; padding: 5px 10px; border-radius: 5px;">
            {{ Auth::user()->unit->unit_name }}
        </span>
        <i style="color: #b3acac; margin: 0 5px; position: relative; top: 8px;" class="fas fa-angle-right"></i>
        
        <span style="background-color: #fff3e0; padding: 5px 10px; border-radius: 5px;">
            {{ Auth::user()->department->name }}
        </span>
        <i style="color: #b3acac; margin: 0 5px; position: relative; top: 8px;" class="fas fa-angle-right"></i>
        
        <span style="background-color: #fce4ec; padding: 5px 10px; border-radius: 5px;">
            {{ Auth::user()->section->name }}
        </span>
        <i style="color: #b3acac; margin: 0 5px; position: relative; top: 8px;" class="fas fa-angle-right"></i>
        
        <span style="background-color: #ede7f6; padding: 5px 10px; border-radius: 5px;">
            {{ Auth::user()->name }}
        </span>
    @else
        <span style="background-color: #ede7f6; padding: 5px 10px; border-radius: 5px;">
            {{ Auth::user()->name }}
        </span>
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
                        <div class="d-none" id='form-folder_name'>
                            <span id="error-folder_name" style="color: red"></span>
                        </div>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('searchSidebar').addEventListener('input', function () {
        var filter = this.value.toLowerCase();
        var listItems = document.querySelectorAll('#sidebar-list li');

        listItems.forEach(function (item) {
            var text = item.textContent || item.innerText;
            if (text.toLowerCase().includes(filter)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>