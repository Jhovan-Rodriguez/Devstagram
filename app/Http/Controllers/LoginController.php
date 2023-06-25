<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    //Funcion para el funcionamiento del login
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Condicion para saber si el user se pudo autenticar
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            // back() para volver a la pagina anterior, en este caso, con un mensaje
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        // Redirecciona
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
