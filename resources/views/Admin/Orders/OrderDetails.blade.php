@extends('layouts.master')

@section('content')
    <!-- Bread crumb -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Order Details</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.orders.index') }}">Orders</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Order #{{ $order->id }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bread crumb -->

    <!-- Container fluid -->
    <div class="container-fluid">
        <!-- Success & Error Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Order Details -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Information</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Order ID</th>
                                <td>{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>{{ $order->created_at->format('d M, Y') }}</td>
                            </tr>
                            <tr>
                                <th>Customer Name</th>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $order->phone }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $order->address }}</td>
                            </tr>
                            <tr>
                                <th>Total Price</th>
                                <td><strong class="text-danger">{{ $order->total_price }} EGP</strong></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge
                                        @if($order->status == 'pending') bg-warning
                                        @elseif($order->status == 'in progress') bg-info
                                        @elseif($order->status == 'completed') bg-success
                                        @elseif($order->status == 'canceled') bg-danger
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Payment Type</th>
                                <td>
                                    <span class="badge
                                        @if($order->Payment_type == 'cache') bg-warning
                                            @elseif($order->Payment_type == 'online') bg-info
                                            @endif">
                                        {{ ucfirst($order->Payment_type) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Payment Status</th>
                                <td>
                                    <span class="badge
                                        @if($order->Payment_status == 'unpaid') bg-warning
                                        @elseif($order->Payment_status == 'paid') bg-info
                                        @endif">
                                        {{ ucfirst($order->Payment_status) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ordered Items -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ordered Items</h5>
                        <div class="table-responsive">
                            @if ($order->items->isEmpty())
                                <p class="text-center text-muted">No items in this order.</p>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price (EGP)</th>
                                            <th>Total (EGP)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td><img src="{{ asset('storage/' . $item->product->path) }}" width="50"
                                                    height="50" class="rounded-circle" alt=""></td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td><strong>{{ $item->quantity * $item->price }} EGP</strong></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Status -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Order Status</h5>
                        <form action="{{ route('dashboard.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="status" class="form-label">Order Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in progress" {{ $order->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Container fluid -->
@endsection
