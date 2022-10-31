<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;

class UserController extends Controller
{
    public function index(){
        return view('hi');
    }
    public function upload(Request $request){
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
         ]);
 
         $fileUpload = new post;
 
         if($request->file()) {
             $file_name = time().'_'.$request->file->getClientOriginalName();
             $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
 
             $fileUpload->name = time().'_'.$request->file->getClientOriginalName();
             $fileUpload->path = '/storage/' . $file_path;
             $fileUpload->save();
 
             return response()->json(['success'=>'File uploaded successfully.','data'=>$file_name ]);
         }
         return response()->json(['success'=>'File uploaded successfully.','data'=>$request ]);
    }

}
