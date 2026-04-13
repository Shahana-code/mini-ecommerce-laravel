@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-light py-3 border-bottom-0 rounded-top">
                <h5 class="mb-0 fw-bold text-primary">Checkout Confirmation</h5>
            </div>
            <div class="card-body p-4">
                <h6 class="mb-4 text-primary fw-bold text-uppercase small" style="letter-spacing: 1px;">Review Your Order</h6>
                <div class="table-responsive mb-4">
                    <table class="table">
                        <thead class="bg-light text-primary" style="--bs-table-bg: transparent; border-bottom: 2px solid #10b981;">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carts as $cart)
                            <tr>
                                <td>{{ $cart->product->name }}</td>
                                <td>${{ number_format($cart->product->price, 2) }}</td>
                                <td>{{ $cart->quantity }}</td>
                                <td>${{ number_format($cart->product->price * $cart->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end text-primary text-uppercase small" style="letter-spacing: 0.5px;">Grand Total:</th>
                                <th class="text-primary fs-5">${{ number_format($totalPrice, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="alert alert-success border-0 shadow-sm bg-light text-primary">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <strong>Note:</strong> This is a demo application. No real payment is required. You will "pay" with imaginary fun bucks!
                </div>

                <form action="{{ route('checkout.store') }}" method="POST" class="d-flex justify-content-between mt-4">
                    @csrf
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">Back to Cart</a>
                    <button type="submit" class="btn btn-success btn-lg px-5">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
