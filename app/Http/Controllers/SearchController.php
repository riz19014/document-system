<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DmMetaTagging;
use App\Models\DmFileTagging;
use App\Models\DmSection;
use App\Models\DmFileUpload;
use DataTables;
use DB;
use App\Models\DmNumbering;

class SearchController extends Controller
{
    



        public function SearchQuery($query)
        {
           
            $folder_search = DmSection::where('description', 'like', '%' . $query . '%')->get();

            $searches = DmFileUpload::where('doc_name', 'like', '%' . $query . '%')
                ->orWhere('tags', 'like', '%' . $query . '%')
                ->get();

            $tagsearch = DmFileTagging::where('meta_tag_value', 'like', '%' . $query . '%')->get();

            $numbering_search = DmNumbering::where('numbering', 'like', '%' . $query . '%')->get();

            $folderIdsFromNumbering = $numbering_search->where('entity_type', 1)->pluck('entity_id')->toArray();
            $fileIdsFromNumbering = $numbering_search->where('entity_type', 2)->pluck('entity_id')->toArray();

            $foldersFromNumbering = DmSection::whereIn('id', $folderIdsFromNumbering)->get();

            $filesFromNumbering = DmFileUpload::whereIn('id', $fileIdsFromNumbering)->get();

            $array_folder = [];
            $i = 0;

            // Process folder search results (from description and numbering)
            foreach ($folder_search->merge($foldersFromNumbering) as $row_fol) {
                $array_folder[$i]["id"] = $row_fol->id;
                $array_folder[$i]["doc_name"] = $row_fol->description;
                $array_folder[$i]["object_type"] = $row_fol->object_type;
                $array_folder[$i]["created_at"] = $row_fol->created_at;
                $array_folder[$i]["numbering"] = $numbering_search->where('entity_id', $row_fol->id)->where('entity_type', 1)->first()->numbering ?? null; // Add numbering if available
                $i++;
            }

            $array_product = [];

            // Process file search results (from doc_name, tags, and numbering)
            foreach ($searches->merge($filesFromNumbering) as $row_pro) {
                $array_product[$i]["id"] = $row_pro->id;
                $array_product[$i]["doc_name"] = $row_pro->doc_name;
                $array_product[$i]["folder_id"] = $row_pro->folder_id;
                $array_product[$i]["object_type"] = 2;
                $array_product[$i]["created_at"] = $row_pro->created_at;
                $array_product[$i]["numbering"] = $numbering_search->where('entity_id', $row_pro->id)->where('entity_type', 2)->first()->numbering ?? null; // Add numbering if available
                $i++;
            }

            $array_tags = [];

            // Process tag search results
            foreach ($tagsearch as $row_tags) {
                $array_tags[$i]["id"] = $row_tags->file_scan_id;
                $array_tags[$i]["doc_name"] = $row_tags->filename->doc_name;
                $array_tags[$i]["folder_id"] = $row_tags->folder_id;
                $array_tags[$i]["object_type"] = $row_tags->object_type;
                $array_tags[$i]["created_at"] = $row_tags->created_at;
                $array_tags[$i]["numbering"] = $numbering_search->where('entity_id', $row_tags->file_scan_id)->where('entity_type', 2)->first()->numbering ?? null; // Add numbering if available
                $i++;
            }

            // Combine all results
            $mix_searches = array_merge($array_folder, $array_product, $array_tags);

            return view('search.index', compact('mix_searches'));
        }



 
}












