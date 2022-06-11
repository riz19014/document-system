<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
     public function getUploadForm()
    {
        return view('upload-image');
    }
    /**
     * Post upload form
     */
    public function postUploadForm(Request $request)
    {
        $request->validate([
            'upload.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if($request->hasFile('upload')) {
            $imageNameArr = [];
            foreach ($request->upload as $file) {
                // you can also use the original name
                $imageName = time().'-'.$file->getClientOriginalName();
                $imageNameArr[] = $imageName;
                // Upload file to public path in images directory
                $file->move(public_path('images'), $imageName);
                // Database operation
            }
        }
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageNameArr);
    }
}
