<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        // Para verificar que el user este autenticado
        // except() es para indicar cuales metodos pueden usarse sin autenticarse
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(User $user)
    {
        // Query a la tabla posts en la DB usando el user_id
        // $posts = Post::where('user_id', $user->id)->get();
        $posts = Post::where('user_id', $user->id)->paginate(5);
        // Retorna la view y pasa los valores
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    //Funcion para retornar vistas
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Validaciones
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Como si se hiciera un INSERT INTO
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id // El Post lo hace quien esta autenticado, por eso se agrega su id para la relacion en la DB
        ]);


        return redirect()->route('posts.index', auth()->user()->username);
    }

    //Funcion para mostrar los POST recibiendo como parametro el objeto USER Y POST

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user'=>$user
        ]);
    }
}
