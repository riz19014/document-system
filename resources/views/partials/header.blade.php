    <div class="header-area">
        <div class="container-xxl">
            <div class="row align-items-center">
              <div class="col-6 col-lg-3">
                <a class="logo" href="{{route('home')}}"><img src="{{asset('img/logo-white.png')}}" align="" class="img-fluid" width="200"></a>
              </div> 
              <div class="col-6 col-lg-9 text-end">

                <div class="login-info">{{Auth::user()->email}} <a href="{{ url('logout') }}" class="logout"><span class="fas fa-power-off"></span> Log Out</a></div>
                <button type="button" id="sidebarCollapse" class="btn btn-info d-lg-none d-inline-block">
                    <i class="fas fa-align-left"></i>
                </button>
                <span class="dropdown">
                  <a class="btn btn-white dropdown-toggle text-white no-arrow p-0" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    {{Auth::user()->name}} &nbsp;<i class="fas fa-bars text-primary pe-2"></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </span>  
                <a href="{{route('notify-files')}}" class="share-link text-primary ps-2 position-relative"><i class="fas fa-bell fa-lg" ></i>@if($filecount > 0) <span class="badge">{{$filecount}}</span>@endif</a>
                <a target="_blank" title="User Manual" href="{{asset('help/UserManual.pdf')}}" class="ps-2 help-link"><i class="fas fa-question"></i></a>         
              </div>
            </div>
          </div>
      </div>