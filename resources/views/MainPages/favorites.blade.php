<x-app-layout>
    <link rel="stylesheet" href="{{asset('CSS/my_favorites.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/all.css')}}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Favorites') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section class="container">
                    @if ($favorites->isEmpty())
                    <center style="display: block">
                        <h2 style="    margin: 50px;">No Favorites Yet </h2>
                        <div><a style="    color: red;
                            border: 1px solid red;
                            padding: 8px;
                            border-radius: 10px;" href="{{route('Home')}}">Products</a></div>
                        
                    </center>
                    @else
                    @foreach ($favorites as $favorite)
                    <div class="card">
                        <div class="card-header">
                            <livewire:favorite :roseId="$favorite->rosa->id" />
                            <a href="{{ route('user_details', ['id' => $favorite->rosa->id]) }}" class="canonical">
                                <div class="img-cont">
                                    <img src="{{ 'storage/' . $favorite->rosa->path }}" alt="" />
                                </div>
                            </a>
                    
                            <div class="card-title">
                                <h3> {{ $favorite->rosa->title }}</h3>
                            </div>
                        </div>
                        <div class="card-footer">
                            <p class="card-price">
                                @if ($favorite->rosa->discount !== 0)
                                <span class="price-before"><del>{{$favorite->rosa->price + $favorite->rosa->discount}}</del> EGP</span>
                                @endif
                                <span class="price-after">{{$favorite->rosa->price}} EGP</span>
                            </p>
                            <livewire:cart :roseId="$favorite->rosa->id" />
                    
                        </div>
                    </div>
                    @endforeach
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
