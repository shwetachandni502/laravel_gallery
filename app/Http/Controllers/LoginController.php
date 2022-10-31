<?php

namespace App\Http\Controllers;

use App\login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
