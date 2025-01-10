<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DmSection;
use App\Models\DmMetaTagging;
use App\Models\DmFolderColumn;
use App\Models\DmFileUpload;
use App\Models\DmFileTagging;
use App\Models\User;
use App\Classes\Audits;
use App\Models\ApprovalUser;
use App\Models\ApprovalStatus;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\DmNumbering;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class FolderController extends Controller
{
  

    public function AddSection(Request $request){
      

      $section = new DmSection();
      $section->description = $request->folder_name;
      $section->is_section = 1;
      $section->company_id = Auth::user()->company_id;
      $section->company_branch_id = Auth::user()->company_branch_id;
      $section->department_id = Auth::user()->department_id;
      $section->section_id = Auth::user()->section_id;
      $section->save();
      $sections = DmSection::where('id', $section->id)->first();


      $params = ['objtype'=> 3,'obj_id'=>$section->id,'obj'=> Auth::id(),'action'=> trans('global.section.create')];
      $activity =  Audits::getAudit($params);

      return response()->json(['sections' => $sections]);


    }


    public function index($id){
      // dd($id);

         $folid = $id;

        $folder_file = DmSection::find($id);
        $foldered = DmSection::find($id);

        // dd($foldered->countAllFiles());

        $metaTagNames =  DmMetaTagging::all();
     
        $metaTags =  DmFolderColumn::where('folder_id',$id)->orderBy('tab_index', 'ASC')->get();
         //dd($metaTags);
        $folder_child = DmSection::where('parent_id', $id)->orderBy('created_at', 'desc')->get();
        //dd( $folder_child);
        $folder_files = DmFileUpload::where('folder_id', $id)->where('is_delete', 0)->orderBy('created_at', 'desc')->get();
        // dd($folder_files);
        $parents = array();  
        do {
            $folder = DmSection::find($id);
            if($folder->parent_id == null){
               $parents[] = $folder;
            }else{
                $parents[] = $folder;         
            }
            $id = $folder->parent_id;
          } while ($id != null);

          $parents=array_reverse($parents);
                
        return view('folder.index', compact('folder_file','foldered','folder_child','parents','metaTags','metaTagNames','folder_files','folid'));
 
    }

    public function AddFolder(Request $request){

        
      
      $objName = DmSection::where('id',$request->folder_id)->first();
     
        $folder = new DmSection();
        $folder->description = $request->foldar_name;
        $folder->is_section = 0;
        $folder->parent_id = $request->folder_id;
        $folder->company_id = Auth::user()->company_id;
        $folder->company_branch_id = Auth::user()->company_branch_id;
        $folder->department_id = Auth::user()->department_id;
        $folder->section_id = Auth::user()->section_id;
        $folder->save();

      $params = ['objtype'=> 1,'obj_id'=>$folder->id,'obj'=>$request->folder_id,
      'action'=> trans('global.folder.create')];
      $activity =  Audits::getAudit($params);

    }

    public function MetaIndex(){

        // $metaTags = DmMetaTagging::all();

        return view('meta.index');
    }

    public function AddMeta(Request $request){

        

        $params = ['objtype'=> 3,'obj_id'=>null,'obj'=> Auth::id(),
      'action'=> trans('global.Meta.create').'"'.$request->meta_name.'"'];
      $activity =  Audits::getAudit($params);
 
        $folder = new DmMetaTagging();
        $folder->tagging_name = $request->meta_name;
        $folder->company_id = Auth::user()->company_id;
        $folder->company_branch_id = Auth::user()->company_branch_id;
        $folder->department_id = Auth::user()->department_id;
        $folder->section_id = Auth::user()->section_id;
        $folder->save();


    }


public function fileUpload(Request $request)
{
    $flag = 0;
    $fid = DmSection::where('id', $request->FolderId)->first();
    $cuser = ApprovalUser::count();
    if ($cuser) {
        $flag = 1;
    }
    $priorityUser = ApprovalUser::where('position', 1)->first();

    foreach ($request->file('filenames') as $file) {
        $fileSize = $file->getSize();

        // Get the original file details
        $name = $file->getClientOriginalName();
        $filename = pathinfo($name, PATHINFO_FILENAME);
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $filepath = $filename . '.' . strtolower($extension);

        // Read file contents
        $fileContents = file_get_contents($file->getRealPath());

        // Encrypt the file contents
        $encryptedContents = Crypt::encrypt($fileContents);

        // Store the encrypted file in the storage
        $path = $fid->description . '/' . $filepath;
        Storage::disk('public')->put($path, $encryptedContents);

        // Create a record in the database
        $photo = new DmFileUpload();
        $photo->folder_id = $request->FolderId;
        $photo->doc_name = $filepath;
        $photo->file_mime = $file->getClientMimeType();
        $photo->notify = ($flag == 1) ? 1 : 0;
        $photo->file_size = $fileSize / 1000;
        $photo->doc_path = 'storage/' . $path;
        $photo->company_id = Auth::user()->company_id;
        $photo->company_branch_id = Auth::user()->company_branch_id;
        $photo->department_id = Auth::user()->department_id;
        $photo->section_id = Auth::user()->section_id;
        $photo->save();

        // Create an approval status if a priority user exists
        if ($priorityUser != null) {
            $status = new ApprovalStatus();
            $status->file_id = $photo->id;
            $status->user_id = $priorityUser->user_id;
            $status->company_id = Auth::user()->company_id;
            $status->company_branch_id = Auth::user()->company_branch_id;
            $status->department_id = Auth::user()->department_id;
            $status->section_id = Auth::user()->section_id;
            $status->notify = ($flag == 1) ? 1 : 0;
            $status->save();
        }

        // Log the audit action
        $params = ['objtype' => 2, 'obj_id' => $photo->id . '-fi', 'obj' => $request->FolderId, 'action' => trans('global.folder.ficreate')];
        $activity = Audits::getAudit($params);
    }
}


    public function ColumnFolder(Request $request)
    {
     
     if(!is_null($request['column_folder'])) {
        $parent = DmSection::find($request->folder_id_col);
        $array[]=$request->folder_id_col;
        if($parent){
          $children = DmSection::Where('parent_id',$request->folder_id_col)->get(); 
          foreach ($children as $child) {
              $array[] = $child['id'];  
          }    
        }

        foreach($request->column_folder as $key => $value){
            if(!empty($value)){
              foreach($array as $id){
                $column_tag = DmFolderColumn::where('folder_id',$id)->where('meta_tag_id',$value)->first();        
                if($column_tag == null){
                      
                      $column_tag = new DmFolderColumn();
                      $column_tag->folder_id = $id;
                      $column_tag->meta_tag_id = $value;
                      $column_tag->tab_index = $key;
                      $column_tag->tag_value = 1;
                      $column_tag->company_id = Auth::user()->company_id;
                      $column_tag->company_branch_id = Auth::user()->company_branch_id;
                      $column_tag->department_id = Auth::user()->department_id;
                      $column_tag->section_id = Auth::user()->section_id;
                      $column_tag->save();
                }else{
                      $column_tag->folder_id = $id;
                      $column_tag->meta_tag_id = $value;
                      $column_tag->tab_index = $key;
                      $column_tag->save();
                  }
              }
            }
          }        
      }
    }

    public function MetaRecord(Request $request){
      
        $metaTags = DmMetaTagging::all();

        // dd($metaTags);

        return Datatables::of($metaTags)

        ->addColumn('action', function($row){
            $status_btn = ''; 

            $status_btn .= '<a data-bs-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-cog" style="font-size:18px; margin-right: 0.4em;"></i></a>
            <ul class="dropdown-menu" style="right:auto; left: auto;">
            <li><a class="dropdown-item" id="editmeta" data-toggle="modal" data-target="#metaModaledit" data-name="'.$row->tagging_name.'" href="javascript:void(0)" data-id="'.$row->id.'">Edit</a></li>
            <li><a class="dropdown-item" style="color: red;" id="deletemeta" data-id="'.$row->id.'" data-name="'.$row->tagging_name.'" href="javascript:void(0)">Delete</a></li>
          </ul>';
            return $status_btn;         
      })

        ->addColumn('tagging_name', function($row){
           return $row->tagging_name;         
     })
     ->rawColumns(['action'])
          ->make(true);
          

        
    }

    public function RecycleView(){
        return view('folder.recycle-bin');
    }

    public function RecycleData(Request $request){

        $recycles = DmFileUpload::where('is_delete', 1)->orderBy('created_at', 'desc')->get();

        // dd($metaTags);

        return Datatables::of($recycles)

        ->addColumn('checkbox', function ($row) { 

          $html_string = '';
          $html_string .= '<div class="custom-control custom-checkbox custom-checkbox1 d-inline-block">
                                <input type="checkbox" class="custom-control-input check1" value="'.$row['id'].'" id="quot_'.$row['id'].'">
                                <label class="custom-control-label" for="quot_'.$row['id'].'"></label>
                            </div>';


    
                return $html_string;         
            })
            
        ->addColumn('action', function($row){
            $status_btn = ''; 

            $status_btn .= '<a title="Restore" id="restoreId" data-name="'.$row->doc_name.'" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#restoreModel" href="#"><i class="fas fa-undo" style="font-size:18px; margin-right: 0.4em; color:#b9b3b3;"></i></a>

            <a title="Delete" id="restoreDel" data-name="'.$row->doc_name.'" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#restoreDelModel" href="#"><i class="fas fa-trash-alt" style="font-size:18px; margin-right: 0.4em;color:#b9b3b3;"></i></a>';
            return $status_btn;         
      })

        ->addColumn('doc_name', function($row){
           return $row->doc_name;         
     })
        ->addColumn('deleted_at', function($row){

            $status_btn = ''; 
           $status_btn .= '<div title="'.Carbon::parse($row->deleted_at)->timezone('Asia/Karachi').'">'.Carbon::parse( $row->deleted_at )->format('d M Y').'</div>';
            return $status_btn;       
     })

        ->addColumn('file_size', function($row){
           return round($row->file_size,2).' kB';         
     })
     ->rawColumns(['action','deleted_at','checkbox'])
          ->make(true);


    }

    public function RestoreData(Request $request){

     $file = DmFileUpload::where('id', $request->RestoreId)->first();
      $file->is_delete = 0;
      $file->save();
    }

     public function DeletePermanent(Request $request){
       $delete_file = DmFileUpload::whereIn('id', $request->selected_quots);
       $delete_file->delete();
    }

    public function EmptyRecyle(){
      $delete_file = DmFileUpload::where('is_delete', '1');
      $delete_file->delete();
   }

    

    public function MainData(Request $request)
    {
      // Fetch child folders and their numbering in a single query
          $folder_children = DmSection::with([
              'numbering' => function ($query) {
                  $query->where('entity_type', 1); // 1 for folder
              }
          ])
          ->where('parent_id', $request->folderid)
          ->orderBy('created_at', 'desc')
          ->get();

          // Prepare folder data
          $array_product = $folder_children->map(function ($folder) {
              return [
                  'id' => $folder->id,
                  'description' => $folder->description,
                  'object_type' => $folder->object_type,
                  'created_at' => $folder->created_at,
                  'numbering' => $folder->numbering->numbering ?? null, // Add numbering if available
              ];
          })->toArray();

          // Fetch files in the folder and their numbering in a single query
          $folder_files = DmFileUpload::with([
              'numbering' => function ($query) {
                  $query->where('entity_type', 2); // 2 for file
              }
          ])
          ->where('folder_id', $request->folderid)
          ->where('is_delete', 0)
          ->orderBy('created_at', 'desc')
          ->get();

          // Prepare file data
          $array_pro = $folder_files->map(function ($file) {
              return [
                  'id' => $file->id,
                  'description' => $file->doc_name,
                  'file_mime' => $file->file_mime,
                  'size' => $file->file_size,
                  'tags' => $file->tags,
                  'due_date' => $file->due_date,
                  'object_type' => $file->object_type,
                  'notes' => $file->note,
                  'created_at' => $file->created_at,
                  'numbering' => $file->numbering->numbering ?? null, // Add numbering if available
              ];
          })->toArray();

          // Combine folders and files data
          $records = array_merge($array_product, $array_pro);


                  // Optionally, you can return or use $arr3 here


            



        return Datatables::of($records)

        ->addColumn('checkbox', function ($row) { 
              $text = 'hidden';
              if($row['object_type'] == 1){
                  $text = '';
              }
              $html_string = '<div class="custom-control custom-checkbox custom-checkbox1 d-inline-block">
                                    <input type="checkbox" class="custom-control-input check1" value="'.$row['id'].'" id="quot_'.$row['id'].'">
                                    <label class="custom-control-label" for="quot_'.$row['id'].'"></label><a data-id="'.$row['id'].'" data-name="'.$row['description'].'" style="color:#c3c3c3;visibility: '.$text.'" class="change-name font-icon-color"><i class="fas fa-edit" title="change folder name"></i></a>
                                </div>';
  

        
                    return $html_string;         
                })



        ->addColumn('action', function($row){

            $status_btn = ''; 

            if($row['object_type'] == 1){
               
               $status_btn .= '<a id="sinfo" data-id="{{$child->id}}" href="'.route('folder-index',$row['id']).'"><i title="Folder" class="fas fa-folder change-name" style="font-size:18px; margin-right: 0.4em;""></i>'.$row['description'].'</a>';

            }else{

                if(Str::contains($row['file_mime'], 'image/')){
                  $status_btn .= '<a id="sinfo" data-id="{{$child->id}}" href="'.route('file-view',$row['id']).'"><i title="Image" class="fas fa-images" style="font-size:18px; margin-right: 0.4em;""></i>'.$row['description'].'</a>';

                }elseif(Str::contains($row['file_mime'], 'application/') && $row['file_mime'] != 'application/octet-stream'){
                  $status_btn .= '<a id="sinfo" data-id="{{$child->id}}" href="'.route('file-view',$row['id']).'"><i title="File" class="fas fa-file-alt" style="font-size:18px; margin-right: 0.4em;""></i>'.$row['description'].'</a>';
                }elseif(Str::contains($row['file_mime'], 'application/octet-stream')){

                  $status_btn .= '<a id="sinfo" data-id="{{$child->id}}" href="'.route('file-view',$row['id']).'"><i title="Corrupt file" class="fa fa-ban" style="font-size:18px; margin-right: 0.4em;""></i>'.$row['description'].'</a>';

                }elseif(Str::contains($row['file_mime'], 'text/')){

                  $status_btn .= '<a id="sinfo" data-id="{{$child->id}}" href="'.route('file-view',$row['id']).'"><i title="File" class="fa fa-file" style="font-size:18px; margin-right: 0.4em;""></i>'.$row['description'].'</a>';

                }

            }

            return $status_btn;         
      })

        ->addColumn('filesize', function($row){

          if($row['object_type'] == 2){


             if($row['size'] > 1024){

                return round($row['size']/1000, 2).' MB';

              }else{

                return round($row['size'], 2).' kB';

              }

          }else{
               $id = $row['id'];

              $folder = DmFileUpload::where('folder_id', $id)->where('is_delete', 0)->sum('file_size');
              if($folder > 1024){

                return round($folder/1000, 2).' MB';

              }else{

                return round($folder, 2).' kB';

              }

              
  
            }       
     })

        ->addColumn('tags', function($row){

             if($row['object_type'] == 1){
            return '';

          }else{
            return $row['tags'];

          }         
     })

     //  ->addColumn('signed_by', function($row){

     //      if(strpos($row['description'], '.png') || strpos($row['description'], '.jpg')
     //                    || strpos($row['description'], '.jpeg') || strpos($row['description'], '.svg')){

     //         return $row['signature']; 

     //      }elseif(strpos($row['description'], '.PDF') || strpos($row['description'], '.txt')){

     //              return $row['signature']; 
             
     //        }else{            
     //              return ;             
     //        }


                  
     // })

        ->addColumn('notes', function($row){
                if(strpos($row['description'], '.png') || strpos($row['description'], '.jpg')
                        || strpos($row['description'], '.jpeg') || strpos($row['description'], '.svg')){

             return $row['notes']; 

          }elseif(strpos($row['description'], '.PDF') || strpos($row['description'], '.pdf') || strpos($row['description'], '.txt')){

                  return $row['notes']; 
             
            }else{            
                  return ;             
            }      
     })

        ->addColumn('created_at', function($row){
           return Carbon::parse( $row['created_at'] )->format('d M Y');         
     })

          ->addColumn('due_date', function($row){


          //  if($row['object_type'] == 2){

          //    return ($row['due_date'] != null) ? Carbon::parse( $row['due_date'] )->format('d M Y') : '';

          // }else{            
          //          return ;           
          //   } 

          return $row['numbering']; 

                 
     })


          ->addColumn('listAction', function ($row) { 

             if($row['object_type'] == 1){

                  $html_string = '<a class="font-icon-color" style="margin-right: 0.4em;" href="'.route('download-folder-file',$row['id'].'-folder').'"><i class="fas fa-download title="download""></i></a><a data-name="Folder" data-id="'.$row['id'].'" class="delete-folder font-icon-color"><i class="fas fa-trash" title="delete"></i></a>';

                  return $html_string;  

           }else{    
                  $html_string = '<a class="font-icon-color" style="margin-right: 0.4em;" href="'.route('download-folder-file',$row['id'].'-file').'"><i class="fas fa-download"></i></a><a data-name="File" data-id="'.$row['id'].'" class="delete-folder font-icon-color"><i class="fas fa-trash" title="delete"></i></a>';

                  return $html_string;          
            } 
       
            })    

     ->rawColumns(['action','checkbox', 'listAction'])
          ->make(true);


    }

   public function EditMeta(Request $request){

      $params = ['objtype'=> 3,'obj_id'=>96,'obj'=> Auth::id(),
      'action'=> trans('global.Meta.edit').'"'.$request->meta_name.'"'];
      $activity =  Audits::getAudit($params);

      $EditMeta = DmMetaTagging::find($request->meta_id);
      $EditMeta->tagging_name = $request['meta_name'];
      $EditMeta->save();

   }  

   
   public function DeleteMeta(Request $request){
    $params = ['objtype'=> 3,'obj_id'=>96,'obj'=> Auth::id(),
      'action'=> trans('global.Meta.delete').'"'.$request->meta_name.'"'];
      $activity =  Audits::getAudit($params);

      $DeleteMeta = DmMetaTagging::find($request->meta_id);
      $DeleteMeta->delete();

 } 

 public function DeleteFolder(Request $request)
 {

       if($request->name == 'File')
       {
           if(DmFileUpload::where('id', $request->folder_id)->exists())
           {
              $file = DmFileUpload::where('id', $request->folder_id)->first();
              $file->is_delete = 1;
              $file->deleted_at = Carbon::now();
              $file->save();


           }
       }

       if($request->name == 'Folder')
       {

           if(DmFileUpload::where('folder_id', $request->folder_id)->exists())
           {
              DmFileUpload::where('folder_id', $request->folder_id)->delete();
           }
           DmSection::where('id', $request->folder_id)->delete();

       }

       return response()->json(['success' => true]);

 }

 public function ChangeFolderName(Request $request)
 {
       DmSection::where('id', $request->folder_id)->update(['description' => $request->name]);
       return response()->json(['success' => true]);  

 }  

   public function OrderData(Request $request){

     

   }


  // public function fetchFolder(Request $request)
  // {
  //       // Validate and capture the incoming request
  //       $folderId = $request->numb_id;

  //       // Fetch folders (children of the given folder ID)
  //       $folderChild = DmSection::where('parent_id', $folderId)
  //           ->orderBy('created_at', 'desc')
  //           ->get(['id', 'description']);

  //       // Fetch files in the folder (not deleted)
  //       $folderFiles = DmFileUpload::where('folder_id', $folderId)
  //           ->where('is_delete', 0)
  //           ->orderBy('created_at', 'desc')
  //           ->get(['id', 'doc_name']);

  //       // Prepare response structure
  //       $response = [
  //           'folders' => $folderChild->map(function ($folder) {
  //               return [
  //                   'id' => $folder->id,
  //                   'name' => $folder->description,
  //               ];
  //           }),
  //           'files' => $folderFiles->map(function ($file) {
  //               return [
  //                   'id' => $file->id,
  //                   'name' => $file->doc_name,
  //               ];
  //           }),
  //       ];

  //       // Return response in JSON format
  //       return response()->json($response);
  // }


   public function fetchFolder(Request $request)
{
    // Validate and capture the incoming request
    $folderId = $request->numb_id;

    // Fetch folders (children of the given folder ID) along with numbering
    $folderChild = DmSection::where('parent_id', $folderId)
        ->orderBy('created_at', 'desc')
        ->get(['id', 'description'])
        ->map(function ($folder) {
            // Fetch the numbering for each folder (entity_type = 1 for folder)
            $folderNumbering = DmNumbering::where('entity_id', $folder->id)
                ->where('entity_type', 1)
                ->first(); // Get the first matching numbering

            return [
                'id' => $folder->id,
                'name' => $folder->description,
                'numbering' => $folderNumbering ? $folderNumbering->numbering : null, // Add numbering if available
            ];
        });

    // Fetch files in the folder (not deleted) along with numbering
    $folderFiles = DmFileUpload::where('folder_id', $folderId)
        ->where('is_delete', 0)
        ->orderBy('created_at', 'desc')
        ->get(['id', 'doc_name'])
        ->map(function ($file) {
            // Fetch the numbering for each file (entity_type = 2 for file)
            $fileNumbering = DmNumbering::where('entity_id', $file->id)
                ->where('entity_type', 2)
                ->first(); // Get the first matching numbering

            return [
                'id' => $file->id,
                'name' => $file->doc_name,
                'numbering' => $fileNumbering ? $fileNumbering->numbering : null, // Add numbering if available
            ];
        });

    // Prepare response structure
    $response = [
        'folders' => $folderChild,
        'files' => $folderFiles,
    ];

    // dd($response);

    // Return response in JSON format
    return response()->json($response);
}


  

  public function updateNumbering(Request $request)
  {
      $data = $request->all();
      $authUser = Auth::user();

      // Loop through folder numbering updates
      if (isset($data['folders'])) {
          foreach ($data['folders'] as $folderId => $numbering) {
              DmNumbering::updateOrCreate(
                  [
                      'entity_id' => $folderId,
                      'entity_type' => 1, // 1 for folder
                  ],
                  [
                      'numbering' => $numbering,
                      'company_id' => $authUser->company_id,
                      'company_branch_id' => $authUser->company_branch_id,
                      'department_id' => $authUser->department_id,
                      'section_id' => $authUser->section_id,
                  ]
              );
          }
      }

      // Loop through file numbering updates
      if (isset($data['files'])) {
          foreach ($data['files'] as $fileId => $numbering) {
              DmNumbering::updateOrCreate(
                  [
                      'entity_id' => $fileId,
                      'entity_type' => 2, // 2 for file
                  ],
                  [
                      'numbering' => $numbering,
                      'company_id' => $authUser->company_id,
                      'company_branch_id' => $authUser->company_branch_id,
                      'department_id' => $authUser->department_id,
                      'section_id' => $authUser->section_id,
                  ]
              );
          }
      }

      return redirect()->back();
  }






}
