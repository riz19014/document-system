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
use Auth;
use Carbon\Carbon;

class FolderController extends Controller
{
  

    public function AddSection(Request $request){
      // dd($request->all());

      $section = new DmSection();
      $section->description = $request->folder_name;
      $section->is_section = 1;
      $section->save();
      $sections = DmSection::where('id', $section->id)->first();


      $params = ['objtype'=> 3,'obj_id'=>$section->id,'obj'=> Auth::id(),'action'=> trans('global.section.create')];
      $activity =  Audits::getAudit($params);

      return response()->json(['sections' => $sections]);


    }


    public function index($id){

         $folid = $id;

        $folder_file = DmSection::find($id);
        $foldered = DmSection::find($id);
         //dd($foldered);


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

        // dd($request->all());
      
      $objName = DmSection::where('id',$request->folder_id)->first();
     
        $folder = new DmSection();
        $folder->description = $request->foldar_name;
        $folder->is_section = 0;
        $folder->parent_id = $request->folder_id;
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

        // dd($request->all());

        $params = ['objtype'=> 3,'obj_id'=>null,'obj'=> Auth::id(),
      'action'=> trans('global.Meta.create').'"'.$request->meta_name.'"'];
      $activity =  Audits::getAudit($params);
 
        $folder = new DmMetaTagging();

        $folder->tagging_name = $request->meta_name;
        $folder->save();


    }

    public function fileUpload(Request $request){
         $flag = 0;
         $fid = DmSection::where('id',$request->FolderId)->first();
         $cuser = ApprovalUser::count();
         if($cuser){
            $flag = 1;
         }
        $priorityUser = ApprovalUser::where('position', 1)->first();

        foreach($request->file('filenames') as $file){
        //  dd($file);
           $fileSize = $file->getSize();
            $photo = new DmFileUpload();
            $name = $file->getClientOriginalName();
           // $path = $file->move(public_path() . '/file_uploads/', $name);
            $path = $file->storeAs($fid->description, $name, 'public');
            $photo->folder_id = $request->FolderId;
            $photo->doc_name =  $name;
            if($flag==1){
              $photo->notify =  1;
            }else{
              $photo->notify =  0;
            }

            $photo->file_size =  $fileSize / 1000;
            // $photo->doc_path = 'file_uploads/' . $name;
            $photo->doc_path = 'storage/'.$path;
            $photo->save();

            if($priorityUser !=null){
              
           

             $status = new ApprovalStatus();
             $status->file_id = $photo->id;
             $status->user_id = $priorityUser->user_id;
            if($flag==1){
              $status->notify =  1;
            }else{
              $status->notify =  0;
            }
            $status->save();

 }



             $params = ['objtype'=> 1,'obj_id'=>$photo->id.'-fi','obj'=> $request->FolderId,
            'action'=> trans('global.folder.ficreate')];
            $activity =  Audits::getAudit($params);

            // $params = ['objtype'=> 2,'obj_id'=>$photo->id,'obj'=> $photo->id,
            // 'action'=> trans('global.file.create')];
            // $activity =  Audits::getAudit($params);
            
                       
         }


  }

    public function ColumnFolder(Request $request)
    {
     // dd($request->all());
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

    

    public function MainData(Request $request){

      // dd($request->all());

//       $arr1 = array('foo' => 'bar');
// $arr2 = array('baz' => 'bof');

// // dd($arr1);
// $arr3 = $arr1 + $arr2;
// dd($arr3);
      $records = array();

      $folder_child = DmSection::where('parent_id', $request->folderid)->orderBy('created_at', 'desc')->get();


      $array_product = array(); 
      $i = 0;

      foreach ($folder_child as $row_pro)
      {
          $array_product [$i]["id"]= $row_pro->id;
          $array_product [$i]["description"]= $row_pro->description;
          $array_product [$i]["object_type"]= $row_pro->object_type;
          $array_product [$i]["created_at"]= $row_pro->created_at;
          $i++;
      }

        $folder_files = DmFileUpload::where('folder_id', $request->folderid)->where('is_delete', 0)->orderBy('created_at', 'desc')->get();

        $array_pro = array(); 

      foreach ($folder_files as $row_product)
      {
          $array_pro [$i]["id"]= $row_product->id;
          $array_pro [$i]["description"]= $row_product->doc_name;
          $array_pro [$i]["size"]= $row_product->file_size;
          $array_pro [$i]["tags"]= $row_product->tags;
          $array_pro [$i]["due_date"]= $row_product->due_date;
          $array_pro [$i]["object_type"]= $row_product->object_type;
          $array_pro [$i]["signature"]= $row_product->signature;
          $array_pro [$i]["created_at"]= $row_product->created_at;
          $i++;
      }

      $arr3 = $array_product + $array_pro;
        return Datatables::of($arr3)

        ->addColumn('checkbox', function ($row) { 

              $html_string = '<div class="custom-control custom-checkbox custom-checkbox1 d-inline-block">
                                    <input type="checkbox" class="custom-control-input check1" value="'.$row['id'].'" id="quot_'.$row['id'].'">
                                    <label class="custom-control-label" for="quot_'.$row['id'].'"></label>
                                </div>';
  

        
                    return $html_string;         
                })



        ->addColumn('action', function($row){

            $status_btn = ''; 

            // dd($row['description']);

            if(strpos($row['description'], '.png') || strpos($row['description'], '.jpg')
                        || strpos($row['description'], '.jpeg') || strpos($row['description'], '.svg')){

              $status_btn .= '<a id="sinfo" data-id="{{$child->id}}" href="'.route('file-view',$row['id']).'"><i class="fas fa-images" style="font-size:18px; margin-right: 0.4em;""></i>'.$row['description'].'</a>';

            }elseif(strpos($row['description'], '.PDF') || strpos($row['description'], '.txt')
              || strpos($row['description'], '.odt') | strpos($row['description'], '.pdf')){
              $status_btn .= '<a id="sinfo" data-id="{{$child->id}}" href="'.route('file-view',$row['id']).'"><i class="fas fa-file-alt" style="font-size:18px; margin-right: 0.4em;""></i>'.$row['description'].'</a>';

             
            }else{
              $status_btn .= '<a id="sinfo" data-id="{{$child->id}}" href="'.route('folder-index',$row['id']).'"><i class="fas fa-folder" style="font-size:18px; margin-right: 0.4em;""></i>'.$row['description'].'</a>';
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
            if(strpos($row['description'], '.png') || strpos($row['description'], '.jpg')
                        || strpos($row['description'], '.jpeg') || strpos($row['description'], '.svg')){

            return $row['tags'];

          }elseif(strpos($row['description'], '.PDF') || strpos($row['description'], '.txt')){

                 return $row['tags'];
             
            }else{            
                  return ;             
            }         
     })

      ->addColumn('signed_by', function($row){

          if(strpos($row['description'], '.png') || strpos($row['description'], '.jpg')
                        || strpos($row['description'], '.jpeg') || strpos($row['description'], '.svg')){

             return $row['signature']; 

          }elseif(strpos($row['description'], '.PDF') || strpos($row['description'], '.txt')){

                  return $row['signature']; 
             
            }else{            
                  return ;             
            }


                  
     })

        ->addColumn('created_at', function($row){
           return Carbon::parse( $row['created_at'] )->format('d M Y');         
     })

          ->addColumn('due_date', function($row){


           if($row['object_type'] == 2){

             return ($row['due_date'] != null) ? Carbon::parse( $row['due_date'] )->format('d M Y') : '';

          }else{            
                   return ;           
            }  

                 
     })


          ->addColumn('listAction', function ($row) { 

             if($row['object_type'] == 1){

                  $html_string = '<a class="nav-link" href="'.route('download-folder-file',$row['id'].'-folder').'"><i class="fas fa-download"></i><br></a>';

                  return $html_string;  

           }else{    
                  $html_string = '<a class="nav-link" href="'.route('download-folder-file',$row['id'].'-file').'"><i class="fas fa-download"></i><br></a>';

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

   public function OrderData(Request $request){

     // dd($request->all());

   }


}
