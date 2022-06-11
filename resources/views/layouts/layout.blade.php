<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DMS</title>

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
 
    @yield('styles')
  </head>
  <body class="d-flex flex-column min-vh-100">

    <!-- Header -->
  @if(Route::currentRouteName() == 'reso-view') 

         @include('partials.header')

         @yield('content_headerr')

         @else
         @include('partials.header')

    <!-- end Header -->

    <!-- Page Title Bar -->
      <div class="page-title-area">
        <div class="container-xxl">

          <div class="row align-items-center">
            <div class="col-6 col-lg-3">
              <h3>Main Sections</h3>
            </div>
            <div class="col-6 col-lg-9 text-end">

               @yield('content_header')



                
            </div>

          </div>

        </div>
        
      </div>


   


       <!-- end Title Bar -->


       <!-- sidebar -->
  

         @include('partials.sidebar')

       <!-- end sidebar -->

           <!-- Footer -->

    <!-- end Footer -->


 {{--<footer class="footer">
      <ul class="footer-menu">
        <li><a href="#">Contact</a></li>
        <li><a href="#">Privacy policy</a></li>
        <li><a href="#">Terms of use</a></li>
      </ul>
      <div class="copyright">Softpyramid © 2021</div>
    </footer>--}}



  @endif


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

  $(function(){
  var current_page_URL = location.href;
  $( "a" ).each(function() {

     if ($(this).attr("href") !== "#") {
       var target_URL = $(this).prop("href");
       if (target_URL == current_page_URL) {
          $('nav a').parents('li, ul').removeClass('active');
          $(this).parent('li').addClass('active');
          return false;
       }
     }
  });
});

  $(document).ready(function () {
  $('#createnewsection').on('shown.bs.modal', function() {
    $('#folderName').focus();
  })
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
          
            $('#createnewsection').modal('hide');
            var nHTML = ''; 

            var url = '{{ route("folder-index", ":slug") }}';
                url = url.replace(':slug', data.sections.id);


            nHTML += '<li ><a id="sinfo" data-id="'+data.sections.id+'" href="'+url+'">'+data.sections.description+'</a></li>'

          $('#line_items').append(nHTML);

          },
        });
      });


    </script>
  </body>
</html>
