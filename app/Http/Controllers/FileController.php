<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DmFileUpload;
use App\Models\DmSection;
use App\Models\DmFileTagging;
use App\Models\DmFolderColumn;
use App\Classes\Audits;
use App\Models\DmMetaTagging;
use App\Models\DmAudit;
use App\Models\DmRentention;
use App\Models\ApprovalStatus;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class FileController extends Controller
{
     public function index($id){
     
        $file = DmFileUpload::where('id', $id)->first();

        $fileRetention = DmRentention::where('file_id', $id)->first();
        // dd($fileRetention);
        $retention_end = 0;
        if($fileRetention != null){
          $val = $fileRetention->count_value.' '.'days';
          $date=date_create($fileRetention->created_at);
          date_add($date,date_interval_create_from_date_string($val));
          $date->setTimezone(new \DateTimeZone('Asia/Karachi'));
          $retention_end = date_format($date,"Y-m-d, H:i:s");
        }


        $folcols = DmFolderColumn::where('folder_id', $file->folder_id)->get();

        $file_audits = DmAudit::where('object', $id)->where('object_type',2)->orderBy('id', 'DESC')->get();
        // dd($folcols);
        $fname = DmSection::find($file->folder_id);
        // dd($file);
        $fileScans = DmFileTagging::where('file_scan_id',$id)->where('folder_id', $file->folder_id)->get();

        // dd($fileScans);

        $approved = ApprovalStatus::where(['file_id'=>$id,'approval_status'=>1])->get();

        $approve_status = "";

        if($approved->isEmpty()){
          $approve_status = 1;
          // dd("d");
        }else{
          $approve_status = 0;
          // dd("nd");
        }  


        $id = $file->folder_id;

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
     	return view('file.view', compact('parents','file','fileScans','fname','folcols','file_audits','retention_end','approve_status'));
     }

    public function EditView($id){
         // dd($id);

        // dd('here');
        $fileid = $id;
        $file = DmFileUpload::where('id', $id)->first();

         //dd($file);
        $editfiles = DmFileTagging::where('file_scan_id',$id)->where('folder_id', $file->folder_id)->get();

        $editcols = DmFolderColumn::where('folder_id', $file->folder_id)->get();
        $file_name = pathinfo($file->doc_name, PATHINFO_FILENAME);
        $file_ext = pathinfo($file->doc_name, PATHINFO_EXTENSION);
        // $fileScan = DmFileTagging::where('file_scan_id',$id)->first();
        // dd($fileScan);
        $id = $file->folder_id;

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
      return view('file.edit', compact('parents','file','file_name','file_ext','fileid','editcols','editfiles'));


    }  

    public function Editfile(Request $request){
         //dd($request->all());  

      $file = DmFileUpload::find($request->file_id);
      $fcols = DmFolderColumn::where('folder_id', $file->folder_id)->get();
      $name_ext= $request->doc_name.''.$request->file_ext;
      $fileScan = DmFileTagging::where('file_scan_id',$request->file_id)->get();
      // dd($fileScan);
      $fid = DmSection::where('id',$file->folder_id)->first();            
      $path = 'storage/'.$fid->description.'/'.$name_ext;     
      // rename($file->doc_path, $path);
      $file->doc_name = $name_ext;
      $file->doc_path = $path;
      $file->tags = $request->doc_tag;
      $file->date = $request->date ;
      $file->due_date = $request->due_date ;
      $file->note = $request->note;
      //dd($request->note);
      $file->save();
if(!$fcols->isEmpty()){
      if($fileScan == null){
         foreach($request->meta as $key => $meta){
          $filetag = new DmFileTagging();
          $filetag->file_scan_id  = $request->file_id;
          $filetag->folder_id  = $file->folder_id;
          $filetag->meta_tag_id = $key;
          $filetag->meta_tag_value = $meta;
          $filetag->save(); 

        }

      }else{

         foreach($request->meta as $key => $meta){
          $filetag = DmFileTagging::where('file_scan_id',$request->file_id)->where('folder_id', $file->folder_id)->where('meta_tag_id', $key)->first();

          if($filetag == null){
          $filetag = new DmFileTagging();
          $filetag->file_scan_id  = $request->file_id;
          $filetag->folder_id  = $file->folder_id;
          $filetag->meta_tag_id = $key;
          $filetag->meta_tag_value = $meta;
          $filetag->save(); 
          }else{

             $filetag->file_scan_id  = $request->file_id;
          $filetag->folder_id  = $file->folder_id;
          $filetag->meta_tag_id = $key;
          $filetag->meta_tag_value = $meta;
          $filetag->save(); 


          }

        }
      }
    }

      

       return response()->json(['fileid'=>$request->file_id]);
    }

    public function FileDownload($id){
      //dd($id);

       $params = ['objtype'=> 2,'obj_id'=>$id,'obj'=>$id,
      'action'=>trans('global.file.dn')];
      $activity =  Audits::getAudit($params);


      $file = DmFileUpload::where('id', $id)->first();
      // dd($file->doc_path);
      $path = $file->doc_path;
      return response()->download($path);

     
    }


    public function FileFolderDownload($id){

     
      $str = $id;
      $idexplode = explode("-",$str);

      // dd($idexplode[1]);

      if($idexplode[1] == 'file'){

      $params = ['objtype'=> 2,'obj_id'=>$idexplode[0],'obj'=>$idexplode[0],
      'action'=>trans('global.file.dn')];
      $activity =  Audits::getAudit($params);


        $file = DmFileUpload::where('id', $idexplode[0])->first();
        $path = $file->doc_path;

        return response()->download($path);
      }else{


        $folder = DmSection::where('id', $idexplode[0])->first();




        $zip_file = $folder->description.'.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $path = 'storage/'.$folder->description;
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        foreach ($files as $name => $file)
        {
            // We're skipping all subfolders
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                // extracting filename with substr/strlen
                $relativePath = 'invoices/' . substr($filePath, strlen($path) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
        return response()->download($zip_file);



      }
      
    }

    public function DeleteFile(Request $request){
       $now = Carbon::now();
     // $todayDate = Carbon::now()->format('d-m-y H:i:m');
        // dd($todayDate);
      // dd($request->all());
      $file = DmFileUpload::where('id', $request->file_del)->first();
      // dd($file);
      $file->is_delete = 1;
      $file->deleted_at = $now;
      $file->save();

      return response()->json(['folderid'=>$file->folder_id]);
    } 

   public function FileRetention(Request $request){
      // dd($request->all());

      $string = $request->file_ids;
      $ids_arr = explode (",", $string); 

      //  1 for days, 2 for weeks, 3 for months, 4 for years

      if($request->time_period == 1){
        $count_value = $request->count_value;

      }elseif($request->time_period == 2){
        $count_value = $request->count_value * 7;

      }elseif($request->time_period == 3){
        $count_value = $request->count_value * 30;

      }elseif($request->time_period == 4){
        $count_value = $request->count_value * 365;

      }

     foreach($ids_arr as $arr){
        $fileRe = DmRentention::where('file_id',$arr)->first();
        if($fileRe != null){
           $fileRe->file_id = $arr;
           $fileRe->count_value = $count_value;
           $fileRe->description = $request->time_period;
           $fileRe->save();

        }else{
           $fileRe = new DmRentention();
           $fileRe->file_id = $arr;
           $fileRe->count_value = $count_value;
           $fileRe->description = $request->time_period;
           $fileRe->save();

        }
     
     }


   } 


   public function MoveFile(){
     echo 'hy';
   }

   public function LockFile(Request $request){
    $file = DmFileUpload::where('id', $request->file_id)->first();

    $approved = ApprovalStatus::where(['file_id'=>$request->file_id,'approval_status'=>1])->get();

    if($approved->isEmpty()){
      $file->file_locked = 1;
      $file->save();
    }    
  }

  public function UnlockFile(Request $request){
    $file = DmFileUpload::where('id', $request->file_id)->first();
    $file->file_locked = 0;
    $file->save();
  }

  public function UpdateImageFile(Request $request){

    //dd($request->all());
    $request->validate([
      'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);
      if($request->hasFile('image')) {
        $fileSize = $request->image->getSize();

        $file = DmFileUpload::where('id', $request->file_id)->first();
        $name = $request->image->getClientOriginalName();
      // $path = $file->move(public_path() . '/file_uploads/', $name);
        $path = $request->image->storeAs($request->folder_des, $name, 'public');
        $file->doc_name =  $name;

        $file->file_size =  $fileSize / 1000;
        $file->doc_path = 'storage/'.$path;
        $file->save();
    }
  }
}
