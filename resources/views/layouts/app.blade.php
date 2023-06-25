<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Donde se agregan los elementos de push -->
    @stack('styles')
    <title>Devstagram - @yield('titulo')</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-indigo-500 shadow-xl">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black text-white">
                <a href="/">DevStagram</a>
            </h1>

            <!-- Para users autenticados -->
            @auth
                <nav class="flex gap-2 items-center">
                    <a class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer"
                        href="{{ route('posts.create') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        Crear
                    </a>

                    <a class="font-bold text-white text-sm" href="{{ route('posts.index', auth()->user()->username) }}">
                        Hola!
                        <span class="font-normal">
                            {{ auth()->user()->username }}
                        </span>
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="font-bold uppercase text-white text-sm">
                            Cerrar Sesión
                        </button>
                    </form>
                </nav>
            @endauth

            <!-- Para users NO autenticados -->
            @guest
                <nav class="flex gap-2 items-center">
                    <a class="font-bold uppercase text-white text-sm" href="{{ route('login') }}">
                        Login
                    </a>

                    <a class="font-bold uppercase text-white text-sm" href="{{ route('register') }}">
                        Crear Cuenta
                    </a>
                </nav>
            @endguest

        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('titulo')
        </h2>

        @yield('contenido')
    </main>

    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        DevStagram - Todos los derechos reservados {{ now()->year }}
    </footer>
</body>

</html>
