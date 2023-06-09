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

    public function index()
    {
        $roles = Role::where('id', '!=', 4)->get();
        $users = User::where('role_id', '!=', 4)->get();
        $companies = dm_company::orderBy('id', 'DESC')->get();
     	return view('account.users',compact('roles','users','companies'));
    }

    public function store(Request $request)
    {
        $user = new User ();
        $user->name = $request['fname']." ".$request['lname'];
        $user->email = $request['email'];
        $user->role_id = $request['role'];
        $user->company_id = $request['company'];
        $user->company_branch_id = $request['unit'];
        $user->department_id = $request['department'];
        $user->section_id = $request['section'];
        $user->password = Hash::make($request['password']);
        $user->save();
    }

    public function deleteUser($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back();
    }

     public function AuditView(){


        return view('account.audit');
     }

      public function AuditRecord(){


        $audits = DmAudit::orderBy('id', 'DESC')->get();

        return Datatables::of($audits)

        ->addIndexColumn()
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
                $file = DmFileUpload::find(explode('-', $row->object_id)[0]);
                return $file ? $file->doc_name : '--';
            }elseif($row->object_type == 1){
                $folder = DmSection::find($row->object_id);
                return $folder ? $folder->description:'--';

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
        $companies = dm_company::orderBy('id', 'DESC')->get();
        return view('account.department', compact('companies'));
     }

     public function departmentData(Request $request)
     {
        $departments = Department::withCount('sections')->orderBy('id', 'DESC');
        if($request->search_grid){
          $departments->where('name', 'LIKE', '%'.$request->search_grid.'%');
        }
        $departments->get();

        return Datatables::of($departments)

        ->addColumn('name', function($row){
           return $row->name;
       })

        ->addColumn('unit', function($row){
           return $row->unit->unit_name;
       })

        ->addColumn('company', function($row){
           return $row->company_id ? $row->company->company_name : '--';
       })

        ->addColumn('total_section', function($row){
           $count = '<span style="background:#108115" class="badge w-50">'.$row->sections_count.'</span>';
           return $count;
       })

        ->addColumn('created_at', function($row){
           return Carbon::parse( $row->created_at )->timezone('Asia/Karachi')->format('d.m.y | H:i:s');
       })

        ->addColumn('action', function($row){

              $html_string = '<a class="delDepartment" title="Delete Department" style="cursor:pointer" data-name="'.$row->name.'"  data-id="'.$row->id.'"><i class="fas fa-trash"></i></a><a class="viewSection" title="View sections" style="cursor:pointer;margin-left:5px" data-id="'.$row->id.'"><i class="fas fa-eye"></i></a>';

              return $html_string;

       })
     ->rawColumns(['action','total_section'])
          ->make(true);


     }

    public function storeDepartment(Request $request)
    {
        // dd($request->all());
        if(!Department::where('name', $request->name)->exists()){

            $create = new Department ();
            $create->name = $request->name;
            $create->company_id = $request->company;
            $create->unit_id = $request->unit;
            $create->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);

    }

    public function deleteDepartment(Request $request)
    {
        Department::where('id', $request->del_id)->delete();
        return response()->json(['success' => true]);

    }

     public function section(){
        $companies = dm_company::all();
        return view('account.section',compact('companies'));
     }

     public function sectionData(Request $request)
     {

        $sections = Section::withCount('users')->orderBy('id', 'DESC');
        if($request->search_grid){
          $sections->where('name', 'LIKE', '%'.$request->search_grid.'%');
        }
        $sections->get();

        return Datatables::of($sections)

        ->addColumn('name', function($row){
           return $row->name;
       })

        ->addColumn('department', function($row){
           return $row->department->name;
       })

        ->addColumn('total_user', function($row){
           $count = '<span style="background:#108115" class="badge w-50">'.$row->users_count.'</span>';
           return $count;
       })

        ->addColumn('created_at', function($row){
           return Carbon::parse( $row->created_at )->timezone('Asia/Karachi')->format('d.m.y | H:i:s');
       })

        ->addColumn('action', function($row){

              $html_string = '<a class="delSection" title="Delete Section" style="cursor:pointer" data-name="'.$row->name.'"  data-id="'.$row->id.'"><i class="fas fa-trash"></i></a><a class="viewUser" title="View users" style="cursor:pointer;margin-left:5px" data-id="'.$row->id.'"><i class="fas fa-eye"></i></a>';

              return $html_string;

       })
     ->rawColumns(['action','total_user'])
          ->make(true);
     }

    public function storeSection(Request $request)
    {
        if(!Section::where('name', $request->name)->exists()){
            $create = new Section ();
            $create->name = $request->name;
            $create->company_id = $request->company;
            $create->unit_id = $request->unit;
            $create->department_id = $request->department;
            $create->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function deleteSection(Request $request)
    {
        Section::where('id', $request->sec_id)->delete();
        return response()->json(['success' => true]);

    }

    public function unit(){
        $companies = dm_company::orderBy('id', 'DESC')->get();
        return view('account.unit',compact('companies'));
     }

     public function unitData(Request $request){

        $units = dm_unit::withCount('departments')->orderBy('id', 'DESC');
        if($request->search_grid){
          $units->where('unit_name', 'LIKE', '%'.$request->search_grid.'%');
        }
        $units->get();
        return Datatables::of($units)

        ->addColumn('name', function($row){
           return $row->unit_name;
       })

        ->addColumn('departments', function($row){
           $count = '<span style="background:#108115" class="badge w-50">'.$row->departments_count.'</span>';
           return $count;
       })

        ->addColumn('company', function($row){
           return $row->company_id ? $row->company->company_name : '--';
       })

        ->addColumn('created_at', function($row){
           return Carbon::parse( $row->created_at )->timezone('Asia/Karachi')->format('d.m.y | H:i:s');
       })

        ->addColumn('action', function($row){

              $html_string = '<a class="delUnit" title="Delete unit" style="cursor:pointer" data-name="'.$row->unit_name.'"  data-id="'.$row->id.'"><i class="fas fa-trash"></i></a><a class="viewDepartment" title="View departments" style="cursor:pointer;margin-left:5px" data-id="'.$row->id.'"><i class="fas fa-eye"></i></a>';

              return $html_string;

       })
     ->rawColumns(['action','departments'])
          ->make(true);

     }
    public function storeUnit(Request $request)
    {
        if(!dm_unit::where('unit_name', $request->name)->exists()){

            $create = new dm_unit ();
            $create->unit_name = $request->name;
            $create->company_id = $request->company;
            $create->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);

    }

    public function deleteUnit(Request $request)
    {
        dm_unit::where('id', $request->unit_id)->delete();
        return response()->json(['success' => true]);

    }


    public function company(){
        return view('account.company');
     }

     public function companyData(Request $request){

        $units = dm_company::withCount('units')->orderBy('id', 'DESC');
        if($request->search_grid){
          $units->where('company_name', 'LIKE', '%'.$request->search_grid.'%');
        }
        $units->get();
        return Datatables::of($units)

        ->addColumn('name', function($row){
           return $row->company_name;
       })

        ->addColumn('created_at', function($row){
           return Carbon::parse( $row->created_at )->timezone('Asia/Karachi')->format('d.m.y | H:i:s');
       })

        ->addColumn('total_unit', function($row){
           $count = '<span style="background:#108115" class="badge w-50">'.$row->units_count.'</span>';
           return $count;

       })

        ->addColumn('action', function($row){

              $html_string = '<a class="delCompany" title="Delete company" style="cursor:pointer" data-name="'.$row->company_name.'"  data-id="'.$row->id.'"><i class="fas fa-trash"></i></a><a class="viewUnit" title="View units" style="cursor:pointer;margin-left:5px" data-id="'.$row->id.'"><i class="fas fa-eye"></i></a>';

              return $html_string;

       })
     ->rawColumns(['action','total_unit'])
          ->make(true);




     }
    public function storeCompany(Request $request)
    {
        // dd($request->all());
        if(!dm_company::where('company_name', $request->name)->exists()){

            $create = new dm_company ();
            $create->company_name = $request->name;
            $create->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);

    }

    public function deleteCompany(Request $request)
    {
        dm_company::where('id', $request->company_id)->delete();
        return response()->json(['success' => true]);

    }

    public function getDepartments(Request $request)
    {
        $departments = Department::where('unit_id', $request->unit_id)->get();
        return json_encode(['departments' => $departments]);
    }

    public function getUnits(Request $request)
    {
        // dd($request->all());
        $units = dm_unit::where('company_id', $request->company_id)->get();
        // dd($units);
        return json_encode(['units' => $units]);
    }

    public function getSections(Request $request)
    {
        $sections = Section::where('department_id', $request->department_id)->get();
        return json_encode(['sections' => $sections]);
    }

    public function getUser(Request $request)
    {
        $users = User::where('section_id', $request->section_id)->get();
        return json_encode(['users' => $users]);
    }

    

    public function changePassword(Request $request)
    {

        if(is_null($request->get('password'))){
           return response()->json([
                'status' => false,
                'msg' => 'Password field is required.',
            ]);
        }
        if(is_null($request->get('password_confirmation'))){

            return response()->json([
                'status' => false,
                'msg' => 'Password confirmation field is required.',
            ]);

        }
        if ($request->get('password') == $request->get('password_confirmation')) {
        if(strlen($request->get('password')) < 8){
            return response()->json([
                'status' => false,
                'msg' => 'Password must be at least 8 characters',
            ]);
        }
        $user = User::find($request->userId);
        $user->password = Hash::make($request->get('password'));
        $user->save();
        return response()->json([
            'status' => true,
            'msg' => 'Your password changed successfully',
        ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'Passwords do NOT match!',
            ]);
        }
    }



}
