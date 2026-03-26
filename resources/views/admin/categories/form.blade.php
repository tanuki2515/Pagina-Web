@extends('layouts.app')

@section('title', isset($category) ? 'Editar Categoria' : 'Nueva Categoria')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-100 mb-8">{{ isset($category) ? 'Editar Categoria' : 'Nueva Categoria' }}</h1>

    <form action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
          method="POST" enctype="multipart/form-data" class="bg-gray-900 rounded-xl border border-gray-800 p-6 space-y-6">
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">Nombre *</label>
            <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" required
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:border-purple-500">
            @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">Imagen</label>
            @if(isset($category) && $category->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $category->image) }}" class="w-32 h-32 object-cover rounded-lg">
                </div>
            @endif
            <input type="file" name="image" accept="image/*"
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 file:mr-4 file:py-1 file:px-4 file:rounded file:border-0 file:bg-purple-600 file:text-white file:cursor-pointer">
            @error('image') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded-lg font-medium transition">
                {{ isset($category) ? 'Actualizar' : 'Crear Categoria' }}
            </button>
            <a href="{{ route('admin.categories.index') }}" class="border border-gray-700 text-gray-300 hover:bg-gray-800 px-6 py-2 rounded-lg transition">Cancelar</a>
        </div>
    </form>
</div>
@endsection
