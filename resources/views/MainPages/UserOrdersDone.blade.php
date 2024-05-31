<x-app-layout>
    <link rel="stylesheet" href="{{ asset('CSS/orders.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/cart.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Done Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <section>
            @foreach ($orders->groupBy('address') as $address => $addressOrders)
            <br>
    <hr>
    <br>
    @foreach ($addressOrders->groupBy('number') as $number => $numberOrders)
        @foreach ($numberOrders->groupBy(function ($order) {
            return \Carbon\Carbon::parse($order->created_at)->format('Y-m-d');
        }) as $date => $dateOrders)
            {{-- Display orders for the specific address, phone number, and date --}}
            <center>
                <h3>Address: at {{ $address }} <br>(Phone: +20{{ $number }}) <br>
                    orderd in{{ $date }}
                <br>
                </h3>
            </center>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop through orders for the current address, phone number, and date --}}
                    <?php $totalPrice = 0; ?>
                    @foreach ($dateOrders as $order)
                        <tr>
                            <td>
                                {{-- Product details --}}
                                <a href="{{ route('admin_details', ['id' => $order->rosa->id]) }}" class="canonical">
                                    <div class="img-cont">
                                        <center>
                                            <img src="{{ asset('storage/' . $order->rosa->path) }}" alt="{{ $order->rosa->title }}">
                                        </center>
                                    </div>
                                </a>
                                <h3>{{ $order->rosa->title }}</h3>
                            </td>
                            <td>{{ $order->rosa->price }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->total_price }} EGP</td>
                        </tr>
                        <?php $totalPrice += $order->total_price; ?>
                    @endforeach

                </tbody>
            </table>
            <center  style="color: rgb(0 124 0);
            border: 1px solid rgb(0, 255, 0);
            padding: 8px;
            border-radius: 20px;">Total Price: <span style="color: rgb(255, 0, 0)">{{ $totalPrice }}</span> EGP</center>
            <br>
    <hr>
    <br>
        @endforeach
    @endforeach

@endforeach



            {{-- <div class="main-section">
                <h4>Order 1 ----- 5/11/2023 <SPan style="color: rgb(0, 255, 0);">DONE</SPan></h4>
                <h4> address:cairo</h4>
                <table style="    BACKGROUND-COLOR: #07c6001a;            ">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="../PAGES/product_details.html" class="canonical">
                                    <div class="img-cont">
                                        <img src="../files/images/Jqcj4oGC3vqT6Us9nsPznzO2RlquxWak74RfuaGD.png"
                                            alt="Product 1">
                                    </div>
                                </a>
                                <h3> Subtle Freshness </h3>
                            </td>
                            <td>199.99 EGP</td>
                            <td>
                                2
                            </td>
                            <td>399.38 EGP</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="../PAGES/fake_data.html/p7.html" class="canonical">
                                    <div class="img-cont">
                                        <img src="../files/images/8XxDPSVrif5ZrMTs5zriDGz3YvnokY9J849YdMj4yl.png"
                                            alt="" />
                                    </div>
                                </a>
                                <h3> Golden Hour</h3>
                            </td>
                            <td>239.99 EGP</td>
                            <td>
                                5
                            </td>
                            <td>1199.95 EGP</td>
                        </tr>
                    </tbody>
                </table>
                <center>
                    <h1>TOTAL : <span> 1599.33 EGP</span> </h1>
                </center>
            </div>
            <br>
            <hr>
            <br>
            <br> --}}
        </section>
    </div>
</x-app-layout>
