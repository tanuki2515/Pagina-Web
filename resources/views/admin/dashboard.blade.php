@extends('layouts.app')

@section('title', 'Panel Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-100 mb-8">Panel de Administracion</h1>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gray-900 rounded-xl border border-gray-800 p-6">
            <p class="text-gray-400 text-sm">Total Productos</p>
            <p class="text-3xl font-bold text-purple-400 mt-1">{{ $stats['products'] }}</p>
        </div>
        <div class="bg-gray-900 rounded-xl border border-gray-800 p-6">
            <p class="text-gray-400 text-sm">Productos Activos</p>
            <p class="text-3xl font-bold text-green-400 mt-1">{{ $stats['active_products'] }}</p>
        </div>
        <div class="bg-gray-900 rounded-xl border border-gray-800 p-6">
            <p class="text-gray-400 text-sm">Categorias</p>
            <p class="text-3xl font-bold text-yellow-400 mt-1">{{ $stats['categories'] }}</p>
        </div>
        <div class="bg-gray-900 rounded-xl border border-gray-800 p-6">
            <p class="text-gray-400 text-sm">Clientes</p>
            <p class="text-3xl font-bold text-blue-400 mt-1">{{ $stats['users'] }}</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.products.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white rounded-xl p-4 text-center font-medium transition">
            + Nuevo Producto
        </a>
        <a href="{{ route('admin.categories.create') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white rounded-xl p-4 text-center font-medium transition">
            + Nueva Categoria
        </a>
        <a href="{{ route('admin.products.index') }}" class="bg-gray-800 hover:bg-gray-700 border border-gray-700 text-gray-200 rounded-xl p-4 text-center font-medium transition">
            Ver Productos
        </a>
        <a href="{{ route('admin.users.index') }}" class="bg-gray-800 hover:bg-gray-700 border border-gray-700 text-gray-200 rounded-xl p-4 text-center font-medium transition">
            Ver Usuarios
        </a>
    </div>
</div>
@endsection
