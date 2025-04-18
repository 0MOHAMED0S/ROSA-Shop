<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('CSS/main.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/stayle.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/all.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/swipper.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/search.css') }}">
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products') }}
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
            @include('layouts.shipping')
            <br>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <center class="m-4" style="display: flex; flex-direction: column; align-items: center; margin-bottom: 30px;">
                    <h1 class="CATEGORIES">ALL PRODUCTS</h1>

                    <!-- Search Bar -->
                    <form action="{{ route('AllProducts') }}" method="GET" class="search-form">
                        <input type="text" name="search" placeholder="Search products..." class="search-input"
                            value="{{ request('search') }}">
                        <button type="submit" class="search-button">🔍 Search</button>
                    </form>

                    <!-- Section Buttons -->
                    <div class="section-container">
                        <a href="{{ route('AllProducts') }}"
                            class="section-btn {{ request('section_id') ? '' : 'active' }}">
                            All Sections
                        </a>
                        @foreach ($sections as $section)
                            <a href="{{ route('AllProducts', ['section_id' => $section->id]) }}"
                                class="section-btn {{ request('section_id') == $section->id ? 'active' : '' }}">
                                {{ $section->name }}
                            </a>
                        @endforeach
                    </div>
                </center>
                @if ($products->isEmpty())
                    <center style="padding: 10px;color:red;">
                        No Products Yet
                    </center>
                @else
                    <br>
                    <br>

                    <br>
                    <section style="background-color: transparent;" class="container">
                        @foreach ($products as $product)
                            <div class="card">
                                <div class="card-header">
                                    <livewire:favorite :productId="$product->id" />
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
                                    <livewire:cart :productId="$product->id" />
                                </div>
                            </div>
                        @endforeach
                    </section>
                @endif
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('JS/offer.js') }}"></script>
        <script src="{{ asset('JS/count.js') }}"></script>
        <script src="{{ asset('JS/main.js') }}"></script>
    @endpush
</x-app-layout>
