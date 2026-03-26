@extends('layouts.app')

@section('title', 'Admin - Productos')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-100">Productos</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium transition">+ Nuevo Producto</a>
    </div>

    <div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Imagen</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Categoria</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Precio</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Stock</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Estado</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-800/50">
                            <td class="px-4 py-3">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 object-cover rounded">
                                @else
                                    <div class="w-12 h-12 bg-gray-800 rounded flex items-center justify-center text-lg">&#127918;</div>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-200 font-medium">{{ $product->name }}</td>
                            <td class="px-4 py-3 text-gray-400">{{ $product->category->name }}</td>
                            <td class="px-4 py-3 text-purple-400 font-medium">${{ number_format($product->price, 2) }}</td>
                            <td class="px-4 py-3 text-gray-300">{{ $product->stock }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-xs font-medium {{ $product->active ? 'bg-green-900/50 text-green-400' : 'bg-red-900/50 text-red-400' }}">
                                    {{ $product->active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-400 hover:text-blue-300 text-sm">Editar</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Eliminar este producto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 text-sm">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">No hay productos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection
