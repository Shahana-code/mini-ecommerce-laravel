<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Auth::user()->carts()->with('product')->get();
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $totalPrice = $carts->sum(function($cart) {
            return $cart->quantity * $cart->product->price;
        });

        return view('checkout.index', compact('carts', 'totalPrice'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $carts = $user->carts()->with('product')->get();
        
        if ($carts->isEmpty()) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }

        $totalPrice = $carts->sum(function($cart) {
            return $cart->quantity * $cart->product->price;
        });

        $order = $user->orders()->create([
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        // In a real app we'd save order items, but for this mini app:
        // User requirements: orders table [id, user_id, total_price, status]
        // Empty carts
        $user->carts()->delete();

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
}
