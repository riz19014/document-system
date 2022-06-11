<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DmMetaTagging;
use App\Models\DmFileTagging;
use App\Models\DmSection;
use App\Models\DmFileUpload;
use DataTables;
use DB;

class SearchController extends Controller
{
    public function SearchQuery($query){


      

      // dd($tagsearch);




       
      $folder_search = DmSection::where('description', 'like', '%'.$query.'%')->get();


       //  $folder_search = DB::table('dm_sections')
       // ->join('dm_file_taggings', 'dm_file_taggings.folder_id', '=', 'dm_sections.id')
       // ->select('dm_sections.*', 'dm_file_taggings.*')
       // ->where('dm_sections.description', 'like', '%'.$query.'%')
       // ->orWhere('dm_file_taggings.meta_tag_value', 'like', '%'.$query.'%')
       // ->get();


 // dd($folder_search);

      $array_folder = array(); 
      $i = 0;

      foreach ($folder_search as $row_fol)
      {
          $array_folder [$i]["id"]= $row_fol->id;
          $array_folder [$i]["doc_name"]= $row_fol->description;
          $array_folder [$i]["object_type"]= $row_fol->object_type;
          $array_folder [$i]["created_at"]= $row_fol->created_at;
          $i++;
      }


      $searches = DmFileUpload::where('doc_name', 'like', '%'.$query.'%')->orWhere('tags', 'like', '%'.$query.'%')->get();



      // $searches = DB::table('dm_file_uploads')
      //  ->join('dm_file_taggings', 'dm_file_taggings.file_scan_id', '=', 'dm_file_uploads.id')
      //  ->select('dm_file_uploads.*', 'dm_file_taggings.*')
      //  ->where('dm_file_uploads.doc_name', 'like', '%'.$query.'%')
      //  ->orWhere('dm_file_uploads.tags', 'like', '%'.$query.'%')
      //  ->orWhere('dm_file_taggings.meta_tag_value', 'like', '%'.$query.'%')
      //  ->get();

       // dd($searches);




        $array_product = array(); 

      foreach ($searches as $row_pro)
      {
          $array_product [$i]["id"]= $row_pro->id;
          $array_product [$i]["doc_name"]= $row_pro->doc_name;
          $array_product [$i]["folder_id"]= $row_pro->folder_id;
          $array_product [$i]["object_type"]= 2;
          $array_product [$i]["created_at"]= $row_pro->created_at;
          $i++;
      }

      



      $tagsearch = DmFileTagging::where('meta_tag_value', 'like', '%'.$query.'%')->get();


      $array_tags = array(); 

      foreach ($tagsearch as $row_tags)
      {
          $array_tags [$i]["id"]= $row_tags->file_scan_id;
          $array_tags [$i]["doc_name"]= $row_tags->filename->doc_name;
          $array_tags [$i]["folder_id"]= $row_tags->folder_id;
          $array_tags [$i]["object_type"]= $row_tags->object_type;
          $array_tags [$i]["created_at"]= $row_tags->created_at;
          $i++;
      }


      $mix_searches = $array_folder + $array_product + $array_tags;


       return view('search.index', compact('mix_searches'));
 }

 
}















       //correct query;;;;;;

        // $resutls = DB::table('dm_sections')
        //     ->select(['id', 'description'])
        //     ->selectRaw("MATCH(description) AGAINST ('" . $query . "' IN BOOLEAN MODE) AS score")
        //     ->orderBy('score', 'desc')
        //     ->get();

        //     $result = DB::table('dm_sections')
        //     ->select(['id', 'description'])
        //     ->selectRaw("MATCH(description) AGAINST (? IN BOOLEAN MODE) AS score")
        //     ->having('score', '>', 0)
        // ->setBindings([$query])
        //     ->orderBy('score', 'desc')
        //     ->get();






            // dd($result);


//        SELECT *, MATCH (title) AGAINST ("*Director*" IN BOOLEAN MODE) as score
// FROM table_name
// ORDER BY score DESC

  

    //    $searches = DB::table('dm_sections')
    // ->MATCH('description')
    // ->AGAINST("*Director*" IN BOOLEAN MODE as score)

    // ->get();

    // dd($searches);



       //  dd($searches);
    	 // $fileUpload = DmFileUpload::all();

    	 // $uploadIds = DmFileUpload::pluck('folder_id');
    	 // dd($uploadIds);;

    	// $searches = DmSection::whereLike('description', $query)->get();

    	// $searches = DB::table('dm_sections')
     //   ->join('dm_file_uploads', 'dm_file_uploads.folder_id', '=', 'dm_sections.id')
     //   ->select('dm_sections.*', 'dm_file_uploads.*')
     //   ->where('dm_sections.description', 'like', '%'.$query.'%')
     //   ->orWhere('dm_file_uploads.doc_name', 'like', '%'.$query.'%')
     //   ->get();

     
     //   dd($searches);

     //   foreach($searches as $search){
     //   	dd($search);
     //   }

       //for file
        // $searches = DmFileUpload::where('doc_name', 'like', '%'.$query.'%')->get();
       // $values = json_decode($searches, true);
       // $parents = array();
       // $objects = array();
       // foreach($values as $key => $search){
       // 	 $id =  $search['id'];	
       //  do {
       //      $folder = DmSection::find($id);
       //      if($folder->parent_id == null){
       //         $parents[] = $folder;
       //      }else{
       //          $parents[] = $folder;         
       //      }
       //      $id = $folder->parent_id;
       //    } while ($id != null);

       //    $parents=array_reverse($parents);
       //    $objects[] = $parents;
       //    $parents = null;	

       // }

        

