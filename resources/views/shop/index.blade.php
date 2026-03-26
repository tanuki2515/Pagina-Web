@extends('layouts.app')

@section('title', 'Catalogo')

@section('content')
<!-- Hero -->
<div class="bg-gradient-to-r from-purple-900/50 to-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Tu Mundo <span class="text-purple-400">Otaku</span></h1>
        <p class="text-gray-400 text-lg mb-6">Figuras, manga, ropa y accesorios de tus animes favoritos</p>
        <!-- Search -->
        <form action="{{ route('home') }}" method="GET" class="flex gap-2 max-w-lg">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar productos..."
                class="flex-1 bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 placeholder-gray-500 focus:outline-none focus:border-purple-500">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg transition font-medium">Buscar</button>
        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar - Categories -->
        <aside class="lg:w-64 flex-shrink-0">
            <h3 class="text-lg font-bold text-purple-400 mb-4">Categorias</h3>
            <div class="space-y-1">
                <a href="{{ route('home') }}"
                   class="block px-3 py-2 rounded-lg text-sm transition {{ !request('category') ? 'bg-purple-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-purple-400' }}">
                    Todos los productos
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('home', ['category' => $category->slug]) }}"
                       class="block px-3 py-2 rounded-lg text-sm transition {{ request('category') == $category->slug ? 'bg-purple-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-purple-400' }}">
                        {{ $category->name }} <span class="text-gray-500">({{ $category->products_count }})</span>
                    </a>
                @endforeach
            </div>

            <!-- Sort -->
            <h3 class="text-lg font-bold text-purple-400 mb-4 mt-8">Ordenar por</h3>
            <div class="space-y-1">
                @foreach(['latest' => 'Mas recientes', 'price_asc' => 'Menor precio', 'price_desc' => 'Mayor precio', 'name' => 'Nombre A-Z'] as $value => $label)
                    <a href="{{ route('home', array_merge(request()->query(), ['sort' => $value])) }}"
                       class="block px-3 py-2 rounded-lg text-sm transition {{ request('sort', 'latest') == $value ? 'bg-purple-600/30 text-purple-400' : 'text-gray-400 hover:bg-gray-800' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </aside>

        <!-- Products Grid -->
        <div class="flex-1">
            @if(request('search'))
                <p class="text-gray-400 mb-4">Resultados para: <span class="text-purple-400 font-medium">"{{ request('search') }}"</span></p>
            @endif

            @if($products->isEmpty())
                <div class="text-center py-16">
                    <p class="text-gray-500 text-lg">No se encontraron productos.</p>
                    <a href="{{ route('home') }}" class="text-purple-400 hover:text-purple-300 mt-2 inline-block">Ver todos los productos</a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden hover:border-purple-600/50 transition group">
                            <a href="{{ route('product.show', $product) }}">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                         class="w-full h-56 object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <div class="w-full h-56 bg-gray-800 flex items-center justify-center">
                                        <span class="text-6xl">&#127918;</span>
                                    </div>
                                @endif
                            </a>
                            <div class="p-4">
                                <span class="text-xs text-purple-400 font-medium">{{ $product->category->name }}</span>
                                <a href="{{ route('product.show', $product) }}">
                                    <h3 class="text-lg font-bold text-gray-100 mt-1 hover:text-purple-400 transition">{{ $product->name }}</h3>
                                </a>
                                <p class="text-gray-500 text-sm mt-1 line-clamp-2">{{ $product->description }}</p>
                                <div class="flex items-center justify-between mt-4">
                                    <span class="text-xl font-bold text-purple-400">${{ number_format($product->price, 2) }}</span>
                                    @if($product->stock > 0)
                                        <form action="{{ route('cart.add', $product) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                                                Agregar
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-red-400 text-sm">Agotado</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
