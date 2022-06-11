<div class="right d-flex align-items-center">
          <div class="btn-group me-2">
            <span class="file-input btn btn-primary btn-file">
                Upload
            </span>
            
          </div>
          <div class="input-group">
            <input type="text" class="form-control" name="searchval" value="<?php echo e(old('searchval')); ?>" id="global_search" placeholder="Search docs, tags, etc">
            <a href="javascript:void(0);" id="searchBtn" class="btn btn-primary" type="button"><i class="fas fa-search"></i></a>
          </div>
  </div>
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
             var url = '<?php echo e(route("search-query", ":slug")); ?>';
      url = url.replace(':slug', query);

      // var base = '<?php echo e(route("search-query", ":slug")); ?>';

      // url = base.replace(':slug', '?slug='+query);

// var url = base+'?slug='+query ;

     window.location.href=url;

      }
 

      });
  </script><?php /**PATH D:\Tariq_Naeem\TNN\Laravel\DMS_S\dms\resources\views/partials/search.blade.php ENDPATH**/ ?>