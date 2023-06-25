<?php


use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentariosController;
use Illuminate\Support\Facades\Route;

/*
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('devstagram');
});
//Rutas para la gestion de usuarios
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
//Rutas para el login: index: muestra de vistas y store para consultas
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
//Ruta para cerrar sesión
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// Rutas para la gestión de las vistas de POST'S y consultas
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
//Se elimina el comentario mandando el id al controlador mediante el metodo Delete
Route::delete('/comentario/{id}', [ComentariosController::class, 'delete'])->name('comentario.delete');

// Consultar URL de post de user
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
//Ruta para los comentarios
Route::post('/{user:username}/posts/{post}', [ComentariosController::class, 'store'])->name('comentarios.store');
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagen.store');

