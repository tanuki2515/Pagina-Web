@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="text-sm mb-6">
        <a href="{{ route('home') }}" class="text-gray-500 hover:text-purple-400 transition">Inicio</a>
        <span class="text-gray-600 mx-2">/</span>
        <a href="{{ route('home', ['category' => $product->category->slug]) }}" class="text-gray-500 hover:text-purple-400 transition">{{ $product->category->name }}</a>
        <span class="text-gray-600 mx-2">/</span>
        <span class="text-purple-400">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Image -->
        <div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-96 lg:h-[500px] object-cover">
            @else
                <div class="w-full h-96 lg:h-[500px] bg-gray-800 flex items-center justify-center">
                    <span class="text-8xl">&#127918;</span>
                </div>
            @endif
        </div>

        <!-- Details -->
        <div>
            <span class="text-purple-400 text-sm font-medium">{{ $product->category->name }}</span>
            <h1 class="text-3xl font-bold text-gray-100 mt-2">{{ $product->name }}</h1>
            <p class="text-3xl font-bold text-purple-400 mt-4">${{ number_format($product->price, 2) }}</p>

            <div class="mt-4">
                @if($product->stock > 0)
                    <span class="text-green-400 text-sm font-medium">&#10003; En stock ({{ $product->stock }} disponibles)</span>
                @else
                    <span class="text-red-400 text-sm font-medium">&#10007; Agotado</span>
                @endif
            </div>

            @if($product->description)
                <div class="mt-6">
                    <h3 class="text-lg font-bold text-gray-200 mb-2">Descripcion</h3>
                    <p class="text-gray-400 leading-relaxed">{{ $product->description }}</p>
                </div>
            @endif

            @if($product->stock > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-8 flex items-center gap-4">
                    @csrf
                    <div class="flex items-center bg-gray-800 rounded-lg border border-gray-700">
                        <button type="button" onclick="updateQty(-1)" class="px-3 py-2 text-gray-400 hover:text-white">-</button>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}"
                               class="w-16 bg-transparent text-center text-gray-100 border-0 focus:ring-0">
                        <button type="button" onclick="updateQty(1)" class="px-3 py-2 text-gray-400 hover:text-white">+</button>
                    </div>
                    <button type="submit" class="flex-1 bg-purple-600 hover:bg-purple-700 text-white py-3 px-6 rounded-lg font-bold transition">
                        Agregar al Carrito
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Related Products -->
    @if($related->isNotEmpty())
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-100 mb-6">Productos Relacionados</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($related as $item)
                    <div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden hover:border-purple-600/50 transition group">
                        <a href="{{ route('product.show', $item) }}">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-48 bg-gray-800 flex items-center justify-center"><span class="text-4xl">&#127918;</span></div>
                            @endif
                        </a>
                        <div class="p-4">
                            <a href="{{ route('product.show', $item) }}" class="text-gray-100 font-bold hover:text-purple-400 transition">{{ $item->name }}</a>
                            <p class="text-purple-400 font-bold mt-2">${{ number_format($item->price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
function updateQty(change) {
    const input = document.getElementById('quantity');
    let val = parseInt(input.value) + change;
    if (val < 1) val = 1;
    if (val > parseInt(input.max)) val = parseInt(input.max);
    input.value = val;
}
</script>
@endsection
