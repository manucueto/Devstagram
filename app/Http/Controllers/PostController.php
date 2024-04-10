<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Colors\Rgb\Channels\Red;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['show','index']);
    }
    public function index(User $user){

        $posts = Post::where('user_id', $user->id)->latest()->paginate(10);


        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
    public function create(){
        return view('posts.create');
    }
    public function store(Request $request){
        $this->validate($request, [
            'titulo'=> 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required',


        ]);
        // Post::create([
        //     'titulo'=> $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id,

        // ]);

        $request->user()->posts()->create([
            'titulo'=> $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post ){

        if($user->id != $post->user_id){
            return redirect()->route('posts.index', auth()->user()->username);
        }//validamos si el usuario en la url es el dueño del numero de post en la url
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);
        $post->delete();
        //eliminar la imagen

        $imagen_path = public_path('uploads/' . $post->imagen);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }
        return redirect()->route('posts.index', auth()->user()->username);

    }
}



