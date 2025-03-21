<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/main.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/stayle.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/all.css') }}">
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section>
                <div class="main-section">
                    <h1> WELCOME IN <span>ROSA</span> SHOP</h1>
                    <img src="{{ asset('files/main_images/logo/logo2.png') }}" alt="">
                    <br>
                    <DIV id="shop_div">
                        <a href="#down" class="shop_now">SHOP NOW </a>
                    </DIV>
                </div>
                <br id="down" style="padding-bottom: 50px;">
            </section>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <center
                    style="display: flex;justify-content: center;align-items: center;flex-direction: column;margin-bottom: 50px;">
                    <h1 class="CATEGORIES">ALL PRODUCTS</h1>
                    <!-- Filter Form -->
                    <form action="{{ route('Home') }}#down" method="GET" style="display: flex; gap: 10px;">
                        <!-- Section Dropdown -->
                        <select name="section_id" style="border-radius: 10px; padding:5px;">
                            <option value="">All Sections </option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}"
                                    {{ request('section_id') == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Search Box -->
                        <input type="text" name="search" placeholder="Search"
                            style="border-radius: 10px; padding:5px;" value="{{ request('search') }}">
                        <!-- Submit Button -->
                        <button type="submit"
                            style="color: #ff0076; border: 1px solid; border-radius: 10px; padding: 5px;">
                            SEARCH
                        </button>
                    </form>
                </center>
                @if ($products->isEmpty())
                    <center style="padding: 10px;color:red;">
                        No Products Yet
                    </center>
                @else
                    <section style="background-color: transparent;" class="container">
                        @foreach ($products as $product)
                            <div class="card">
                                <div class="card-header">
                                    <livewire:favorite :roseId="$product->id" />
                                    <a href="{{ route('product.details', ['id' => $product->id]) }}" class="canonical">
                                        <div class="img-cont">
                                            <img src="{{ asset('storage/' . $product->path) }}" alt="" />
                                        </div>
                                    </a>
                                    <div class="card-title">
                                        <h3>{{ $product->name }} </h3>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="card-price">
                                        @if ($product->discount !== 0)
                                            <span
                                                class="price-before"><del>{{ $product->price + $product->discount }}</del>
                                                EGP</span>
                                        @endif
                                        <span class="price-after">{{ $product->price }} EGP</span>
                                    </p>
                                        <livewire:cart :roseId="$product->id" />
                                </div>
                            </div>
                        @endforeach
                    </section>
                @endif
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="{{ asset('JS/main.js') }}"></script>
    @endpush
</x-app-layout>
