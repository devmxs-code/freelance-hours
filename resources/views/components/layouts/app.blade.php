<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Freelance Hours' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100 min-h-screen flex flex-col">
        <nav class="bg-black border-b border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <a href="{{ route('projects.index') }}" class="text-xl font-bold text-white tracking-tight">
                            Freelance Hours
                        </a>
                    </div>
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ route('notifications.index') }}" class="relative text-white hover:text-gray-300 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                @if(auth()->user()->unreadNotifications()->count() > 0)
                                    <span class="absolute -top-1 -right-1 bg-white text-black text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
                                        {{ auth()->user()->unreadNotifications()->count() }}
                                    </span>
                                @endif
                            </a>
                            <a href="{{ route('dashboard') }}" class="text-white hover:text-gray-300 transition-colors">
                                Dashboard
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-white hover:text-gray-300 transition-colors">
                                    Sair
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-white hover:text-gray-300 transition-colors">
                                Entrar
                            </a>
                            <a href="{{ route('register') }}" class="bg-white text-black hover:bg-gray-200 px-4 py-2 rounded transition-colors">
                                Registrar
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
            @if(session('success'))
                <div class="mb-6 bg-white border-l-4 border-gray-900 text-gray-900 px-4 py-3 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-white border-l-4 border-gray-600 text-gray-900 px-4 py-3 rounded shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}
        </main>

        <footer class="bg-black border-t border-gray-800 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <p class="text-center text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Freelance Hours. Todos os direitos reservados.
                </p>
            </div>
        </footer>
    </body>
</html>
