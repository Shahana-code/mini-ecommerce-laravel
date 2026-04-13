@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="list-group shadow-sm">
            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action">Manage Products</a>
            <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action active">Manage Orders</a>
        </div>
    </div>
    <div class="col-md-9">
        <h3 class="mb-4">Manage Orders</h3>
        
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>${{ number_format($order->total_price, 2) }}</td>
                                <td>
                                    <span class="badge 
                                        @if($order->status == 'pending') bg-warning text-dark
                                        @elseif($order->status == 'processing') bg-info text-dark
                                        @elseif($order->status == 'completed') bg-success
                                        @else bg-danger @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm me-2" style="width: 120px;">
                                            <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                                            <option value="processing" @if($order->status == 'processing') selected @endif>Processing</option>
                                            <option value="completed" @if($order->status == 'completed') selected @endif>Completed</option>
                                            <option value="cancelled" @if($order->status == 'cancelled') selected @endif>Cancelled</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No orders found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
