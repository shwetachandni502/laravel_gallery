<?php

namespace App\Http\Controllers;
use App\userdata;
use App\allprofile;
use Illuminate\Http\Request;
use App\Rules\Inputvalue;
use App\login;
class AllprofileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phonebook = allprofile::all();
        return response()->json($phonebook, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $r)
    {
        $phonebook = allprofile::where('userid',$r->id)->get();
        if(!empty($phonebook)){
            return response()->json($phonebook, 200);
        }else{
            return response()->json(['data',"not data this user"],422);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => ['required','min:6'],
        //     'detail' => ['required','min:6'],
        //     'title' => ['required','min:6'],
        //     'file'=>['required','image','mimes:jpeg,png,jpg,gif,svg','max:50000']
        // ]);
        $request->validate([
            'name' => ['required','min:6',new Inputvalue],
            'detail' => ['required','min:6',new Inputvalue],
            'title' => ['required','min:6',new Inputvalue],
            'file'=>['required','image','mimes:jpeg,png,jpg,gif,svg','max:50000',new Inputvalue],
        ]);
        $user =new allprofile;
        if($request->file()) {
            $file_name = time().'_'.$request->file('file')->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('allpost', $file_name, 'public');

            $user->img = $file_name;
            $user->parth = '/storage/' . $file_path;
        }

        $user->name=$request->name;
        $user->detail=$request->detail;
        $user->title=$request->title;
        $user->userid=$request->userid;
        $user->save();
           if($user){
            return response()->json($user,200);
           }
           else{
            return response()->json(['data',"not insert data"],422);
           }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\allprofile  $allprofile
     * @return \Illuminate\Http\Response
     */
    public function userdata(){
        $phonebook = login::all();
        return response()->json($phonebook, 200);
    }
    public function show(allprofile $allprofile,Request $r)
    { return response()->json(["data"=>$allprofile], 200);
        $phonebook = allprofile::where('userid',$allprofile)->get();
        if(!empty($phonebook)){
            return response()->json($phonebook, 200);
        }else{
            return response()->json(['data',"not data this user"],422);
        }
    }
    public function updates(allprofile $allprofile,Request $r)
    { 
        $phonebook = allprofile::where('userid',$r->id)->get();
        if(!empty($phonebook)){
            // foreach($phonebook as $value){
                
            //     $newpo= unserialize($value['img']);
            // }
            return response()->json($phonebook, 200);
        }else{
            return response()->json(['data',"not data this user"],422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\allprofile  $allprofile
     * @return \Illuminate\Http\Response
     */
    public function edit(allprofile $allprofile,$id)
    {
        
        $phonebook = allprofile::where('id',$id)->get();
        return response()->json(["data"=>$phonebook], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\allprofile  $allprofile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, allprofile $allprofile)
    {
        
    }
    public function editpostdata(Request $request,$id)
    { 
        
        $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'required',
            'title' => 'required'
        ]);
       
        $project = allprofile::find($id);
        
       
        $newdats= json_decode($project->img);
     
        if(!empty($project)){
            
            
           
            if($request->hasFile('file')) {
                foreach($request->file('file') as $files)
                {
                     $file_name = time().'_'.$files->getClientOriginalName();
                    $file_path = $files->storeAs('multiuplode', $file_name, 'public');
                    $imgData[] =$file_name;  
                    $newarray=  array_push($newdats,$file_name);
                    
                }
            }
                var_dump($newdats);
                 if($request->checkboxvalue && !empty($request->checkboxvalue)){
                $checkinput= explode(",",$request->checkboxvalue);
               
                foreach($checkinput as $value){
                    if(file_exists(public_path("storage/multiuplode/".$value))){
                        if (($key = array_search($value, $newdats)) !== false) {
                            unset($newdats[$key]);
                           $c= array_values($newdats);
                           $newdats=$c;
                        }
                        // $newdats= array_diff($newdats, $checkinput);
                        unlink(public_path("storage/multiuplode/".$value));
                  
                      }
                }

            }

          
        

              
                
           
            $all['img'] =json_encode( $newdats) ;
           
               
            

            $all['name']=$request->name;
            $all['title']=$request->title;
            $all['detail']=$request->detail;
            $data=allprofile::where('id',$id)->update($all);
            if($data){
                $project1 = allprofile::find($id);
                return response()->json(["data"=>$project1], 200);

            } else{
                return response([ 'message' => 'not data update'],422);
        
                }
           
        }
        else{
            return response()->json(["data"=>"not found data"], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\allprofile  $allprofile
     * @return \Illuminate\Http\Response
     */
    public function destroy(allprofile $allprofile ,Request $request,$id)
    {
        $project = allprofile::find($id);
        
      

        if(!empty($project)){
            foreach(json_decode($project->img) as $value){
            
                if(file_exists(public_path("storage/multiuplode/".$value))){
    
                    unlink(public_path("storage/multiuplode/".$value));
              
                  }
            }
            $data=allprofile::destroy($id);
            if($data){
                return response()->json([ 'data' => ' data delete'],200);
            } else{
                return response()->json([ 'data' => ' data not delete'],422);
            }
            }
            else{
                return response()->json([ 'data' => 'not data found'],422);
            }
       
    }
    public function demoprofile(Request $request){
        // var_dump($request->file('file'));
       
        $request->validate([
            'name' => ['required','min:6',new Inputvalue],
            'detail' => ['required','min:6',new Inputvalue],
            'title' => ['required','min:6',new Inputvalue],
            'file'=>['required',new Inputvalue],
        ]);
        $user =new allprofile;
        if($request->hasFile('file')) {
            foreach($request->file('file') as $files)
            {
                 $file_name = time().'_'.$files->getClientOriginalName();
                $file_path = $files->storeAs('multiuplode', $file_name, 'public');
                $imgData[] =$file_name;  
                
            }
   
        
        $user->img =json_encode( $imgData) ;
       
        $convert=serialize($imgData);
           
        }
        $user->name=$request->name;
        $user->detail=$request->detail;
        $user->title=$request->title;
        $user->userid=$request->userid;
        $user->save();
           if($user){
            $project = allprofile::find($user->id);
            //   $newpo= unserialize($project->img);
            //    return $user->id;
            return response()->json($project,200);
           }
           else{
            return response()->json(['data',"not insert data"],422);
           }
    }






    public function editpostdata1(Request $request){
        
        var_dump($request->file());
        $request->validate([
            'name' => ['required','min:6',new Inputvalue],
            'detail' => ['required','min:6',new Inputvalue],
            'title' => ['required','min:6',new Inputvalue],
            'file'=>['required',new Inputvalue],
        ]);
        $user =new allprofile;
        if($request->file) {  
            $a=$request->file;
            foreach($request->file as $files)
            {
               echo  $file_name = time().'_'.$files->getClientOriginalName();
                // $file_path = $files->storeAs('multiuplode', $file_name, 'public');
                $imgData[] =$file_name;  
                // $file_path1[] =  '/storage/' . $file_path;   
            }
      
      die();
        // return response()->json([$imgData,$file_path1],422);
        // $newimg=implode(",",$imgData);
        // $newimg1=implode(",",$file_path1);
        $user->img = serialize($imgData);
        $user->parth = serialize($file_path1);
        $convert=serialize($imgData);
        // $user->parth= $newimg1;
           
        }
        $user->name=$request->name;
        $user->detail=$request->detail;
        $user->title=$request->title;
        $user->userid=$request->userid;
        $user->save();
           if($user){
            //    unserialize($convert);
            //    return $user->id;
            return response()->json($user,200);
           }
           else{
            return response()->json(['data',"not insert data"],422);
           }
    }

        public function search(Request $r,$data=null){
          
            if($data != null){
                $phonebook = allprofile::where('title', 'like', '%'.$data.'%')->get();
            
                return response()->json($phonebook, 200);
            }
            else{
            return $this->index();
           
            }
        }

        public function deleteuser(Request $r ,$id){
            $phonebook = userdata::destroy($id);
            if($phonebook){
                return response()->json(["data"=>" delete data"], 200);
            }else{
            return response()->json(["data"=>"not delete data"], 200);

            }
            
        }



}
