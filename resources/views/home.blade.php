<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection--}}

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Font Awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Dropzone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.css" />
    <!-- Custom Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <!-- Responsive Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}">


    <link href="{{asset('dist/lity.css')}}" rel="stylesheet">


  </head>
  <body>

    <!-- Header -->
      <div class="header-area">
        <div class="container-xxl">
            <div class="row align-items-center">
              <div class="col-6 col-lg-3">
                <a class="logo" href="#"><img src="{{asset('img/logo-white.png')}}" align="" class="img-fluid" width="200"></a>
              </div> 
              <div class="col-6 col-lg-9 text-end">

                <div class="login-info">{{Auth::user()->email}} <a href="{{ url('logout') }}" class="logout"><span class="fas fa-power-off"></span> Log Out</a></div>
                <button type="button" id="sidebarCollapse" class="btn btn-info d-lg-none d-inline-block">
                    <i class="fas fa-align-left"></i>
                </button>
                <span class="dropdown sp-dropdown">
                  <a class="btn btn-white dropdown-toggle text-white no-arrow p-0" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Softpyramid &nbsp;<i class="fas fa-bars text-primary pe-2"></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </span>  
                <a href="#" class="share-link text-primary ps-2 position-relative"><i class="fas fa-share-alt share"></i> <span class="badge">6</span></a>
                <a href="#" class="ps-2 help-link"><i class="fas fa-question"></i></a>         
              </div>
            </div>
          </div>
      </div>
    <!-- end Header -->
    <!-- Page Title Bar -->
      <div class="page-title-area">
        <div class="container-xxl">

          <div class="row align-items-center">
            <div class="col-6 col-lg-3">
              <h3>Main Sections</h3>
            </div>
            <div class="col-6 col-lg-9 text-end">
                
            </div>
          </div>
        </div>
      </div>
    <!-- end Page Title Bar -->
  <div class="container-xxl">
    <div class="wrapper">
        <!-- Sidebar  -->
        <div class="row">
          <div class="col-lg-3 left-sidebar-area">
              <nav id="sidebar">
                <ul class="list-unstyled components">
                    <li>
                        <a href="#">Index&nbsp;<i class="fas fa-envelope text-primary"></i></a>
                    </li>
                    <li><a href="#">#team</a></li>
                    {{--@foreach($sidebars as $side)
                     <li><a id="sinfo" data-id="{{$side->id}}" href="{{route('folder-index',$side->id)}}">{{$side->description}}</a></li>
                    @endforeach--}}
                    <table class="main-section"></table>
                    <div id="line_items"></div>
                    <li class="mb-5"><a id="sectionId" href="#" data-bs-toggle="modal" data-bs-target="#createnewsection"><i class="fas fa-plus-circle text-primary"></i> &nbsp;Create New Section</a></li>
                    <li><p class="heading-sidebar">Admin tools</p></li>
                    <li><a href="#"><i class="fas fa-flag"></i>&nbsp; Dashboard & Reports</a></li>
                    <li><a href="#"><i class="fas fa-user"></i>&nbsp; Manage Users</a></li>
                    <li><a href="#"><i class="fas fa-users"></i>&nbsp; Manage User Groups</a></li>
                    <li><a href="{{route('recycle-bin')}}"><i class="fas fa-trash-alt"></i>&nbsp; Recycle bin</a></li>
                    <li class='sub-menu'><a href='javascript:void(0)'><i class="fas fa-chevron-right right"></i>&nbsp;More Tools</a>
                      <ul class="p-0 list-unstyled">
                        <li><a href='#'><i class="fas fa-share-alt"></i>&nbsp;Share</a></li>
                        <li><a href='#'><i class="fas fa-user"></i>&nbsp;Access Overview</a></li>
                        <li><a href="{{route('meta-index')}}"><i class="fas fa-tag"></i>&nbsp;Meta</a></li>
                        <li><a href='#'><i class="fas fa-list-ol"></i>&nbsp;Numbering</a></li>
                        <li><a href='#'><i class="fas fa-file-alt"></i>&nbsp;Audit Log</a></li>
                      </ul>
                    </li>
                </ul>
            </nav>
          </div>
          <div class="col-lg-9">

            <!-- Page Content  -->

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

<script src="{{asset('vendor/jquery.js')}}"></script>
<script src="{{asset('dist/lity.js')}}"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

  <script src="{{asset('js/dropzone.min.js')}}"></script>

<script type="text/javascript">
// $(document).on('change', '.btn-file :file', function() {
// var input = $(this),
//     numFiles = input.get(0).files ? input.get(0).files.length : 1,
//     label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
// input.trigger('fileselect', [numFiles, label]);
// });

// $(document).ready( function() {
//   $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
//     console.log("teste");
//     var input_label = $(this).closest('.input-group').find('.file-input-label'),
//       log = numFiles > 1 ? numFiles + ' files selected' : label;

//     if( input_label.length ) {
//       input_label.text(log);
//     } else {
//       if( log ) alert(log);
//     }
//   });
// });
</script>
<script type="text/javascript">

  $(document).ready(function () {
  $('#createnewsection').on('shown.bs.modal', function() {
    $('#folderName').focus();
  })
});

  $(function () {
    
    var table = $('.main-section').DataTable({
     "paging": false,
     "ordering": false,
     "searching": false,
     "info": false,
     // "lengthChange": false
     language : {
        "zeroRecords": " "             
    },

      ajax: {
          url:"{!! route('section-table') !!}",
          method: "get",
        },
        columns: [
           
            {data: 'description', name: 'description'},
        ]
    });
    
  });

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
        $("#dropzone").dropzone({ url: "/file/post" });


         // $(document).on('click','#sinfo',function(){
         //    alert('here');
         //    var edit_id = $(this).data('id');
         //    alert(edit_id);

         // });

         $(document).on('click', '#sectionId', function(){
               $("#createnewsection").find("#section_part")[0].reset();
         });

         


        $(document).on('submit','#section_part',function(e){
        e.preventDefault(); 
             $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
             var name_folder = $('#folderName').val();
              if (name_folder.length<1) {
         $("#form-folder_name").removeClass('d-none');
          document.getElementById('error-folder_name').innerHTML = "Section name is required. *";
         setTimeout(function(){ $('#form-folder_name').addClass('d-none'); }, 4000); 
    }
    if(name_folder.length<1){
        return false;
    }
        $.ajax({
          type: "POST",
          url: "{{ route('add-section') }}",
         data: $('#section_part').serialize(),
          success: function(data) {
            // alert('respose');
            $('#createnewsection').modal('hide');
            $('.main-section').DataTable().ajax.reload();

          },
        });
      });

    </script>
  </body>
</html>
