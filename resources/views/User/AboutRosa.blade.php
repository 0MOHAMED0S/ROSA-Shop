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
                    <h3>Our Story</h3>
                    <p class="p1"> Established in 1986, Flower Power emerged as Egypt’s first floral design house renowned for its flowers and creative displays. With over 30 years of market expertise and a full-fledged team working across Egypt, the one-stop design house offers styling for weddings, themed events and corporate functions as well as visual merchandise and artistic flowers for prestigious hotels and fashion brands.</p>
                    <h2> History</h2>
                    <h1 class="h2">From a Flower Shop to a One Stop Floral Design Boutique</h1>
                    <p class="p2">Flower Power Founder & CEO Malak Taher’s journey into the flower business started 35 years ago. Her passion for flowers has been engraved in her heart and soul since childhood. Her love affair with flowers began when she was a young girl who enjoyed running around in her family’s farm and thought that everything touched by nature was simply magical. <br>
                        1986, was the year she turned her hobby into a life time passion and business when her brother opened a small flower shop in Cairo and asked her to manage it. Little did she know that the decision to give him a hand would be a life changing experience. When she took over, there were only two people working with her: a florist and an assistant. It was a simple operation and in order to publicize what she was capable of doing and gain more clients, she started by making nice bouquets and offer them to friends. Most of Malak’s time was spent learning about the different types of flowers and ways to extend their life, and study the various schools of floral design. She then managed to buy a small van that she used to drive around Cairo with her team to deliver orders. <br> <br>
                        
                        Between 1986 and 1998, the reputation of a little store was growing and had a small base of loyal clients. The time had come to expand, and the company opened a second store in a more strategic location, easily accessible and more visible. Malak’s dream was to create a salon de fleurs where people would be warmly welcomed, feel comfortable, and find all the flowers, decorations, and accessories they may want, including vases, containers, and cards; in other words, it would be a one-stop shop for all their needs. The concept behind Flower Power was born: it was the first place of its kind in Egypt. As her hobby was developing into a more serious enterprise, her best and loyal friend Mona El Deeb-Marei decided to join forces, becoming an integral part of the company, not only a friend and confidant, but also a true partner without whom she would have never been able to run a successful business. They complemented each other in many ways, and together they were a winning team.</p>
                        {{-- <img src="{{asset('files/main_images/all3.jpg')}}" alt=""> --}}
                </center>
            </div>
        </div>
    </div>
</x-app-layout>
