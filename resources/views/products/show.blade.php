@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="row g-0">
        <div class="col-md-5">
            @if($product->image)
                <img src="{{ Storage::url($product->image) }}" class="img-fluid rounded-start w-100 h-100" style="object-fit: cover;" alt="{{ $product->name }}">
            @else
                <div class="bg-light text-center d-flex align-items-center justify-content-center h-100 p-5 rounded-start">
                    <span class="text-muted">No Image</span>
                </div>
            @endif
        </div>
        <div class="col-md-7">
            <div class="card-body p-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="card-title mb-0">{{ $product->name }}</h2>
                    <h3 class="text-primary fw-bold mb-0">${{ number_format($product->price, 2) }}</h3>
                </div>
                <hr>
                <div class="mb-4">
                    <h5 class="text-muted mb-3">Description</h5>
                    <p class="card-text" style="line-height: 1.8;">{{ $product->description }}</p>
                </div>
                <div class="mb-4">
                    <div class="d-flex align-items-center">
                        <strong class="me-2">Availability:</strong>
                        @if($product->stock > 0)
                            <span class="badge bg-success">In Stock ({{ $product->stock }})</span>
                        @else
                            <span class="badge bg-danger">Out of Stock</span>
                        @endif
                    </div>
                </div>
                
                @if($product->stock > 0)
                    <form action="{{ route('cart.store', $product) }}" method="POST" class="d-grid mt-5">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg">Add to Cart</button>
                    </form>
                @else
                    <div class="d-grid mt-5">
                        <button class="btn btn-secondary btn-lg" disabled>Out of Stock</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
