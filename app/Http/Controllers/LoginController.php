<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;

class LoginController extends Controller
{
   
    public function index()
    {
        return view('login');

    }
    
    public function login(Request $request){
        if(Auth::attempt(['username'=>$request->input('username'),'password'=>$request->input("password")])) {
         return redirect('/');
        }else{
         return redirect('Login');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('Login');
    }   
}