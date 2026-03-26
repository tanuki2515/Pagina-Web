<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'OtakuShop') }} - @yield('title', 'Tu Tienda Anime')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-gray-900 border-b border-purple-900/50 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-purple-400 hover:text-purple-300 transition">
                        &#9733; OtakuShop
                    </a>
                    <div class="hidden md:flex items-center gap-6">
                        <a href="{{ route('home') }}" class="text-gray-300 hover:text-purple-400 transition text-sm font-medium">Inicio</a>
                        <a href="{{ route('home', ['category' => '']) }}" class="text-gray-300 hover:text-purple-400 transition text-sm font-medium">Catalogo</a>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="relative text-gray-300 hover:text-purple-400 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        <span id="cart-badge" class="absolute -top-2 -right-2 bg-purple-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center {{ array_sum(session('cart', [])) > 0 ? '' : 'hidden' }}">
                            {{ array_sum(session('cart', [])) }}
                        </span>
                    </a>

                    <!-- Auth Links -->
                    @auth
                        <div class="hidden md:flex items-center gap-4">
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="text-yellow-400 hover:text-yellow-300 transition text-sm font-medium">Admin</a>
                            @endif
                            <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-purple-400 transition text-sm font-medium">Mi Cuenta</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-400 hover:text-red-400 transition text-sm">Salir</button>
                            </form>
                        </div>
                    @else
                        <div class="hidden md:flex items-center gap-3">
                            <a href="{{ route('login') }}" class="text-gray-300 hover:text-purple-400 transition text-sm font-medium">Iniciar Sesion</a>
                            <a href="{{ route('register') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Registrarse</a>
                        </div>
                    @endauth

                    <!-- Mobile menu button -->
                    <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="md:hidden text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-gray-900 border-t border-gray-800 pb-4">
            <div class="px-4 pt-2 space-y-2">
                <a href="{{ route('home') }}" class="block text-gray-300 hover:text-purple-400 py-2">Inicio</a>
                <a href="{{ route('home') }}" class="block text-gray-300 hover:text-purple-400 py-2">Catalogo</a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block text-yellow-400 hover:text-yellow-300 py-2">Admin</a>
                    @endif
                    <a href="{{ route('dashboard') }}" class="block text-gray-300 hover:text-purple-400 py-2">Mi Cuenta</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block text-gray-400 hover:text-red-400 py-2">Salir</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block text-gray-300 hover:text-purple-400 py-2">Iniciar Sesion</a>
                    <a href="{{ route('register') }}" class="block text-purple-400 hover:text-purple-300 py-2">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-900/50 border border-green-700 text-green-300 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-900/50 border border-red-700 text-red-300 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-purple-900/30 mt-12">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-bold text-purple-400 mb-3">&#9733; OtakuShop</h3>
                    <p class="text-gray-400 text-sm">Tu tienda de confianza para productos otaku. Envios a todo el pais.</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-purple-400 mb-3">Enlaces</h3>
                    <div class="space-y-2">
                        <a href="{{ route('home') }}" class="block text-gray-400 hover:text-purple-400 text-sm transition">Inicio</a>
                        <a href="{{ route('cart.index') }}" class="block text-gray-400 hover:text-purple-400 text-sm transition">Carrito</a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-purple-400 mb-3">Contacto</h3>
                    <p class="text-gray-400 text-sm">Email: contacto@otakushop.com</p>
                    <p class="text-gray-400 text-sm">WhatsApp: +52 123 456 7890</p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-4 text-center">
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} OtakuShop. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
