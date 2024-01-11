<x-app-layout>
    <link rel="stylesheet" href="{{ asset('CSS/main.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/stayle.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/all.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section>

                <div class="main-section">

                    <h1> WELCOME IN <span>ROSA</span> SHOP</h1>
                    <img src="{{ asset('files/main_images/main.png') }}" alt="">
                    <DIV id="shop_div">
                        <a href="#down" class="shop_now">SHOP NOW </a>
                    </DIV>
                </div>
                <br id="down" style="padding-bottom: 50px;">

            </section>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">



                @if ($roses->isEmpty())

                    <center style="padding: 10px;color:red;">
                        No Products Yet
                    </center>
                @else
                    <center
                        style="display: flex;justify-content: center;align-items: center;flex-direction: column;margin-bottom: 50px; ">
                        <h1 class="CATEGORIES">
                            ALL PRODUCTS
                        </h1>
                        <form>
                            <input type="text" placeholder="Search" style="border-radius: 10px; padding:5px;">
                            <button
                                style="    color: #ff0076;
                        border: 1px solid; border-radius: 10px;
                        padding: 2px;border-rad"
                                type="submit">SEARCH</button>
                        </form>
                    </center>
                    <section style="background-color: transparent;" class="container">


                        @foreach ($roses as $rose)
                            <div class="card">
                                <div class="card-header">
                                    <livewire:favorite :roseId="$rose->id" />
                                    <a href="{{ route('user_details', ['id' => $rose->id]) }}" class="canonical">
                                        <div class="img-cont">
                                            <img src="{{ asset('storage/' . $rose->path) }}" alt="" />
                                        </div>
                                    </a>
                                    <div class="card-title">
                                        <h3>{{ $rose->title }} </h3>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="card-price">
                                        @if ($rose->discount !== 0)
                                            <span class="price-before"><del>{{ $rose->price + $rose->discount }}</del>
                                                EGP</span>
                                        @endif
                                        <span class="price-after">{{ $rose->price }} EGP</span>
                                    </p>

                                    <livewire:cart :roseId="$rose->id" />

                                </div>
                            </div>
                        @endforeach

                    </section>
                @endif

            </div>
        </div>
    </div>
    <script src="{{ asset('JS/main.js') }}"></script>

</x-app-layout>
