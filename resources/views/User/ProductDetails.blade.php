<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/product_details.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/all.css') }}">
    @endpush

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
                                    <livewire:favorite :productId="$product->id" />
                                </div>

                                <dl>
                                    <div id="end">
                                        <h2>{{ $product->name }}</h2>
                                    </div>
                                    <div id="imo">
                                        <center>
                                            <img src="{{ asset('storage/' . $product->path) }}" 
                                                 id="product-img"
                                                 alt="Product Image">
                                        </center>
                                    </div>
                                    <center id="center">
                                        @if ($product->discount !== 0)
                                            <span class="price-before">
                                                <del>{{ $product->price + $product->discount }}</del> EGP
                                            </span>
                                        @endif
                                        <span class="price-after">{{ $product->price }} EGP</span>
                                    </center>
                                </dl>
                            </div>
                            <div id="end">
                                <p style="text-align: right; direction: rtl; font-family: 'Tajawal', 'Amiri', 'Cairo', sans-serif;">
                                    {{ $product->description }}
                                </p>
                                <br>
                                <center>
                                    <div class="card-footer">
                                        <livewire:cart :productId="$product->id" />
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
        <div class="relative">
            <img id="lightbox-img" class="max-w-full max-h-[90vh] rounded-lg shadow-lg" alt="Product Image">
            <button id="close-lightbox" class="absolute top-2 right-2 text-white text-3xl">&times;</button>
        </div>
    </div>

    @push('scripts')
    <script src="{{ asset('JS/main.js') }}"></script>
    <script src="{{ asset('JS/lightbox.js') }}"></script>
    @endpush
</x-app-layout>
