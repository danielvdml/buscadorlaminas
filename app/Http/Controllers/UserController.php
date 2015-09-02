<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class UserController extends Controller
{
    public function index()
    {
        return view('RegistrarUsuario');
    }

    public function crearUsuario(Request $request)
    {
        
        User::create([
            'username' => $request->input('username'),   
            'email' =>  $request->input('email'),
            'password' => bcrypt( $request->input('password'))
        ]);

        return redirect('/');
    }
}
