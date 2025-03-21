<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{asset('CSS/about_rosa.css')}}">
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Rosa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <center>
                    <br>
                    <h3>Our Story</h3>
                    <p class="p1">
                        Rosa Shop offers the best handmade products, including flower bouquets, pearl bags, and makeup items. 
                        With a passion for creativity and craftsmanship, we bring you unique and elegant products that add charm to any occasion.
                    </p>
                <br>
                    <h2>Our Journey</h2>
                    <br>
                    <h1 class="h2">From Handmade Creations to a Trusted Brand</h1>
                    <p class="p2">
                        Rosa Shop was founded with a vision to provide beautifully handcrafted products that reflect elegance and quality.
                        Our journey began with a deep love for artisanal designs, bringing together skilled hands and creative minds to craft each piece with precision.
                        <br><br>
                        Over time, we have grown into a trusted brand that offers a diverse collection of handmade flower bouquets, pearl bags, and makeup items.
                        Every product is made with dedication and care, ensuring that our customers receive only the finest creations.
                        <br><br>
                        At Rosa Shop, we believe in the beauty of handmade artistry. Each piece tells a story of passion and craftsmanship, making it the perfect gift or personal treasure.
                        We take pride in delivering products that not only look beautiful but also hold sentimental value for our customers.
                    </p>
                </center>                
            </div> 
        </div> 
    </div>
</x-app-layout>
