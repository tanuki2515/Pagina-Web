<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $products = [];
        $total = 0;

        foreach ($cart as $id => $quantity) {
            $product = Product::find($id);
            if ($product) {
                $products[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity,
                ];
                $total += $product->price * $quantity;
            }
        }

        return view('cart.index', compact('products', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$product->id])) {
            $cart[$product->id] += $quantity;
        } else {
            $cart[$product->id] = $quantity;
        }

        session()->put('cart', $cart);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Producto agregado al carrito',
                'cartCount' => array_sum($cart),
            ]);
        }

        return back()->with('success', 'Producto agregado al carrito.');
    }

    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if ($quantity > 0) {
            $cart[$product->id] = $quantity;
        } else {
            unset($cart[$product->id]);
        }

        session()->put('cart', $cart);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Carrito actualizado',
                'cartCount' => array_sum($cart),
            ]);
        }

        return back()->with('success', 'Carrito actualizado.');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);

        return back()->with('success', 'Producto eliminado del carrito.');
    }

    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Carrito vaciado.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Tu carrito esta vacio.');
        }

        $message = "Hola! Me gustaria hacer el siguiente pedido:\n\n";
        $total = 0;

        foreach ($cart as $id => $quantity) {
            $product = Product::find($id);
            if ($product) {
                $subtotal = $product->price * $quantity;
                $message .= "- {$product->name} x{$quantity} - $" . number_format($subtotal, 2) . "\n";
                $total += $subtotal;
            }
        }

        $message .= "\n*Total: $" . number_format($total, 2) . "*";

        if (auth()->check()) {
            $message .= "\n\nCliente: " . auth()->user()->name;
            $message .= "\nEmail: " . auth()->user()->email;
        }

        $whatsappNumber = config('app.whatsapp_number', '5212345678901');
        $encodedMessage = urlencode($message);
        $whatsappUrl = "https://wa.me/{$whatsappNumber}?text={$encodedMessage}";

        session()->forget('cart');

        return redirect()->away($whatsappUrl);
    }

    public function count()
    {
        $cart = session()->get('cart', []);
        return response()->json(['count' => array_sum($cart)]);
    }
}
