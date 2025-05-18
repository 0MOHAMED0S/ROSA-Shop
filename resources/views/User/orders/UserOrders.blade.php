<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/orders.css') }}">
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Filter Links -->
        <div class="filter-links">
            <a href="{{ route('user.orders') }}" class="{{ request('status') == null ? 'active' : '' }}">All</a>
            <a href="{{ route('user.orders', ['status' => 'pending']) }}" class="{{ request('status') == 'pending' ? 'active' : '' }}">Pending</a>
            <a href="{{ route('user.orders', ['status' => 'in-progress']) }}" class="{{ request('status') == 'in-progress' ? 'active' : '' }}">In Progress</a>
            <br>
            <br>
            <a href="{{ route('user.orders', ['status' => 'completed']) }}" class="{{ request('status') == 'completed' ? 'active' : '' }}">Completed</a>
            <a href="{{ route('user.orders', ['status' => 'canceled']) }}" class="{{ request('status') == 'canceled' ? 'active' : '' }}">Canceled</a>
        </div>

        <!-- Orders List -->
        <section class="order-list">
            @php
                $filteredOrders = $orders->filter(function ($order) {
                    return !request('status') || request('status') === $order->status;
                });
            @endphp

            @if ($filteredOrders->isEmpty())
                <p class="no-orders">No orders yet.</p>
            @else
                @foreach ($filteredOrders as $order)
                    <div class="order-card {{ str_replace(' ', '-', strtolower($order->status)) }}"
                        onclick="window.location='{{ route('order.details', ['id' => $order->id]) }}'">
                        <div class="order-info">
                            <h3>Order #{{ $order->id }}</h3>
                            <p><strong>Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
                            <p><strong>Address:</strong> {{ $order->address }}</p>
                            <p><strong>Phone:</strong> +20{{ $order->phone }}</p>
                            <p><strong>Total Price:</strong> <span class="price">{{ $order->total_price }} EGP</span></p>
                            <p><strong>Status:</strong> <span class="status {{ str_replace(' ', '-', strtolower($order->status)) }}">{{ ucfirst($order->status) }}</span></p>
                            <p><strong>Payment Type:</strong> <span class="status {{ str_replace(' ', '-', strtolower($order->status)) }}">{{ ucfirst($order->Payment_type) }}</span></p>
                            <p><strong>Payment Status:</strong> <span class="status {{ str_replace(' ', '-', strtolower($order->status)) }}">{{ ucfirst($order->Payment_status) }}</span></p>
                        </div>
                    </div>
                @endforeach
            @endif
        </section>
    </div>
</x-app-layout>


