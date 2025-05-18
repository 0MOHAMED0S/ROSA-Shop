@extends('layouts.master')

@section('content')
    <!-- Bread crumb -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title"> Orders</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{route('dashboard.orders.index')}}">Orders</a>
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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Filter Links -->
        <div class="filter-links mb-3 text-center">
            <a href="{{ route('dashboard.orders.index') }}" class="btn btn-outline-primary {{ request('status') == null ? 'active' : '' }}">All</a>
            <a href="{{ route('dashboard.orders.index', ['status' => 'pending']) }}" class="btn btn-outline-warning {{ request('status') == 'pending' ? 'active' : '' }}">Pending</a>
            <a href="{{ route('dashboard.orders.index', ['status' => 'in-progress']) }}" class="btn btn-outline-info {{ request('status') == 'in-progress' ? 'active' : '' }}">In Progress</a>
            <a href="{{ route('dashboard.orders.index', ['status' => 'completed']) }}" class="btn btn-outline-success {{ request('status') == 'completed' ? 'active' : '' }}">Completed</a>
            <a href="{{ route('dashboard.orders.index', ['status' => 'canceled']) }}" class="btn btn-outline-danger {{ request('status') == 'canceled' ? 'active' : '' }}">Canceled</a>
        </div>

        <!-- Orders Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Orders List</h5>
                        <div class="table-responsive">
                            @php
                                $filteredOrders = $orders->filter(function ($order) {
                                    return !request('status') || request('status') === $order->status;
                                });
                            @endphp

                            @if ($filteredOrders->isEmpty())
                                <p class="text-center text-muted">No orders yet.</p>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Customer</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            <th>Pay Type</th>
                                            <th>Pay Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($filteredOrders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->created_at->format('d M, Y') }}</td>
                                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                                <td>{{ $order->phone }}</td>
                                                <td>{{ $order->address }}</td>
                                                <td><strong class="text-danger">{{ $order->total_price }} EGP</strong></td>
                                                <td>
                                                    <span class="badge
                                                        @if($order->status == 'pending') bg-warning
                                                        @elseif($order->status == 'in-progress') bg-info
                                                        @elseif($order->status == 'completed') bg-success
                                                        @elseif($order->status == 'canceled') bg-danger
                                                        @endif">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge
                                                        @if($order->Payment_type == 'cache') bg-warning
                                                        @elseif($order->Payment_type == 'online') bg-info
                                                        @endif">
                                                        {{ ucfirst($order->Payment_type) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge
                                                        @if($order->Payment_status == 'unpaid') bg-warning
                                                        @elseif($order->Payment_status == 'paid') bg-info
                                                        @endif">
                                                        {{ ucfirst($order->Payment_status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.orders.show', $order->id) }}" class="btn btn-sm btn-primary">View</a>
                                                </td>
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
        <!-- End Orders Table -->
    </div>
    <!-- End Container fluid -->
@endsection
