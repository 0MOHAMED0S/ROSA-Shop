<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('CSS/my_favorites.css') }}">
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Favorites') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($products->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="padding: 50px;">
                    <center style="display: block">
                        <h2 style="margin: 50px;">No Favorites Yet</h2>
                        <div><a style="color: red;border: 1px solid red;padding: 8px;border-radius: 10px;"
                                href="{{ route('AllProducts') }}">Products</a></div>
                    </center>
                </div>
            @else
                <section class="container">
                    @foreach ($products as $favorite)
                        <div class="card">
                            <div class="card-header">
                                <livewire:favorite :productId="$favorite->product->id" />
                                <a href="{{ route('product.details', ['id' => $favorite->product->id]) }}"
                                    class="canonical">
                                    <div class="img-cont">
                                        <img src="{{ 'storage/' . $favorite->product->path }}" alt="" />
                                    </div>
                                </a>

                                <div class="card-title">
                                    <h3> {{ $favorite->product->title }}</h3>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p class="card-price">
                                    @if ($favorite->product->discount !== 0)
                                        <span
                                            class="price-before"><del>{{ $favorite->product->price + $favorite->product->discount }}</del>
                                            EGP</span>
                                    @endif
                                    <span class="price-after">{{ $favorite->product->price }} EGP</span>
                                </p>
                                <livewire:cart :productId="$favorite->product->id" />
                            </div>
                        </div>
                    @endforeach
            @endif
            </section>
        </div>
    </div>
    @push('scripts')
    <script src="{{ asset('JS/main.js') }}"></script>
@endpush
</x-app-layout>
