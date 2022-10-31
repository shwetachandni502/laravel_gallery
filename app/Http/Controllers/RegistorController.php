<?php

namespace App\Http\Controllers;

use App\login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class RegistorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    public function regi(){
        return view('regi');

    }
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'repass' => 'required|same:password'
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user =new login;
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->password=$request['password'];
        $user->stusts=1;
        $user->save();
        if($user){
            return "kslfks";
        }
        // $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        // $response = ['token' => $token];
        // return response($response, 200);
    }
    public function api(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'repass' => 'required|same:password'
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user =new login;
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->password=$request['password'];
        $user->stusts=1;
        $user->save();
        // $user = login::create([
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'password' =>  $request['password'],
        //     'stusts' =>1
        // ]);
        $token = Str::random(30);
        $response = ['token' => $token];
        return response($response, 200);
    }


    public function api1(Request $request){
        $response = ['token' => $request->all()];
        return response($response, 200);
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


    public function login(Request $request){
        // $request->validate([
        //     'email' => 'required|string|email|max:255',
        //     'password' => 'required',
        // ]);

        // $project1 = login::where('email',$request->email)->where('password',$request->password)->first();
        // if($project1){
        //     $all['stusts']=1;
        //     $data=login::where('id',$project1['id'])->update($all);
        //         if($data){
        //             $project2 = login::where('email',$request->email)->where('password',$request->password)->first();
        //             // $project1[0]['token']= Str::random(30);
        //             $token= Str::random(30);
        //             return response(["data"=>$project2,"token"=>$token]);

        //         } else{
        //             return response([ 'errors' => 'not data update'],422);
        //         }
        //  }
        //  else{
        //     return response([ 'errors' => [ "dataerorr"=>'please Enter valid user and password']],422);
        //  }

                    // return response([ 'errors' => $request->name],422);
                    if(isset($request->name)){
                        $request->validate([
                            'name' => 'required|string|max:255',
                            'email' => 'required|string|email|max:255|unique:logins',
                            'password' => 'required',
                            'repass' => 'required|same:password'
                            ]);
                    }
                    
        if($request->name != "" ){
            // $validator= $request->validate([
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:logins',
            // 'password' => 'required',
            // 'repass' => 'required|same:password'
            // ]);
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:logins',
                'password' => 'required',
                'repass' => 'required|same:password'
            ]);
            if ($validate->fails()) {
                return response()->json(["errors" => $validate->errors()],401);
            }
            $user =new login;
            $user->name=$request['name'];
            $user->email=$request['email'];
            $user->password=$request['password'];
            $user->stusts=1;
            $user->save();
            if($user){
                $project2 = login::where('email',$request->email)->where('password',$request->password)->first();
                 
           // $project1[0]['token']= Str::random(30);
                    $token= Str::random(30);
                    return response(["data"=>$project2,"token"=>$token]);
            }
            else{
                return response([ 'errors' => 'not data update'],422);
            }
            
        }
        else{
            $request->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required',
            ]);
            $project1 = login::where('email',$request->email)->where('password',$request->password)->first();
        if($project1){
            $all['stusts']=1;
            $data=login::where('id',$project1['id'])->update($all);
                if($data){
                    $project2 = login::where('email',$request->email)->where('password',$request->password)->first();
                 
           // $project1[0]['token']= Str::random(30);
                    $token= Str::random(30);
                    return response(["data"=>$project2,"token"=>$token]);

                } else{
                    return response([ 'errors' => 'not data update'],422);
                }
         }
         else{
            return response([ 'errors' => [ "dataerorr"=>'please Enter valid user and password']],422);
         }
        }
        
        
        







}

public function logout(Request $request){
   
    $project1 = login::where('email',$request->email)->get();
    if(!empty($project1)){
        $all['stusts']=0;
        $data=login::where('id',$project1[0]['id'])->update($all);
            if($data){
                // $project1[0]['token']= Str::random(30);
              
                return response(["data"=>$data]);

            } else{
                return response([ 'error' => 'not data update']);
            }
     }
     else{
        return response([ 'error' => 'invalid user']);
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
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:logins',
        //     'password' => 'required',
        //     'repass' => 'required|same:password'
        // ]);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:logins',
            'password' => 'required',
            'repass'=>'required|same:password'
        ]);
        
        $user =new login;
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->password=$request['password'];
        $user->stusts=1;
        $user->save();
        // $user = login::create([
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'password' =>  $request['password'],
        //     'stusts' =>1
        // ]);
        
        return response($user, 200);
    }


    public function profile(Request $request){
        
        $project1 = login::where('email',$request->email)->first();
        // return response($request->file,422);
        if( $project1){
            if(!empty($request->file()) ) {
                if(file_exists(public_path($project1->path)) && !empty($project1->path)){
                    unlink(public_path($project1->path));
                  }
                $file_name = time().'_'.$request->file('file')->getClientOriginalName();
                $file_path = $request->file('file')->storeAs('post', $file_name, 'public');
                $all['img'] = $file_name;
                $all['path'] = '/storage/' . $file_path;
            }
            $all['name']=$request->name;
            $all['phone']=$request->phone;
            $all['city']=$request->city;
            $all['state']=$request->state;
            $all['country']=$request->city;
            // $all['gender']=$request->gender;
            $all['DOB']=$request->DOB;
            $data=login::where('id',$project1->id)->update($all);
            if($data){
                $project2 = login::where('email',$request->email)->first();
                return response(["data"=>$project2],200);

            } else{
                return response([ 'errors' => [ "dataerorr"=>'not update data']],422);
        
                }
        }
        else{
            return response([ 'errors' => [ "dataerorr"=>'envalid User Email']],422);
         }
    }


    public function getsingledata(Request $request ,$id){
        
        $project1 = login::where('id',$id)->first();
        if($project1){
            return response(["data"=>$project1],200);
        }
        else{
            return response([ 'errors' => [ "dataerorr"=>'envalid User login']],422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit(login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy(login $login)
    {
        //
    }
}
