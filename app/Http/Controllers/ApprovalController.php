<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ApprovalUser;
use App\Models\DmFileUpload;
use App\Models\ApprovalStatus;
use DataTables;
use Carbon\Carbon;
use Auth;


class ApprovalController extends Controller
{
    public function index(){

          $users = User::all();
          $invites = ApprovalUser::all();

          return view('approval.users',compact('users','invites'));
    }

    public function InviteUser(Request $request){

      // dd($request->all());

          $filetag = new ApprovalUser();
          $filetag->user_id  = $request->email;
          $filetag->position = ApprovalUser::max('position') + 1;
          $filetag->save(); 

          return response()->json(['data'=>1]);
    }

    public function NotifyView(){
      return view('approval.notify');
    }

    public function fileapproval(){
      $files = ApprovalStatus::where('user_id', Auth::user()->id)->where('approval_status',1)->get();
      return view('approval.filelist',compact('files'));
    }

     public function ApprovalHistory(){
      $files = ApprovalStatus::where('user_id', Auth::user()->id)->whereIn('approval_status',[2, 3])->orderBy('approval_date','DESC')->get();
      return view('approval.history',compact('files'));
    }


    public function UserData(Request $request){

     // $flags = ApprovalUser::all();

     $flags = ApprovalUser::orderBy('position', 'asc')->get();

      return Datatables::of($flags)

      ->addColumn('action', function ($row) { 

              $html_string = '<a class="nav-link delUser" title="Delete Approval User" style="cursor:pointer"  data-id="'.$row->id.'"><i class="fas fa-trash"></i><br></a>';

              return $html_string;     
   
        }) 


         ->addColumn('email', function($row){
           return $row->User->email;         
     })

        ->addColumn('created_at', function($row){
           return $row->created_at;         
     })

            ->addColumn('position', function($row){
           return $row->position;         
     })

         ->rawColumns(['action'])
          ->make(true);
       


    }

    public function deleteUser(Request $request){
      // dd($request->all());
      $user = ApprovalUser::find($request->userid);
      $pid = $user->position;
      $user->delete();
      $lowerPositions = ApprovalUser::where('position', '>', $pid)->get();
        foreach ($lowerPositions as $lowerPosition) {
            $lowerPosition->position--;
            $lowerPosition->save();
        }
    }

    public function ResoView($id){

      // dd($id);
      $status_data = ApprovalStatus::find($id);

      // dd($status_data);

      $users = ApprovalUser::all();
    
      $users_id = $users->map->only(['user_id'])->toArray();
      //dd($d);
      $app_status = ApprovalStatus::whereIn('user_id',$users_id)->where('file_id',$status_data->file_id)->get();
     
      $approval_status = $app_status->map->only(['approval_status','user_id'])->toArray();
      //dd($approval_status);
      return view('approval.resolution',compact('status_data','users','approval_status'));
     
    }

     public function ResoStatus(Request $request){

      // dd($request->all());
      $status_val = ApprovalStatus::where('file_id',$request->file)
      ->where('user_id',Auth::user()->id)->first();
      $Approval_user = ApprovalUser::where('user_id',Auth::user()->id)->first();
      $findUser = $Approval_user->position + 1;
      $AppUser = ApprovalUser::where('position',$findUser)->first();

      $status_val->approval_status = $request->btnstatus;
      $status_val->notify = 0;
      $status_val->approval_date = Carbon::now()->timezone('Asia/Karachi')->format('Y-m-d H:i:s');
      $status_val->resolution = $request->comment;
      $status_val->save();

       if($AppUser != null){
       $status = new ApprovalStatus();
       $status->file_id = $request->file;
       $status->user_id = $AppUser->user_id;
       $status->notify = 1;
       $status->save();
     }
      return response()->json(['fileId' => $request->file]);


    }
}
