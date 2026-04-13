@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="list-group shadow-sm">
            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action active">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action">Manage Products</a>
            <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action">Manage Orders</a>
        </div>
    </div>
    <div class="col-md-9">
        <h3 class="mb-4">Admin Dashboard</h3>
        
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card text-white bg-primary shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Products</h5>
                        <h2 class="display-4 fw-bold">{{ $productsCount }}</h2>
                    </div>
                    <div class="card-footer bg-transparent border-white">
                        <a href="{{ route('admin.products.index') }}" class="text-white text-decoration-none">View Details ➔</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card text-white bg-success shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <h2 class="display-4 fw-bold">{{ $ordersCount }}</h2>
                    </div>
                    <div class="card-footer bg-transparent border-white">
                        <a href="{{ route('admin.orders.index') }}" class="text-white text-decoration-none">View Details ➔</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
