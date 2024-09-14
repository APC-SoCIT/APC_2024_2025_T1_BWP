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
            'username' => 'required',
            'password' => 'required',
            'account_type' => 'required|in:member,admin', // Ensure valid account type
        ]);

        $data = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'account_type' => $request->account_type // Include account type
        ];

        User::create($data);

        return redirect()->route('login');
    }
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
