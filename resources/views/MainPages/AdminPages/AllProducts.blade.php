<x-app-layout>
    <link rel="stylesheet" href="{{asset('CSS/Products.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/all.css')}}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <center id="create">
                    <a class="start_shop" href="{{route('Create')}}">CREATE ?</a>
                    <form>
                        <input type="text" placeholder="Search" style="border-radius: 10px; padding:5px;">
                        <button style="    color: #ff0076;
                        border: 1px solid; border-radius: 10px;
                        padding: 2px;border-rad" type="submit">SEARCH</button>
                    </form>
                </center>
    <section class="container">
        @foreach ($roses as $rose )
        <div class="card">
            <div class="card-header">
                <div class="Products-Edit">
                    <i class="fa-light fa-pen Edit"> <a  href="{{ route('edit', ['id' => $rose->id]) }}"></a> </i>
                    <i class="fa-sharp fa-solid fa-trash trash"> <a href="{{route('delete', ['id' => $rose->id])}}"></a> </i>
                </div>
                <a href="{{ route('admin_details', ['id' => $rose->id]) }}" class="canonical">
                    <div class="img-cont">
                        <img src="{{asset('storage/'. $rose->path)}}" alt="" />
                    </div>
                </a>
                <div class="card-title">
                    <h3> {{$rose->title}}</h3>
                </div>
            </div>
            <div class="card-footer">
                <p class="card-price">
                    @if ($rose->discount !== 0)
                    <span class="price-before">{{$rose->price + $rose->discount}} EGP</span>
                    @endif
                    <span class="price-after">{{$rose->price}} EGP</span>
                </p>
                <span></span>
            </div>
        </div>
        @endforeach
            </section>
            </div>
        </div>
    </div>
</x-app-layout>
