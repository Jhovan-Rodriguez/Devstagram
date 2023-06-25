@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto flex">
        <div class="md:w-1/2">
            <img class="border bg-white p-1 dark:border-neutral-700 dark:bg-neutral-800 rounded-lg shadown-xl"
                src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen de {{ $post->titulo }}">

            <div class="p-3">
                <p>
                    0 Likes
                </p>
            </div>

            <div>
                <p class="font-bold">
                    {{-- Obtiene el username de la relacion user() en Models/Post.php --}}
                    {{ $post->user->username }}
                </p>

                <p class="text-sm text-gray-500">
                    {{-- diffForHumans() funcion para dar formato legible a las fechas --}}
                    {{ $post->created_at->diffForHumans() }}
                </p>

                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
            </div>
        </div>

        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">
                        Agrega un Nuevo Comentario
                    </p>
                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                Añade un Comentario
                            </label>
                            <textarea id="comentario" name="comentario" placeholder="Agrega un comentario"
                                class="border p-3 w-full rounded-lg
                            @error('comentario')
                                border-red-500
                            @enderror"></textarea>

                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <input type="submit" value="Comentar"
                            class="bg-sky-600 hover:bg-sky-700 trasition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                    </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentario->count())
                        @foreach ($post->comentario as $comentarios)
                            <div class="p-5 border-gray-300 border-b">
                                <div style="display: flex;justify-content: space-between;">
                                    <a href="{{ route('posts.index', $comentarios->user) }} " class="font-bold">
                                        {{ $comentarios->user->username }}
                                    </a>
                                    <div class="flex justify-end items-center">
                                        @auth
                                            @if ($comentarios->user->username === auth()->user()->username)
                                                <form action="{{ route('comentario.delete', $comentarios->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Eliminar"
                                                        class="bg-red-500 hover:bg-red-600 p-1 text-sm rounded text-white cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                                <p>{{ $comentarios->comentario }}
                                <p class="text-sm text-gray-500">{{ $comentarios->created_at->diffForHumans() }}
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No Hay Comentarios Aún</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
