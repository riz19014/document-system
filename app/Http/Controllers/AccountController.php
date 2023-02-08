<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Department;
use App\Models\DmAudit;
use App\Models\Section;
use App\Models\DmFileUpload;
use Illuminate\Support\Facades\Hash;
use App\Models\DmSection;
use DataTables;
use Auth;
use Carbon\Carbon;

class AccountController extends Controller
{
     
     public function index(){

         
        $roles = Role::all();
        $users = User::where('role_id', '!=', 1)->get();
        // dd($users);
     	return view('account.users',compact('roles','users'));
     }

     public function store(Request $request)
    {
        // dd($request->all());
        $user = new User ();
        $user->name = $request['fname']." ".$request['lname'];
        $user->email = $request['email'];
        $user->role_id = $request['role'];
        $user->password = Hash::make($request['password']);
        $user->save();

    }

     public function AuditView(){

        
        return view('account.audit');
     }

      public function AuditRecord(){


        $audits = DmAudit::orderBy('id', 'DESC')->get();

        return Datatables::of($audits)


        ->addColumn('date', function($row){
           return Carbon::parse( $row->date )->timezone('Asia/Karachi')->format('d.m.y | H:i:s');      
     })

        ->addColumn('user', function($row){
           return $row->User->email;         
     })

        ->addColumn('obj_type', function($row){
               if($row->object_type == 1){
                return 'Folder';
             }elseif($row->object_type == 2){
                return 'File';
             }else{
                return 'Account';
             }        
     })

        ->addColumn('object', function($row){
            if($row->object_type == 2){
                $file = DmFileUpload::find($row->object_type);
                return $file->doc_name;

            }elseif($row->object_type == 1){
                $folder = DmSection::find($row->object_type);
                return $folder->description;

            }elseif($row->object_type == 3){
                return Auth::user()->name;

            }
                 
     })

        ->addColumn('action', function($row){

             return $row->action;



                // $status_btn .= $row->action.' '.'<a style="color: #1ea1d7;" href="'.route('folder-index',$row['object_id']).'">'.$row->Object->.'</a>';
                

             // return $status_btn;  
                
     })
     ->rawColumns(['action'])
          ->make(true);



        
     }

     public function FolderAuditView($id){

          // dd($id);
          $folder_audits = DmAudit::where('object', $id)->where('object_type',1)->orderBy('id', 'DESC')->get();

          return view('folder.audit',compact('folder_audits'));
     }

     public function department(){

        return view('account.department');
     }

     public function departmentData(){


        $departments = Department::orderBy('id', 'DESC')->get();

        return Datatables::of($departments)


        

        ->addColumn('name', function($row){
           return $row->name;         
       })

        ->addColumn('created_at', function($row){
           return Carbon::parse( $row->created_at )->timezone('Asia/Karachi')->format('d.m.y | H:i:s');      
       })

        ->addColumn('action', function($row){

              $html_string = '<a class="nav-link delDepartment" title="Delete Department" style="cursor:pointer" data-name="'.$row->name.'"  data-id="'.$row->id.'"><i class="fas fa-trash"></i><br></a>';

              return $html_string;
                
       })
     ->rawColumns(['action'])
          ->make(true);



        
     }
    public function storeDepartment(Request $request)
    {
        // dd($request->all());
        if(!Department::where('name', $request->name)->exists()){

            $create = new Department ();
            $create->name = $request->name;
            $create->save();
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false]);

    }

     public function section(){     
        $departments = Department::all();
        return view('account.section',compact('departments'));
     }

     public function sectionData(){


        $sections = Section::orderBy('id', 'DESC')->get();

        return Datatables::of($sections)


        

        ->addColumn('name', function($row){
           return $row->name;         
       })

        ->addColumn('department', function($row){
           return $row->department->name;         
       })

        ->addColumn('created_at', function($row){
           return Carbon::parse( $row->created_at )->timezone('Asia/Karachi')->format('d.m.y | H:i:s');      
       })

        ->addColumn('action', function($row){

              $html_string = '<a class="nav-link delDepartment" title="Delete Department" style="cursor:pointer" data-name="'.$row->name.'"  data-id="'.$row->id.'"><i class="fas fa-trash"></i><br></a>';

              return $html_string;
                
       })
     ->rawColumns(['action'])
          ->make(true);



        
     }
    public function storeSection(Request $request)
    {
        // dd($request->all());
        if(!Section::where('name', $request->name)->exists()){

            $create = new Section ();
            $create->name = $request->name;
            $create->department_id = $request->department;
            $create->save();
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false]);

    }

     

}
