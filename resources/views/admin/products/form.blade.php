@extends('layouts.app')

@section('title', isset($product) ? 'Editar Producto' : 'Nuevo Producto')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-100 mb-8">{{ isset($product) ? 'Editar Producto' : 'Nuevo Producto' }}</h1>

    <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
          method="POST" enctype="multipart/form-data" class="bg-gray-900 rounded-xl border border-gray-800 p-6 space-y-6">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif

        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">Nombre *</label>
            <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:border-purple-500">
            @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">Descripcion</label>
            <textarea name="description" rows="4"
                      class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:border-purple-500">{{ old('description', $product->description ?? '') }}</textarea>
            @error('description') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Precio *</label>
                <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" step="0.01" min="0" required
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:border-purple-500">
                @error('price') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Stock *</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" min="0" required
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:border-purple-500">
                @error('stock') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">Categoria *</label>
            <select name="category_id" required
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:border-purple-500">
                <option value="">Seleccionar categoria</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">Imagen</label>
            @if(isset($product) && $product->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover rounded-lg">
                </div>
            @endif
            <input type="file" name="image" accept="image/*"
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 file:mr-4 file:py-1 file:px-4 file:rounded file:border-0 file:bg-purple-600 file:text-white file:cursor-pointer">
            @error('image') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" name="active" id="active" value="1"
                   {{ old('active', $product->active ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 rounded bg-gray-800 border-gray-700 text-purple-600 focus:ring-purple-500">
            <label for="active" class="text-gray-300 text-sm font-medium">Producto activo</label>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-medium transition">
                {{ isset($product) ? 'Actualizar' : 'Crear Producto' }}
            </button>
            <a href="{{ route('admin.products.index') }}" class="border border-gray-700 text-gray-300 hover:bg-gray-800 px-6 py-2 rounded-lg transition">Cancelar</a>
        </div>
    </form>
</div>
@endsection
