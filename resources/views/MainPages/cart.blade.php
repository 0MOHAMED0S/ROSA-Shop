<x-app-layout>
    <link rel="stylesheet" href="{{asset('CSS/cart.css')}}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($carts->isEmpty())
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="padding: 50px;">
            <center style="display: block">
                <h2 style="    margin: 50px;">No Products </h2>
                <div><a style="    color: red;
                    border: 1px solid red;
                    padding: 8px;
                    border-radius: 10px;" href="{{route('Home')}}">Products</a></div>

            </center>
        </div>
@else
<section>
    <div class="main-section">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>TOTAL</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($carts as $cart)
                    <tr>
                        <td>
                            <a href="{{ route('user_details', ['id' => $cart->rosa->id]) }}"
                                class="canonical">
                                <div class="img-cont">
                                    <center><img src="{{ asset('storage/' . $cart->rosa->path) }}"
                                        alt="Product 1"></center>
                                </div>
                            </a>
                            <h3>{{ $cart->Rosa->title }}</h3>
                        </td>
                        <td class="price">{{ $cart->Rosa->price }} EGP</td>
                        <livewire:quantity :cartId="$cart->id" :key="$cart->id" />
                        <td class="total-price"> {{ $cart->total_price }} EGP</td>
                        <td> <a href="{{ route('del_cart', ['id' => $cart->id]) }}"
                                class="quantity-btn">X</a> </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <center>
            <h1>TOTAL: <span id="overall-total"> 0 EGP</span></h1>
        </center>
        <center><a id="submitButton" class="shop_now" href="{{route('check_out')}}" type="submit">BUY</a></center>

    </div>

</section>
@endif



    </div>

    <script src="{{asset('JS/cart.js')}}"></script>
    <script src="{{ asset('JS/spam.js') }}"></script>

</x-app-layout>
