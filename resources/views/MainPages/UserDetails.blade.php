<x-app-layout>
    <link rel="stylesheet" href="{{asset('CSS/product_details.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/all.css')}}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section>
                    <div class="main-section">
                        <div id="contenar">
                            <div id="start">
                                <div class="card-header">

                                    <livewire:favorite :roseId="$rose->id" />


                                </div>
                                <dl>

                                    <div id="end">
                                        <h2>{{ $rose->title }}</h2>
                                    </div>
                                    <DIV id="imo">
                                        <center>
                                            <img src="{{ asset('storage/' . $rose->path) }}" alt="ros">
                                        </center>
                                    </DIV>
                                    <center id="center">
                                        
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
                                <br>
                                <center>

                                    <div class="card-footer">
                                        <livewire:cart :roseId="$rose->id" />
                                    </div>

                                </center>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="{{asset('JS/main.js')}}"></script>
</x-app-layout>
