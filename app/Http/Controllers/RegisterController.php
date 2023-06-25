<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Modificar el Request para validar que sea unico (no recomendado modificarlo directamente)
        $request->request->add(['username' => Str::slug($request->username)]); // Str::slug para convertir a formato de URL

        // Validaciones
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20', // Unico en la tabla users
            'email' => 'required|unique:users|email', // Unico en la tabla users
            'password' => 'required|confirmed|min:8' // Para password_confirmation
        ]);

        // Como si se hiciera un INSERT INTO
        // Se agrega el campo 'username' en Models/User.php filleable para que espere ese campo también
        User::create([
            'name' => $request->name,
            'username' => $request->username, 
            'email' => $request->email,
            'password' => Hash::make($request->password) // Hash::make para encriptar la password
        ]);

        // Autenticar user
        /*
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);
        */

        // Otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        // Redirecciona
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
