          <div class="d-flex justify-content-between">
                <div class="left">
                  <nav class="navbar navbar-expand-lg navbar-light bg-light">
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="cats-navbar folderitem" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">

                          <?php if(Route::currentRouteName() == 'folder-index'): ?> 

                         <?php if(Auth::user()->role_id == 1): ?>
                            <li class="nav-item">
                            <a class="nav-link" id="folderid" data-id="<?php echo e($folder_file->id); ?>" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"><i class="fas fa-folder-plus"></i><br> +Foldar</a>
                          </li>
                         
                          <li class="nav-item">
                            <a class="nav-link" data-id="<?php echo e($folder_file->id); ?>" id="column_folder_id" href="#" data-bs-toggle="modal" data-bs-target="#ColumnsModal"><i class="fas fa-columns"></i><br> Columns</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-tag"></i><br> Meta</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#"><i class="far fa-handshake"></i><br> Approval</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('folder-audit',$folder_file->id)); ?>"><i class="fas fa-file-alt"></i><br> Audit Log</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-list-ol"></i><br> Numbering</a>
                          </li>
                           <?php endif; ?>

                        </ul>
                      </div>

                        <div class="cats-navbar checkitem d-none" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">
                           <li class="nav-item">
                            <a class="nav-link" href="#"><img src="<?php echo e(asset('img/move_right.png')); ?>" align="" class="img-fluid" width="20" ><br> Move</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="folderdelete" href="#"><i class="fas fa-trash"></i><br> Delete</a>
                          </li>
                           <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#FileRetentionModel" id="file_retention" href="#"><i class="fas fa-clock"></i><br> Retention</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-download"></i><br> Download File</a>
                          </li>

                        <?php elseif(Route::currentRouteName() == 'manage-users'): ?>

                          <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#UserAddModal" href="#"><i class="fas fa-user-plus"></i><br> +User</a>
                          </li>


                          <?php elseif(Route::currentRouteName() == 'manage-departments'): ?>

                          <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#departmentAddModal" href="#"><i class="fa fa-server"></i><br> Department</a>
                          </li>

                          <?php elseif(Route::currentRouteName() == 'manage-sections'): ?>

                          <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#sectionAddModal" href="#"><i class="fas fa-box"></i><br> Section</a>
                          </li>

                          <?php elseif(Route::currentRouteName() == 'manage-units'): ?>

                          <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#unitAddModal" href="#"><i class="fas fa-code-branch"></i><br> Unit</a>
                          </li>

                          <?php elseif(Route::currentRouteName() == 'manage-company'): ?>

                          <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#companyAddModal" href="#"><i class="fas fa-map-marker-alt"></i><br> Location</a>
                          </li>


                         <?php elseif(Route::currentRouteName() == 'file-view'): ?>

                           <?php if(Auth::user()->role_id == 1): ?>

                             <li class="nav-item">
                            
                              <?php if($file->file_locked==0): ?>
                              <a class="nav-link"  href="<?php echo e(route('edit-scan-file',$file->id)); ?>" ><i class="fas fa-cog"></i><br> Modify</a>
                              <?php endif; ?>
                              
                             
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" data-id="" id="column_folder_id" href="<?php echo e(route('file-move',$file->id)); ?>" data-toggle="modal" data-target="#moveModel"><i class="fas fa-folder-minus"></i><br> Move</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo e(route('download-file',$file->id)); ?>"><i class="fas fa-download"></i><br> Download</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="file_id" data-id="<?php echo e($file->id); ?>" data-bs-toggle="modal" data-bs-target="#filedelModal" href="#"><i class="fas fa-trash"></i><br> Delete</a>
                            </li>
                            <?php else: ?>

                            <li class="nav-item">
                              <a class="nav-link" data-id="" id="column_folder_id" href="#" data-bs-toggle="modal" data-bs-target="#ColumnsModal"><i class="fas fa-folder-minus"></i><br> Move</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo e(route('download-file',$file->id)); ?>"><i class="fas fa-download"></i><br> Download</a>
                            </li>



                            <?php endif; ?>


                          <?php elseif(Route::currentRouteName() == 'recycle-bin'): ?>

                          <li class="nav-item">
                            <a class="nav-link" id="filesDelete" data-id="" data-bs-toggle="modal" data-bs-target="#multipleRemoveModel" href="#"><i class="fas fa-trash-alt"></i><br> Delete</a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link" id="folderid" data-id="" data-bs-toggle="modal" data-bs-target="#emptyRecycleModel" href="#"><i class="fas fa-trash"></i><br> Empty Bin</a>
                          </li>

                          

                          <?php elseif(Route::currentRouteName() == 'meta-index'): ?>
                          <li class="nav-item">
                            <a class="nav-link" id="folderid" data-id="" data-bs-toggle="modal" data-bs-target="#MetaexampleModal" href="#"><i class="fas fa-folder-plus"></i><br> +Meta</a>
                          </li>


                          <?php endif; ?>   
                         





                        </ul>
                      </div>
 
                  </nav>
                </div>

                <!-- Modal to move file -->
                <div class="modal fade" id="moveModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select folder to move file</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="column_part" action="" method="post">
                        <?php echo e(csrf_field()); ?>

                          <div class="mb-3">
                            <form id="modalForm_75888" class="form-modal move-modal" action="/folder/move/?target=1180314&amp;files=4547554&amp;folders=&amp;links=" method="post" data-abide="ajax" novalidate="novalidate">
                              <input type="hidden" name="_csrf" value="jiYzWONPW1RDJwnUYMu8LO3HPmMR38559rwMfblV2qf9R2cvtSccAS9AZaIYv9dF2IpMDGOQnwqx_XkZ9zKFww==">    <a class="close-reveal-modal">×</a>
                                  <div class="select-modal-title-area">
                                      <a class="back-reveal-modal" href="javascript:void(0);"><span class="icon icon-back_docs"></span></a>
                                      <div class="select-modal-folder-name">Week</div>
                                  </div>
                                  <div class="selectDialogContent">
                                      <div class="folderContents"><div><div class="itemName"><span class="icon icon-folder"></span> A</div><div class="selectFolderLink"><span class="icon icon-dropdown_off"></span></div></div><div><div class="itemName"><span class="icon icon-folder"></span> Sunday</div><div class="selectFolderLink"><span class="icon icon-dropdown_off"></span></div></div><div class="disabled"><div class="itemName"><span class="icon icon-picture"></span> Landscape-Color (1) (1).jpg</div></div></div>
                                      <div class="folderSeparator"></div>
                                      <div class="buttonBar">
                                          <a class="submit-active-item button tiny disabled" href="javascript:void(0);" title="Item is already in this folder">Move here</a>
                                      </div>
                                  </div>
                              </form>
                            
                
                
                
                  
                            <input type="hidden" name="folder_id_col" id="col_folder_id" value="">
                          </div>
                          <div class="mb-3 text-end">
                            <button type="submit" class="btn btn-primary disbtn">Move</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div> 

                <?php echo $__env->make('partials.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div><?php /**PATH /home/rizwan/tpro/NDMS/resources/views/partials/title.blade.php ENDPATH**/ ?>