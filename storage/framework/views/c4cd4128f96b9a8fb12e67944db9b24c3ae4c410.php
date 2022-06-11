
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('content_header'); ?>
<?php echo $__env->make('partials.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
            
                
                
                    
            
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
             <?php $__currentLoopData = $mix_searches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                   <td>
                      <span>

                      <?php if($search['object_type'] == 1): ?>

                        <a href="<?php echo e(route('folder-index',$search['id'])); ?>"><i class='fas fa-folder' style='font-size:18px; margin-right: 0.4em;'></i><?php echo e($search['doc_name']); ?></a>


                      <?php else: ?>

                       <a href="<?php echo e(route('file-view',$search['id'])); ?>"><i class='fas fa-file-alt' style='font-size:18px; margin-right: 0.4em;'></i><?php echo e($search['doc_name']); ?></a>


                      <?php endif; ?> 
                      </span><br/>

                <?php 
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

                ?>
                <span>
                 <small>
                   
                         <?php $__currentLoopData = $objects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <a href="<?php echo e(route('folder-index',$folder->id)); ?>"><?php echo e($folder->description); ?></a>
                      <?php if($check != $count): ?>
                       <span class="separator">&gt;</span>
                       <?php $check++; ?>
                       <?php endif; ?>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
          

                   </small></span>


                    </td>
                    <td> <?php echo e(\Carbon\Carbon::parse( $search['created_at'] )->format('d M Y')); ?>

 </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>

    </table>

      

                </div>
        

                

               
    <?php $__env->stopSection(); ?> 

   
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Tariq_Naeem\TNN\Laravel\DMS_S\dms\resources\views/search/index.blade.php ENDPATH**/ ?>