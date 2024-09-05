<?php

namespace App\Http\Controllers;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    function login(){
        return view('login');
    }
    function loginError(){
        return view('login?error');
    }
    function registration(){
        return view('registration');
    }
    function loginPost(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);
        $credentials = $request->only('username','password');
        if(Auth::attempt($credentials)){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login', http_build_query(array_merge(\Request::query(), ['error' => true])));
        }
    }
    function registrationPost(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        $data['username'] = $request->username;
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        return redirect()->route('login');
    }
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}