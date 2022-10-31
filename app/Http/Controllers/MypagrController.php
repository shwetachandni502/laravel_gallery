<?php

namespace App\Http\Controllers;
use App\mypagr;
use App\Rules\Inputvalue;
use Illuminate\Http\Request;

class MypagrController extends Controller
{
    public function index($term = null){
        if ($term != null) {
            $phonebook = mypagr::where('name', 'like', '%'.$term.'%')->get();
            
            return response()->json($phonebook, 200);
            
        }else{
            return $this->_allRecord();
        }

        
    }

    public function alldata(){
        $phonebook = mypagr::all();
        return response()->json($phonebook, 200);
    }

    private function _allRecord()
    {
        $phonebook = mypagr::latest()->paginate(5);
        return response()->json($phonebook, 200);
    }

    public function edit(mypagr $phonebook,$id)
    {
        $phonebook1 = mypagr::where('id', $id)->get();
        return response()->json($phonebook1, 200);
    }

    public function store(Request $request)
    {
        // if($request->name="undefined"||$request->email="undefined"||$request->file="undefined"||$request->phone="undefined"){
        //     return response()->json(['data'=>'All Filed Are requid']);
        // }
        // return response()->json( $request->file());
      $request->validate([
            'name' => ['required','min:6',new Inputvalue],
            'email' => ['required','email','unique:mypagrs',new Inputvalue],
            'phone' => ['required','min:7',new Inputvalue],
            'file'=>['required','image','mimes:jpeg,png,jpg,gif,svg','max:50000',new Inputvalue]
        ]);
        
        
        $user =new mypagr; 
        if($request->file()) {
            $file_name = time().'_'.$request->file('file')->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

            $user->img = $file_name;
            $user->parth = '/storage/' . $file_path;
        }
           
           
            
          
            
        
        
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->save();

        return $this->_allRecord();
    }
    public function destroy(mypagr $mypagr,$page)
    {
        $project = mypagr::find($page);
        if(!empty($project)){
            if(file_exists(public_path($project->parth))){

                unlink(public_path($project->parth));
          
              }
            $data=mypagr::destroy($page);
            if($data){
                return $this->_allRecord();

            } else{
                return response([ 'message' => 'not data delete']);
        
                }
        }

        else{
            return response([ 'message' => 'not data found']);
    
            }
        // if (mypagr::destroy($mypagr)) {
        //    
        // } else {
        //     return response()->json(425, ['delete' => 'Error deleting record']);
        // }
    }

    public function update(Request $request, mypagr $mypagr,$id)
    {
        $request->validate([
             'name' => ['required','min:6',new Inputvalue],
            'email' => ['required','email',new Inputvalue],
            'phone' => ['required','min:7',new Inputvalue]
        ]);
        $project1 = mypagr::where('id',$id)->get();
        if(!empty($project1)){
           
            if(!empty($request->file()) ) {
                
                if(file_exists(public_path($project1[0]->parth))){

                    unlink(public_path($project1[0]->parth));
              
                  }
                $file_name = time().'_'.$request->file('file')->getClientOriginalName();
                $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
                $all['img'] = $file_name;
                $all['parth'] = '/storage/' . $file_path;
            }
            $all['name']=$request->name;
            $all['phone']=$request->phone;
            $all['email']=$request->email;
            $data=mypagr::where('id',$id)->update($all);
            if($data){
                return $this->_allRecord();

            } else{
                return response([ 'message' => 'not data update']);
        
                }
        }
        else{
            return response([ 'message' => 'not data found']);
    
            }
    }


}
