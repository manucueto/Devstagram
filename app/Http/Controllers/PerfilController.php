<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('perfil.index');
    }

    public function store(Request $request){

        $request->request->add(['username'=> Str::slug($request->username)]);


        $this->validate($request, [
            'username' => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20', 'not_in:twitter,editar-perfil'], //'unique:users,username,'.auth()->user()->id: Verifica que el valor del campo 'username' no esté duplicado en la tabla de usuarios ('users'). Además, se excluye el usuario actual (autenticado) para evitar conflictos con su propio nombre de usuario.
            'email' => ['required','unique:users,email,'.auth()->user()->id,'min:3','max:60'], //validacion
            // 'password_nueva' => 'nullable|min:6', //validacion


        ]);

        if($request->imagen){ //what does this if statement do?


            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            // create image manager with desired driver
            $manager = new ImageManager(new Driver());
    
            // read image from file system
            $imagenServidor = $manager->read($imagen);
            $imagenServidor->resize(width: 1000, height: 1000);
     
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->toPng()->save($imagenPath);
        } 

        $usuario = User::find(auth()->user()->id);

        // if (!empty($request->password)){
        //     if(Hash::check($request->password, $usuario->password)){
        //         dd("mama");
        //         return back()->with('mensaje', 'Credenciales incorrectas');
        //     }
        // }
        


        
        
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
        // $usuario->password = $request->password_nueva ?? auth()->user()->password;        
        
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);

        
        //guardar cambios

    }
}




