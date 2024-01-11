<x-app-layout>
    <link rel="stylesheet" href="{{ asset('CSS/product_details.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/all.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section>
                    <div class="main-section">
                        <div id="contenar">
                            <div id="start">
                                <dl>
                                    <div id="end">
                                        <center>
                                            <div class="Products-Edit">
                                                <i class="fa-light fa-pen Edit"> <a
                                                        href="{{ route('edit', ['id' => $rose->id]) }}"></a> </i>
                                                <i class="fa-sharp fa-solid fa-trash trash"> <a
                                                        href="{{ route('delete', ['id' => $rose->id]) }}"></a> </i>
                                            </div>
                                        </center>
                                        <br>
                                        <h2>{{ $rose->title }}</h2>
                                        <br>
                                    </div>
                                    <center>
                                        <img src="{{ asset('storage/' . $rose->path) }}" alt="ros">

                                    </center>
                                    <center id="center" style="gap: 40px;">
                                        @if ($rose->discount !== 0)
                    <span class="price-before"><del>{{$rose->price + $rose->discount}}</del> EGP</span>
                    @endif
                    <span class="price-after">{{$rose->price}} EGP</span>
                                    </center>
                                </dl>
                            </div>

                            <div id="end">
                                <p>
                                    {{ $rose->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
