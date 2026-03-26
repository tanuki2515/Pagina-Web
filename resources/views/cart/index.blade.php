@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-100 mb-8">Carrito de Compras</h1>

    @if(empty($products))
        <div class="text-center py-16 bg-gray-900 rounded-xl border border-gray-800">
            <span class="text-6xl block mb-4">&#128722;</span>
            <p class="text-gray-400 text-lg mb-4">Tu carrito esta vacio</p>
            <a href="{{ route('home') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-medium transition inline-block">
                Ir a comprar
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($products as $item)
                <div class="bg-gray-900 rounded-xl border border-gray-800 p-4 flex flex-col sm:flex-row items-center gap-4">
                    <!-- Image -->
                    @if($item['product']->image)
                        <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}" class="w-20 h-20 object-cover rounded-lg">
                    @else
                        <div class="w-20 h-20 bg-gray-800 rounded-lg flex items-center justify-center"><span class="text-2xl">&#127918;</span></div>
                    @endif

                    <!-- Info -->
                    <div class="flex-1 text-center sm:text-left">
                        <h3 class="text-gray-100 font-bold">{{ $item['product']->name }}</h3>
                        <p class="text-purple-400 font-medium">${{ number_format($item['product']->price, 2) }}</p>
                    </div>

                    <!-- Quantity -->
                    <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        @method('PATCH')
                        <div class="flex items-center bg-gray-800 rounded-lg border border-gray-700">
                            <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="px-3 py-1 text-gray-400 hover:text-white">-</button>
                            <span class="px-3 py-1 text-gray-100">{{ $item['quantity'] }}</span>
                            <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="px-3 py-1 text-gray-400 hover:text-white">+</button>
                        </div>
                    </form>

                    <!-- Subtotal -->
                    <div class="text-right">
                        <p class="text-gray-100 font-bold">${{ number_format($item['subtotal'], 2) }}</p>
                    </div>

                    <!-- Remove -->
                    <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-300 transition" title="Eliminar">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Total and Actions -->
        <div class="bg-gray-900 rounded-xl border border-gray-800 p-6 mt-6">
            <div class="flex justify-between items-center mb-6">
                <span class="text-xl text-gray-300">Total:</span>
                <span class="text-3xl font-bold text-purple-400">${{ number_format($total, 2) }}</span>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('home') }}" class="flex-1 text-center border border-gray-700 text-gray-300 hover:bg-gray-800 py-3 px-6 rounded-lg transition font-medium">
                    Seguir comprando
                </a>
                <form action="{{ route('cart.clear') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full border border-red-800 text-red-400 hover:bg-red-900/30 py-3 px-6 rounded-lg transition font-medium">
                        Vaciar carrito
                    </button>
                </form>
                <form action="{{ route('cart.checkout') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-6 rounded-lg font-bold transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.124.549 4.12 1.519 5.857L.525 23.498l5.754-.953A11.944 11.944 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.94 0-3.75-.562-5.283-1.527l-.379-.225-3.387.562.571-3.297-.247-.393A9.96 9.96 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
                        Enviar pedido por WhatsApp
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
