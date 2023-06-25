<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{

    //Se crea la funcion del comentario para guardar en la BD
    public function store(Request $request,User $user,Post $post){
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);
        //Se hace una instancia la modelo COMENTARIO para realizar una insersión a la tabla
        Comentario::create([
            'comentario' => $request->comentario,
            'user_id' => auth()->user()->id,
            'post_id' => $post->id
        ]);

        // Imprimir un mensaje
        return back()->with('mensaje', 'Comentario Realizado Correctamente');
    }

    //Funcion para eliminar el comentario de la publicacion
    public function delete($id)
    {
        //Se hace una instancia al modelo Comentario para encontrar el comentario con el ID 
        Comentario::find($id)->delete();
        //Se retorna a la vista del post
        return back()->with('mensaje', 'Comentario eliminado correctamente');
    }
}
