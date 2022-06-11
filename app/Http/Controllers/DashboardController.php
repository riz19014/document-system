<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DmFileUpload;
use App\Models\ApprovalStatus;
use App\Exports\DuplicateExport;
use DB;
use Excel;
use App\Models\DmRentention;

class DashboardController extends Controller
{
    
    public function index(){

    	$filecount = DmFileUpload::where('is_delete', '=', 0)->count();
    	$PendingCount = ApprovalStatus::where('approval_status',1)->count();

    	// $dup = DmFileUpload::SELECT('doc_name')
    	//         ->groupBy('id')
     //            ->having('doc_name', '>', 1)
     //            ->get();



    	// $results = DmFileUpload::whereIn('doc_name', function ( $query ) {
     //        $query->select('doc_name')->from('dm_file_uploads')->groupBy('id')->havingRaw('doc_name > 1');
     //    })->get();


     //    dd($results);


//     	$users = DmFileUpload::all();
// $usersUnique = $users->unique(['doc_name']);
// $userDuplicates = $users->diff($usersUnique);
// echo "<pre>";
// print_r($usersUnique->toArray());


$duplicates = DmFileUpload::whereIn('doc_name', function ( $query ) {
            $query->select('doc_name')->from('dm_file_uploads')->groupBy('doc_name')->havingRaw('count(*) > 1');
        })->count();

$nearing_retention = DmRentention::where('count_value', '<=', 30)->count();

$nearing = DmFileUpload::whereNotNull('date')->whereNotNull('due_date')->count();

 // dd($nearing_retention);

    	 return view('account.report', compact('filecount','duplicates','PendingCount','nearing_retention','nearing'));

    }

    public function TabsFile($tabs){
    	// dd($tabs);
    	$duplicates = DmFileUpload::whereIn('doc_name', function ( $query ) {
            $query->select('doc_name')->from('dm_file_uploads')->groupBy('doc_name')->havingRaw('count(*) > 1');
        })->get();

        $PendingFiles = ApprovalStatus::where('approval_status',1)->get();
        $retentionFiles = DmRentention::where('count_value', '<=', 30)->get();
        $nearing_files = DmFileUpload::whereNotNull('date')->whereNotNull('due_date')->get();

        // dd($nearing_files);

    	return view('account.tabs',compact('tabs','duplicates','PendingFiles','retentionFiles','nearing_files'));
    }

      public function getDuplicate()
    {
      return Excel::download(new DuplicateExport, 'duplicate.xlsx');
    }
}
