<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Department;
use App\Models\dm_company;
use App\Models\DmAudit;
use App\Models\Section;
use App\Models\dm_unit;
use App\Models\DmFileUpload;
use Illuminate\Support\Facades\Hash;
use App\Models\DmSection;
use DataTables;
use Auth;
use View;
use Carbon\Carbon;
use PhpParser\Node\Stmt\TryCatch;

class AccountController extends Controller
{
        public function index(){    
        $roles = Role::where('id', '!=', 4)->get();
        $users = User::where('role_id', '!=', 4)->get();
        $companies = dm_company::orderBy('id', 'DESC')->get();
        $units = dm_unit::orderBy('id', 'DESC')->get();
        $departments = department::orderBy('id', 'DESC')->get();
        $sections = Section::orderBy('id', 'DESC')->get();
     	  return view('account.users',compact('roles','users','companies','units','departments','sections'));
     }

     public function store(Request $request)
    {
        //dd($request['company'].$request['unit'].$request['department'].$request['section']);
        try {
        $user = new User ();
        $user->name = $request['fname']." ".$request['lname'];
        $user->email = $request['email'];
        $user->role_id = $request['role'];
        $user->company_id = $request['company'];
        $user->company_branch_id = $request['unit'];
        $user->department_id =  $request['department'];
        $user->section_id = $request['section'];
        $user->password = Hash::make($request['password']);
        $user->save();
       } catch (\Exception $err) {
         return $err->getMessage();
       }

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
        $units = dm_unit::orderBy('id', 'DESC')->get();
        return view('account.department', compact('units'));
     }

     public function departmentData(){


        $departments = Department::orderBy('id', 'DESC')->get();

        return Datatables::of($departments)

        ->addColumn('name', function($row){
           return $row->name;         
       })

        ->addColumn('unit', function($row){
           return $row->unit->unit_name;         
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
        if(!Department::where('name', $request->name)->exists()){

            $create = new Department ();
            $create->name = $request->name;
            $create->unit_id = $request->unit;
            $create->save();
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false]);

    }

     public function section(){     
        //dd('innnn');
        $departments = Department::all();
        $units = dm_unit::all();
        //return view('account.section',[compact('departments'),compact('units')]);
        return View::make('account.section')
          ->with(compact('departments'))
          ->with(compact('units'));
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
        if(!Section::where('name', $request->name)->exists()){
            $create = new Section ();
            $create->name = $request->name;
            $create->unit_id = $request->unit;
            $create->department_id = $request->department;
            $create->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function unit(){     
        return view('account.unit');
     }

     public function unitData(){

        $units = dm_unit::orderBy('id', 'DESC')->get();

        return Datatables::of($units)

        ->addColumn('name', function($row){
           return $row->unit_name;         
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
    public function storeUnit(Request $request)
    {
        if(!dm_unit::where('unit_name', $request->name)->exists()){

            $create = new dm_unit ();
            $create->unit_name = $request->name;
            $create->save();
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false]);

    }

     

}
