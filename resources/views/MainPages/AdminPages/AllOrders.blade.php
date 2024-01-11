<x-app-layout>
    <link rel="stylesheet" href="{{asset('CSS/cart.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/orders.css')}}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <section>
            @foreach($users as $user)
            @if($user->orders->isNotEmpty())
                <div class="main-section">
                    <h2>User: {{ $user->name }}</h2>
        
                    {{-- User details table --}}
                    <table id="first_table">
                        <tr>
                            <th>NAME</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>EMAIL</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                    </table>
        
                    {{-- Loop through orders grouped by date --}}
                    @foreach ($user->orders->groupBy('address') as $address => $addressOrders)
                        <br>
                        <hr>
                        <br>
                        @foreach ($addressOrders->groupBy('number') as $number => $numberOrders)
                            @foreach ($numberOrders->groupBy(function ($order) {
                                return \Carbon\Carbon::parse($order->created_at)->format('Y-m-d');
                            }) as $date => $dateOrders)
                                {{-- Display orders for the specific address, phone number, and date --}}
                                <center>
                                    <h3>Address: at {{ $address }} <br>(Phone: +20{{ $number }}) <br> {{ $date }}</h3>
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
                                <center>Total Price: <span style="color: rgb(255, 0, 0)">{{ $totalPrice }}</span> EGP  <br>
                                    <form action="{{route('AllOrdersDone')}}" method="POST">
                                        @csrf
                                        <input hidden type="number" name="number" value="{{$number}}" id="">
                                        <input hidden type="number" name="user_id" value="{{$user->id}}" id="">
                                        <input hidden type="date" name="date" value="{{$date}}" id="">
                                        <input hidden type="text" name="address" value="{{$address}}" id="">
                                        <button style="    border: 2px solid lime;
                                        padding: 8px;
                                        border-radius: 11px;
                                        margin: 15px;
                                        color: green;" id="submitButton">Done</button>
                                    </form>
                                </center>
                                <br>
                                <hr>
                                <br>
                            @endforeach
                            <br>
                            <hr>
                            <br>
                        @endforeach
                        <br>
                        <hr>
                        <br>
                    @endforeach
                </div>
            @endif
        @endforeach
        </section>
    </div>
    <script src="{{ asset('JS/spam.js') }}"></script>
</x-app-layout>


