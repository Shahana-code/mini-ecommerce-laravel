@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light py-3 border-bottom-0 rounded-top">
                <h5 class="mb-0 fw-bold text-primary">Shopping Cart</h5>
            </div>
            <div class="card-body">
                @forelse($carts as $cart)
                    <div class="row mb-4 align-items-center">
                        <div class="col-md-2">
                            @if($cart->product->image)
                                <img src="{{ Storage::url($cart->product->image) }}" class="img-fluid rounded" alt="{{ $cart->product->name }}">
                            @else
                                <div class="bg-light text-center p-3 rounded h-100">
                                    <span class="text-muted small">No Image</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <h6>{{ $cart->product->name }}</h6>
                            <p class="text-muted small mb-0">${{ number_format($cart->product->price, 2) }}</p>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('cart.update', $cart) }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" class="form-control form-control-sm me-2" value="{{ $cart->quantity }}" min="1" max="{{ $cart->product->stock }}" style="width: 70px;">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                            </form>
                        </div>
                        <div class="col-md-2 text-end fw-bold">
                            ${{ number_format($cart->product->price * $cart->quantity, 2) }}
                        </div>
                        <div class="col-md-1 text-end">
                            <form action="{{ route('cart.destroy', $cart) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">&times;</button>
                            </form>
                        </div>
                    </div>
                    @if(!$loop->last)<hr>@endif
                @empty
                    <div class="text-center py-5">
                        <p class="text-muted mb-0">Your cart is empty.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-light py-3 border-bottom-0 rounded-top">
                <h5 class="mb-0 fw-bold text-primary">Order Summary</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0 bg-transparent">
                        Products
                        <span class="fw-medium">${{ number_format($carts->sum(function($cart) { return $cart->product->price * $cart->quantity; }), 2) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent border-bottom-0">
                        Shipping
                        <span class="text-success fw-medium">Free</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3 bg-transparent">
                        <div>
                            <strong class="text-primary text-uppercase" style="letter-spacing: 0.5px;">Total Amount</strong>
                        </div>
                        <span><strong class="text-primary fs-5">${{ number_format($carts->sum(function($cart) { return $cart->product->price * $cart->quantity; }), 2) }}</strong></span>
                    </li>
                </ul>
                
                @if($carts->isNotEmpty())
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary d-grid btn-lg">Proceed to Checkout</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
