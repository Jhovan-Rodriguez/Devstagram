<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{

    //Funcion para guardar la imagen en la carpeta uploads
    public function store(Request $request)
    {
        
        $imagen = $request->file('file');
        // Se genera un ID único para la imagen
        $nombreImagen = Str::uuid() . '.' . $imagen->extension();
        
        // Procesa la imagen

        $imagenServidor = Image::make($imagen);
        // Recorta la imagen
        $imagenServidor->fit(1000, 1000);

        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);
 
        return response()->json([
            'imagen' => $nombreImagen
        ]);
    }
}
