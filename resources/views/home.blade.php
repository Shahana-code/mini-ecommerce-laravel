@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="mb-0">Our Products</h2>
        </div>
        <div class="col-md-6">
            <form action="{{ route('home') }}" method="GET" class="d-flex">
                <input class="form-control me-2" type="search" name="search" placeholder="Search products..." aria-label="Search" value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-light text-center d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span class="text-muted">No Image</span>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-primary fw-bold">${{ number_format($product->price, 2) }}</h6>
                        <p class="card-text text-muted small">{{ Str::limit($product->description, 80) }}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            @if($product->stock > 0)
                                <form action="{{ route('cart.store', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Add to Cart</button>
                                </form>
                            @else
                                <span class="badge bg-danger">Out of Stock</span>
                            @endif
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-secondary">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h4>No products found!</h4>
                <p class="text-muted">Try a different search term or check back later.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
