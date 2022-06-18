
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('content_header'); ?>
<?php echo $__env->make('partials.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<div id="content">
    <div class="breadcrumb-area mb-4">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#" onclick="return false;"><?php echo e(Auth::user()->name); ?></a></li>       
                       <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('dash-index')); ?>">Dashboard & Reports</a></li>

                    </ol>
                  </nav>
                </div>
                    <div class="main-content-area">
                      <div class="dublicates-area dash-report-area">
                        <div id="tabs_id">
                        <ul class="nav nav-pills nav-justified bg-light mb-3" id="pills-tab" role="tablist">
                    
                          <li class="nav-item" role="presentation">
                            <a href="<?php echo e(route('tabs-file','duplicate')); ?>"  class="nav-link <?php if($tabs === 'duplicate'): ?> active <?php endif; ?>" id="dublicates" role="tab" aria-selected="true">Duplicates</a>
                          </li>

                          <li class="nav-item" role="presentation">
                            <a class="nav-link <?php if($tabs === 'pending'): ?> active <?php endif; ?>" id="pending-approval" href="<?php echo e(route('tabs-file','pending')); ?>" role="tab" aria-selected="false">Pending Apporval</a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a class="nav-link <?php if($tabs === 'retention'): ?> active <?php endif; ?>" id="nearing-retention" href="<?php echo e(route('tabs-file','retention')); ?>" role="tab" aria-selected="false">Nearing Rentention End</a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a class="nav-link <?php if($tabs === 'nearing'): ?> active <?php endif; ?>" href="<?php echo e(route('tabs-file','nearing')); ?>" id="nearing-duedate"  role="tab" aria-selected="false">Nearing Due Date</a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a class="nav-link <?php if($tabs === 'all'): ?> active <?php endif; ?>" id="all-files" href="<?php echo e(route('tabs-file','all')); ?>" role="tab" aria-selected="false">All Files</a>
                          </li>
                        </ul>
                      </div>
                        <div class="tab-content mt-4" id="pills-tabContent">

                         <?php if($tabs == 'duplicate'): ?>
                          <div class="tab-pane fade show active" id="duplicate" role="tabpanel">
                            <div class="tab-inner-content">
                              <div class="d-flex justify-content-between">
                                <h5 class="mb-0 font-600 pt-3"><span class="font-700"><?php echo e($duplicates->count()); ?></span> duplicates found</h5>
                                <div class="download-report font-600">
                                  Download Report: <a id="duplicate_exp" href="#" class="text-white font-400 text-decoration-underline">XLSX</a>
                                </div>
                              </div>
                              <div class="table-responsive mt-5">
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>File Name</th>
                                      <th>Location</th>
                                      <th>Added on</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $__currentLoopData = $duplicates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                     
                                      <td>

                                        <i class="fas fa-file-alt"></i>

                                        <a href="<?php echo e(route('file-view',$dup->id)); ?>"><?php echo e($dup->doc_name); ?></a>

                                      </td>
                                      <td>

                                       <?php
                                           $id = $dup->folder_id; 
                                           $count = 0;               
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

                                <small>                                            
                                 <?php $__currentLoopData = $objects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                     
                                <a href="<?php echo e(route('folder-index',$folder->id)); ?>"><?php echo e($folder->description); ?></a>
                                 <?php if($check != $count): ?>
                                 <span class="separator">&gt;</span>
                                 <?php $check++; ?>
                                 <?php endif; ?>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>          
                                 </small>
                                      </td>
                                      <td>
                                        <?php echo e(\Carbon\Carbon::parse( $dup->created_at )->format('d M Y')); ?>


                                      </td>
                                    </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <?php elseif($tabs == 'pending'): ?>


                          <div class="tab-pane fade show active" id="pending" role="tabpanel">
                            <div class="tab-inner-content">
                              <div class="d-flex justify-content-between">
                                <h5 class="mb-0 font-600 pt-3"><span class="font-700"><?php echo e($PendingFiles->count()); ?></span> documents awaiting for approval</h5>
                                <div class="download-report font-600">
                                  Download Report: <a href="#" class="text-white font-400 text-decoration-underline">XLSX</a> / <a href="#" class="text-white font-400 text-decoration-underline">ODS</a> / <a href="#" class="text-white font-400 text-decoration-underline">CSV</a>
                                </div>
                              </div>
                              <div class="table-responsive mt-5">
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>File name</th>
                                      <th>Workflow started</th>                                     
                                      <th>Awaiting for</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $__currentLoopData = $PendingFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pfile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                      <td><?php echo e($pfile->id); ?></td>
                                      <td><i class="fas fa-file-alt"></i> <?php echo e($pfile->file->doc_name); ?></td>
                                      <td>
                                         <?php echo e(\Carbon\Carbon::parse( $pfile->created_at )->format('d M Y')); ?>

                                      </td>
                                      <td><?php echo e($pfile->UserName->email); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

                           <?php elseif($tabs === 'retention'): ?>
                          <div class="tab-pane fade show active" id="nearing-rettab" role="tabpanel">
                            <div class="tab-inner-content">
                              <div class="d-flex justify-content-between">
                                <h5 class="mb-0 font-600 pt-3"><span class="font-700"><?php echo e($retentionFiles->count()); ?></span> documents with retention end in the next 30 days</h5>
                                <div class="download-report font-600">
                                  Download Report: <a href="#" class="text-white font-400 text-decoration-underline">XLSX</a> / <a href="#" class="text-white font-400 text-decoration-underline">ODS</a> / <a href="#" class="text-white font-400 text-decoration-underline">CSV</a>
                                </div>
                              </div>
                              <div class="table-responsive mt-5">
                                <table class="table table-striped table-bordered">
                                  <thead>                                  
                                    <tr>
                                      <th>No</th>
                                      <th>File Name</th>
                                      <th>Retention End</th>
                                      <th>Action</th>
                                    </tr>                                   
                                  </thead>
                                  <tbody>
                                     <?php $__currentLoopData = $retentionFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rfile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                      <td><?php echo e($rfile->id); ?></td>
                                      <td><i class="fas fa-file-alt"></i>
                                      <a href="<?php echo e(route('file-view',$rfile->file_id)); ?>"><?php echo e($rfile->file->doc_name); ?></a>
                                        </td>
                                      <td>in <?php echo e($rfile->count_value); ?> days</td>
                                      <td>Moved to the Recycle Bin</td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

                          
                          <?php elseif($tabs == 'nearing'): ?>
                          <div class="tab-pane fade show active" id="nearing-duetab" role="tabpanel">
                            <div class="tab-inner-content">
                              <div class="d-flex justify-content-between">
                                <h5 class="mb-0 font-600 pt-3"><span class="font-700"><?php echo e($nearing_files->count()); ?></span> documents that have due date in the next 30 days</h5>
                                <div class="download-report font-600">
                                  Download Report: <a href="#" class="text-white font-400 text-decoration-underline">XLSX</a> / <a href="#" class="text-white font-400 text-decoration-underline">ODS</a> / <a href="#" class="text-white font-400 text-decoration-underline">CSV</a>
                                </div>
                              </div>
                              <div class="table-responsive mt-5">
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>File Name</th>
                                      <th>Due in</th>
                                    </tr>
                                  </thead>
                                  <tbody>                                   
                                    <?php $__currentLoopData = $nearing_files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nfile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                      <td><?php echo e($nfile->id); ?></td>
                                      <td><i class="fas fa-file-alt"></i>
                                      <a href="<?php echo e(route('file-view',$nfile->id)); ?>"><?php echo e($nfile->doc_name); ?></a>
                                       </td>
                                      <td>
                                        <?php
                                         $diff = strtotime($nfile->due_date) - strtotime($nfile->date);
                                         $diff = $diff / 86400;
                                         ?>
                                         <?php if($diff > 0): ?>
                                         due in <?php echo e($diff); ?> days
                                         <?php else: ?>
                                         due <?php echo e(abs($diff)); ?> days ago
                                         <?php endif; ?>
                                      </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

                          <?php elseif($tabs == 'all'): ?>
                          <div class="tab-pane fade show active" id="all-files" role="tabpanel">
                            <div class="tab-inner-content">
                              <div class="d-flex justify-content-between">
                                <h5 class="mb-0 font-600 pt-3"><span class="font-700">8</span> duplicates found</h5>
                                <div class="download-report font-600">
                                  Download Report: <a href="#" class="text-white font-400 text-decoration-underline">XLSX</a> / <a href="#" class="text-white font-400 text-decoration-underline">ODS</a> / <a href="#" class="text-white font-400 text-decoration-underline">CSV</a>
                                </div>
                              </div>
                              <div class="table-responsive mt-5">
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>File Name</th>
                                      <th>Location</th>
                                      <th>Added on</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>1</td>
                                      <td><i class="fas fa-file-alt"></i> Payment.png</td>
                                      <td>GGL>Accounts>Bank Payment Vouchers</td>
                                      <td>28 Jun 2021</td>
                                    </tr>
                                    <tr>
                                      <td>1</td>
                                      <td><i class="fas fa-file-alt"></i> Payment.png</td>
                                      <td>GGL>Accounts>Bank Payment Vouchers</td>
                                      <td>28 Jun 2021</td>
                                    </tr>
                                    <tr>
                                      <td>1</td>
                                      <td><i class="fas fa-file-alt"></i> Payment.png</td>
                                      <td>GGL>Accounts>Bank Payment Vouchers</td>
                                      <td>28 Jun 2021</td>
                                    </tr>
                                    <tr>
                                      <td>1</td>
                                      <td><i class="fas fa-file-alt"></i> Payment.png</td>
                                      <td>GGL>Accounts>Bank Payment Vouchers</td>
                                      <td>28 Jun 2021</td>
                                    </tr>
                                    <tr>
                                      <td>1</td>
                                      <td><i class="fas fa-file-alt"></i> Payment.png</td>
                                      <td>GGL>Accounts>Bank Payment Vouchers</td>
                                      <td>28 Jun 2021</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>

    
     <form action="<?php echo e(route('excel-duplicate')); ?>" method="POST" id="dupexports">
                  <?php echo e(csrf_field()); ?>     
  </form>              

<?php $__env->stopSection(); ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  
    $(document).on('click','#duplicate_exp',function(e){
      alert();
      e.preventDefault();
      $('#dupexports').submit();
    });

</script>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Tariq_Naeem\TNN\Laravel\DMS_S\dms\resources\views/account/tabs.blade.php ENDPATH**/ ?>