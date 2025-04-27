    <div class="header-area">
        <div class="container-xxl">
            <div class="row align-items-center">
              <div class="col-6 col-lg-3">
                <a class="logo" href="{{route('home')}}"><img src="{{asset('img/folder-logo.png')}}" align="" class="img-fluid" width="200"></a>
              </div> 
              <div class="col-6 col-lg-9 text-end">

              
              <div class="btn-group">
                    <a href="{{ url('logout') }}" class="btn btn-danger btn-sm px-3 d-inline-flex align-items-center">
                      <span class="fas fa-power-off me-2"></span> Log Out
                    </a>
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item text-center" href="{{ route('company.switch') }}">
    <div style="font-size: 10px; font-style: italic; color: #888;">Switch to other company</div>
    <i class="fas fa-exchange-alt" style="font-size: 20px; margin-top: 5px;"></i>
</a>

                      </li>
                    </ul>
                </div>

                <button type="button" id="sidebarCollapse" class="btn btn-info d-lg-none d-inline-block">
                    <i class="fas fa-align-left"></i>
                </button>
                {{--<span class="dropdown">
                  <a class="btn btn-white dropdown-toggle text-white no-arrow p-0" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    {{Auth::user()->name}} &nbsp;<i class="fas fa-bars text-primary pe-2"></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </span>  --}}
                <a href="{{ route('notify-files') }}" 
                      class="btn btn-outline-primary position-relative d-inline-flex align-items-center px-3 py-2">
                      <i class="fas fa-bell fa-lg me-2" style="color: yellow;"></i>
                      @if($filecount > 0)
                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle" 
                              style="font-size: 0.75rem; padding: 0.25em 0.5em;">
                          {{ $filecount }}
                        </span>
                      @endif
                 </a>
               

                <!-- <a target="_blank" title="User Manual" href="{{asset('help/UserManual.pdf')}}" class="ps-2 help-link"><i class="fas fa-question"></i></a>          -->
              </div>
            </div>
          </div>
      </div>