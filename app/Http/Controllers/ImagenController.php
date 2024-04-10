<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagenController extends Controller
{
    public function store(Request $request){
        $imagen = $request->file('file');

        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        // create image manager with desired driver
        $manager = new ImageManager(new Driver());

        // read image from file system
        $imagenServidor = $manager->read($imagen);
        $imagenServidor->resize(width: 1000, height: 1000);
 
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->toPng()->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
