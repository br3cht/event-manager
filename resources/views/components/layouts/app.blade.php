<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <header class="bg-black shadow py-2">
                <div class="container mx-auto px-4 flex justify-between items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-white">Event System</a>

                    <div class="flex space-x-4 items-center">
                        @auth
                            <!-- Botão Meus Eventos -->
                            <a href="{{ route('meus-eventos') }}"
                               class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-all">
                                Meus eventos
                            </a>
                            <div class="relative group">
                                <!-- Nome do usuário -->
                                <button class="flex items-center space-x-2 text-white font-medium hover:text-gray-600">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-600 hover:text-white rounded-lg transition-all">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                               class="text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-all">
                                Login
                            </a>

                            <a href="{{ route('registrar') }}"
                               class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-all">
                                Registrar
                            </a>
                        @endauth
                    </div>
                </div>
            </header>
        <main>
            {{ $slot }}
        </main>'
    </div>
        @livewireScripts
    </body>
</body>
</html>

