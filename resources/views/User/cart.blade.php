<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/cart.css') }}">
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>
    <div class="py-12">
        @if (session('error'))
    <div style="color: red; background: #ffe6e6; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
        <center>
            {{ session('error') }}
        </center>
    </div>
@endif

@if (session('success'))
    <div style="color: green; background: #e6ffe6; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
        <center>
            {{ session('success') }}
        </center>
    </div>
@endif

        @if ($carts->isEmpty())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="padding: 50px;">
                <center style="display: block">
                    <h2 style="margin: 50px;">No Products </h2>
                    <div><a style="color: red;border: 1px solid red;padding: 8px;border-radius: 10px;"
                            href="{{ route('AllProducts') }}">Products</a></div>
                </center>
            </div>
        @else
            <section>
                <div class="main-section">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>TOTAL</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr>
                                    <td>
                                        <a href="{{ route('product.details', ['id' => $cart->product->id]) }}"
                                            class="canonical">
                                            <div class="img-cont">
                                                <center><img src="{{ asset('storage/' . $cart->product->path) }}"
                                                        alt="Product 1"></center>
                                            </div>
                                        </a>
                                        <h3 style="color:red;" class="price">{{ $cart->product->price }} EGP</h3>
                                        <h3>{{ $cart->product->name }}</h3>
                                    </td>
                                    <livewire:quantity :cartId="$cart->id" :key="$cart->id" />
                                    <td class="total-price"> {{ $cart->total_price }} EGP</td>
                                    <td> <a href="{{ route('cart.delete', ['id' => $cart->id]) }}"
                                            class="quantity-btn">X</a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <center>
                        <h1>TOTAL: <span id="overall-total"> 0 EGP</span></h1>
                    </center>
                    <center><a id="submitButton" class="shop_now" href="{{ route('cart.Paymethod') }}" type="submit">BUY</a>
                    </center>
                </div>
            </section>
        @endif
    </div>
    @push('scripts')
    <script src="{{ asset('JS/cart.js') }}"></script>
    <script src="{{ asset('JS/spam.js') }}"></script>
    @endpush
</x-app-layout>
