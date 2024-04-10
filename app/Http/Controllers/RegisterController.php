<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request){
        // dd($request);
        // dd($request->get('username')); //pedimos el valor del atributo nombre del objeto request

        $request->request->add(['username'=> Str::slug($request->username)]);

        //validaciones

        $this->validate($request, [
            'name' => 'required|max:30', //validacion
            'username' => 'required|unique:users|min:3|max:20', //validacion
            'email' => 'required|unique:users|email|max:60', //validacion
            'password' => 'required|confirmed|min:6', //validacion

        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email'=> $request->email,
            'password' => Hash::make($request->password) 
        ]);
        // //Autenticar un usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);
        //otra forma
        auth()->attempt($request->only('email','password'));


        //redireccionar 
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
