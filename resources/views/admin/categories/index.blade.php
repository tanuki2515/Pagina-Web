@extends('layouts.app')

@section('title', 'Admin - Categorias')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-100">Categorias</h1>
        <a href="{{ route('admin.categories.create') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-medium transition">+ Nueva Categoria</a>
    </div>

    <div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Imagen</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Slug</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Productos</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-800/50">
                            <td class="px-4 py-3">
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" class="w-12 h-12 object-cover rounded">
                                @else
                                    <div class="w-12 h-12 bg-gray-800 rounded flex items-center justify-center text-lg">&#128214;</div>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-200 font-medium">{{ $category->name }}</td>
                            <td class="px-4 py-3 text-gray-400">{{ $category->slug }}</td>
                            <td class="px-4 py-3 text-purple-400 font-medium">{{ $category->products_count }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-400 hover:text-blue-300 text-sm">Editar</a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Eliminar esta categoria? Se eliminaran todos sus productos.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 text-sm">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">No hay categorias registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>
@endsection
