
  @if(Route::currentRouteName() == 'manage-units' || Route::currentRouteName() == 'manage-departments' || Route::currentRouteName() == 'manage-sections' || Route::currentRouteName() == 'manage-users')

    <div class="right d-flex align-items-center">
          <div class="input-group">
            <input type="text" class="form-control"  id="search_grid">
          </div>
  </div>

  @else
     <div class="right d-flex align-items-center">
          <div class="btn-group me-2">
            <span class="file-input btn btn-primary btn-file">
                Upload
            </span>
            {{--<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" style="">
              <li><a class="dropdown-item" href="#">Upload Foldar</a></li>
              <li><a class="dropdown-item" href="#">New Word document</a></li>
              <li><a class="dropdown-item" href="#">New Excel Spreadsheet</a></li>
              <li><a class="dropdown-item" href="#">New PowerPoint presentation</a></li>
            </ul>--}}
          </div>
          <div class="input-group">
            <input type="text" class="form-control" name="searchval" value="{{old('searchval')}}" id="global_search" placeholder="Search docs, tags, etc">
            <a href="javascript:void(0);" id="searchBtn" class="btn btn-primary" type="button"><i class="fas fa-search"></i></a>
          </div>
  </div>

  @endif


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript">
    
    $(document).on("keyup",'#global_search', function(event) {
    if (event.keyCode === 13) {  
      document.getElementById("searchBtn").click();
    }
});

    $(document).on('click', '#searchBtn', function(){
      var query = $("#global_search").val();
      if(query != ''){
             var url = '{{ route("search-query", ":slug") }}';
      url = url.replace(':slug', query);

      // var base = '{{ route("search-query", ":slug") }}';

      // url = base.replace(':slug', '?slug='+query);

// var url = base+'?slug='+query ;

     window.location.href=url;

      }
 

      });
  </script>