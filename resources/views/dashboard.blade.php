@extends('layouts.app')

@section('title', 'Mi Cuenta')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-100 mb-8">Mi Cuenta</h1>

    <div class="bg-gray-900 rounded-xl border border-gray-800 p-6">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center text-2xl font-bold text-white">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-100">{{ auth()->user()->name }}</h2>
                <p class="text-gray-400">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('profile.edit') }}" class="bg-gray-800 hover:bg-gray-750 border border-gray-700 rounded-lg p-4 transition hover:border-purple-600/50">
                <h3 class="font-bold text-gray-200 mb-1">Editar Perfil</h3>
                <p class="text-gray-500 text-sm">Actualiza tu nombre, email o contrasena</p>
            </a>
            <a href="{{ route('home') }}" class="bg-gray-800 hover:bg-gray-750 border border-gray-700 rounded-lg p-4 transition hover:border-purple-600/50">
                <h3 class="font-bold text-gray-200 mb-1">Ir a la Tienda</h3>
                <p class="text-gray-500 text-sm">Explora nuestro catalogo de productos</p>
            </a>
        </div>
    </div>
</div>
@endsection
