<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DmSection;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role_id == 4) {
            return redirect()->route('manage-company');
        } else {
            // return view('layouts.layout'); 
            return redirect()->route('folder-information', 1);
        }
    }

    public function folderInfo($id)
    {


        $sections = DmSection::where('is_section', 1)->orderBy('id','asc')->get();
        $totalSubFolder = DmSection::where('is_section', 0)->count();
        $files = DmSection::withCount('FolderName')->get();
        $totalFiles = $files->sum('folder_name_count');
        // dd($sections);
        return view('folder-info', compact('sections', 'id','totalSubFolder','totalFiles'));
    }
}
