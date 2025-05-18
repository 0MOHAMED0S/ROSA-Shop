<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/order_details.css') }}">
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="order-details-container">
            <h3>Order #{{ $order->id }}</h3>
            <p><strong>Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>Phone:</strong> +20{{ $order->number }}</p>
            <p><strong>Total Price:</strong> <span class="price">{{ $order->total_price }} EGP</span></p>
            <p><strong>Status:</strong>
                <span class="status {{ str_replace(' ', '-', strtolower($order->status)) }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
    <p><strong>Payment Type:</strong> <span class="status {{ str_replace(' ', '-', strtolower($order->status)) }}">{{ ucfirst($order->Payment_type) }}</span></p>
                            <p><strong>Payment Status:</strong> <span class="status {{ str_replace(' ', '-', strtolower($order->status)) }}">{{ ucfirst($order->Payment_status) }}</span></p>
                        
            <h4>Items in this Order:</h4>
            <table class="order-items">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $item->product->path) }}" alt="Product Image" class="product-image">
                        </td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }} EGP</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('user.orders') }}" class="back-button">Back to Orders</a>
        </div>
    </div>
</x-app-layout>


