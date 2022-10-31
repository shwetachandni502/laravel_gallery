<?php

namespace App\Http\Controllers;

use App\userdata;
use Illuminate\Http\Request;
use App\Rules\Inputvalue;
class UserdataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phonebook = userdata::all();
        return response()->json($phonebook, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all(), 200);
        $request->validate([
            'name' => ['required',new Inputvalue],
            'email' => ['required','email','unique:userdats',new Inputvalue],
            'gender' => ['required',new Inputvalue],
            'city' => ['required',new Inputvalue],
            'state' => ['required',new Inputvalue],
            'DOB' => ['required',new Inputvalue],
            
        ]);
        $user=new userdata;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->DOB=$request->DOB;
        $user->city=$request->city;
        $user->state=$request->state;
        $user->gender=$request->gender;
        $user->save();
        if($user){
            return response()->json(["data"=>"save data"], 200);

        }
        else{
        return response()->json(["data"=>"not save data"], 200);

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\userdata  $userdata
     * @return \Illuminate\Http\Response
     */
    public function show(userdata $userdata)
    {
        return response()->json($r->id, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\userdata  $userdata
     * @return \Illuminate\Http\Response
     */
    public function edit(userdata $userdata,$id,Request $r)
    {
        if($id){
            $data=userdata::where('id',$id)->first();
            if($data){
               
                    return response()->json($data, 200);
        
            }
            else{
                return response()->json(["data"=>"not user found"], 200);
    
            }
        }
        else{
            return response()->json(["data"=>"not user found"], 200);

        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\userdata  $userdata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, userdata $userdata,$id)
    {
        // return response()->json($request->all(), 200);
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'gender' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'DOB' => ['required'],
            
        ]);
        $data=userdata::where('id',$id)->first();
            if($data){
               
                   $all['name']=$request->name;
                   $all['email']=$request->email;
                   $all['gender']=$request->gender;
                   $all['city']=$request->city;
                   $all['state']=$request->state;
                   $all['DOB']=$request->DOB;
                   $datas=userdata::where('id',$id)->update($all);
                   if($datas){
                return response()->json(["data"=>" user data update found"], 200);

                   }
                   else{
                return response()->json(["data"=>"not user data updated"], 200);

                   }
        
            }
            else{
                return response()->json(["data"=>"not user found"], 200);
    
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\userdata  $userdata
     * @return \Illuminate\Http\Response
     */
    public function destroy(userdata $userdata,$id)
    {
        $phonebook = userdata::destroy($id);
        if($phonebook){
            return response()->json(["data"=>" delete data"], 200);
        }else{
        return response()->json(["data"=>"not delete data"], 200);
        }
    }
}
