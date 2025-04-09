<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('CSS/main.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/stayle.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/all.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
        <link rel="stylesheet" href="{{ asset('CSS/swipper.css') }}">
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session('error'))
            <div style="color: red; background: #ffe6e6; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
                <center>{{ session('error') }}</center>
            </div>
        @endif

        @if (session('success'))
            <div style="color: green; background: #e6ffe6; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
                <center>{{ session('success') }}</center>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section>
                <div class="main-section">
                    <h1>WELCOME TO <span>ROSA</span> SHOP</h1>
                    <img src="{{ asset('files/main_images/logo/logo2.png') }}" alt="">
                    <br>
                    <div id="shop_div">
                        <a href="#down" class="shop_now">SHOP NOW</a>
                    </div>
                </div>
                <br id="down" style="padding-bottom: 50px;">
            </section>
            <!-- Free Shipping Offer Section -->
            <div
                class="offer-section bg-gradient-to-r from-blue-500 to-purple-600 text-white p-8 rounded-lg shadow-lg text-center mb-10">
                <h2 class="text-3xl font-extrabold">🚚 FREE SHIPPING ON ALL ORDERS! 🎉</h2>
                <p class="text-lg mt-2">Limited-time offer! Get your favorite products with free shipping before time
                    runs out.</p>

                <!-- Countdown Timer -->
                <div id="countdown"
                    class="text-4xl font-bold mt-4 bg-white text-red-600 p-4 rounded-lg inline-block shadow-md"></div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <center style="margin-bottom: 50px;">
                    <h1 style="    font-weight: 1000;font-size: 37px;" class="CATEGORIES">Best Sellers ↗️</h1>
                </center>

                @if ($products->isEmpty())
                    <center style="padding: 10px; color:red;">
                        No Products Yet
                    </center>
                @else
                    <div class="swiper-container-wrapper">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach ($products as $product)
                                    <div class="swiper-slide">
                                        <div class="card">
                                            <div class="card-header">
                                                <livewire:favorite :productId="$product->id" />
                                                <a href="{{ route('product.details', ['id' => $product->id]) }}"
                                                    class="canonical">
                                                    <div class="img-cont">
                                                        <img src="{{ asset('storage/' . $product->path) }}"
                                                            alt="" />
                                                    </div>
                                                </a>
                                                <div class="card-title">
                                                    <h3>{{ $product->name }}</h3>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <p class="card-price">
                                                    @if ($product->discount !== 0)
                                                        <span class="price-before">
                                                            <del>{{ $product->price + $product->discount }}</del> EGP
                                                        </span>
                                                    @endif
                                                    <span class="price-after">{{ $product->price }} EGP</span>
                                                </p>
                                                <livewire:cart :productId="$product->id" />
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                @endif
                <center style="margin-bottom: 25px;margin-top: 25px;">
                    <div id="shop_div">
                        <a href="{{route('AllProducts')}}" class="shop_now">See All</a>
                    </div>
                </center>
            </div>
            <br>
            <br>
            <section>
                <!-- About Us Section -->
                <div id="about-us"
                    class="about-us-section bg-white text-gray-800 p-12 rounded-lg shadow-lg text-center mb-10">
                    <h2 class="text-4xl font-extrabold text-pink-600 mb-4">🌸 About Rosa Shop 🌸</h2>
                    <p class="text-lg leading-relaxed max-w-3xl mx-auto text-gray-700">
                        At <span class="font-bold text-pink-500">Rosa Shop</span>, we are passionate about crafting the
                        finest
                        <span class="font-semibold">handmade products</span>. Our collection includes exquisite
                        <span class="text-pink-500">flower bouquets, elegant pearl bags, and high-quality makeup
                            items</span>.
                        Each product is made with love and attention to detail, ensuring you receive something truly
                        special. 💖
                    </p>

                    <!-- Social Media & Orders Stats -->
                    <div class="flex flex-wrap justify-center gap-4 mt-8">
                        <a href="https://www.instagram.com/rosa_shop77?igsh=MTRrNWp6b3Vyd3F6ZA==" target="_blank">
                            <div class="bg-pink-100 p-4 w-36 flex flex-col items-center rounded-lg shadow-md">
                                <i class="fab fa-instagram text-2xl text-pink-600"></i>
                                <p class="text-lg font-bold text-gray-800">Instagram</p>
                                <p id="instagram-followers" class="text-xl font-extrabold text-pink-600">0</p>
                            </div>
                        </a>
                        <a href="https://www.tiktok.com/@rosashop77" target="_blank">
                            <div class="bg-blue-100 p-4 w-36 flex flex-col items-center rounded-lg shadow-md">
                                <i class="fab fa-tiktok text-2xl text-black"></i>
                                <p class="text-lg font-bold text-gray-800">TikTok</p>
                                <p id="tiktok-followers" class="text-xl font-extrabold text-blue-600">0</p>
                            </div>
                        </a>
                        <a href="https://www.facebook.com/profile.php?id=61574142460999&locale=ar_AR" target="_blank">
                            <div class="bg-indigo-100 p-4 w-36 flex flex-col items-center rounded-lg shadow-md">
                                <i class="fab fa-facebook text-2xl text-blue-800"></i>
                                <p class="text-lg font-bold text-gray-800">Facebook</p>
                                <p id="facebook-followers" class="text-xl font-extrabold text-indigo-600">0</p>
                            </div>
                        </a>
                        <div class="bg-green-100 p-4 w-36 flex flex-col items-center rounded-lg shadow-md">
                            <i class="fas fa-shopping-cart text-2xl text-green-600"></i>
                            <p class="text-lg font-bold text-gray-800">Orders</p>
                            <p id="orders-count" class="text-xl font-extrabold text-green-600">0</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Testimonials Section -->
            <div class="bg-gray-100 py-12 mt-10">
                <h2 class="text-4xl font-extrabold text-center text-pink-600 mb-6">💬 What Our Customers Say 💬</h2>

                <div class="relative max-w-4xl mx-auto">
                    <!-- Slider Container -->
                    <div id="testimonial-slider" class="overflow-hidden relative w-full">
                        <div id="testimonial-wrapper" class="flex transition-transform duration-500 ease-in-out">
                            <!-- Testimonial 1 -->
                            <div
                                class="testimonial-slide w-full flex-shrink-0 p-6 text-center bg-white rounded-lg shadow-lg">
                                <img src="{{ asset('files/main_images/rate/zoz.jpg') }}" alt="User 1"
                                    class="mx-auto w-16 h-16 rounded-full mb-3">
                                <p class="text-lg font-semibold text-gray-800">Elzoz</p>
                                <div class="text-yellow-500 text-lg">⭐⭐⭐⭐⭐</div>
                                <p class="text-gray-600 mt-3">"المنتجات  بجد رووعه ما شاء الله "</p>
                            </div>
                            <!-- Testimonial 3 -->
                            <div
                                class="testimonial-slide w-full flex-shrink-0 p-6 text-center bg-white rounded-lg shadow-lg">
                                <img src="{{ asset('files/main_images/rate/magdy.jpg') }}" alt="User 2"
                                    class="mx-auto w-16 h-16 rounded-full mb-3">
                                <p class="text-lg font-semibold text-gray-800">M.Magdy</p>
                                <div class="text-yellow-500 text-lg">⭐⭐⭐⭐⭐</div>
                                <p class="text-gray-600 mt-3">"Highly recommend Rosa Shop!"</p>
                            </div>
                            <!-- Testimonial 2 -->
                            <div
                                class="testimonial-slide w-full flex-shrink-0 p-6 text-center bg-white rounded-lg shadow-lg">
                                <img src="{{ asset('files/main_images/rate/drdr.jpg') }}" alt="User 3"
                                    class="mx-auto w-16 h-16 rounded-full mb-3">
                                <p class="text-lg font-semibold text-gray-800">Ahmed M. ElDardery</p>
                                <div class="text-yellow-500 text-lg">⭐⭐⭐⭐⭐</div>
                                <p class="text-gray-600 mt-3">"  الجوده عاليه والخدمه ممتازه  "</p>
                            </div>
                            <!-- Testimonial 5 -->
                            <div
                                class="testimonial-slide w-full flex-shrink-0 p-6 text-center bg-white rounded-lg shadow-lg">
                                <img src="{{ asset('files/main_images/rate/eprahem.jpg') }}" alt="User 5"
                                    class="mx-auto w-16 h-16 rounded-full mb-3">
                                <p class="text-lg font-semibold text-gray-800">Eprahem </p>
                                <div class="text-yellow-500 text-lg">⭐⭐⭐⭐⭐</div>
                                <p class="text-gray-600 mt-3">"الورد تحفه 🌹"</p>
                            </div>
                            <div
                                class="testimonial-slide w-full flex-shrink-0 p-6 text-center bg-white rounded-lg shadow-lg">
                                <img src="{{ asset('files/main_images/rate/me.jpg') }}" alt="User 5"
                                    class="mx-auto w-16 h-16 rounded-full mb-3">
                                <p class="text-lg font-semibold text-gray-800">M.Sayed </p>
                                <div class="text-yellow-500 text-lg">⭐⭐⭐⭐⭐</div>
                                <p class="text-gray-600 mt-3">"🤍🤍"</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slider Navigation Buttons -->
                    <button id="prev-btn"
                        class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-pink-500 text-white p-2 rounded-full shadow-md">
                        ❮
                    </button>
                    <button id="next-btn"
                        class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-pink-500 text-white p-2 rounded-full shadow-md">
                        ❯
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
        <script src="{{ asset('JS/main.js') }}"></script>
        <script src="{{ asset('JS/offer.js') }}"></script>
        <script src="{{ asset('JS/count.js') }}"></script>
        <script src="{{ asset('JS/swipper.js') }}"></script>
        <script src="{{ asset('JS/rate.js') }}"></script>
        <script>
            // Your dynamic values from Blade
            var instaCount = {{ $number->insta }};
            var tikTokCount = {{ $number->tik }};
            var facebookCount = {{ $number->face }};
            var ordersCount = {{ $number->orders }};
        </script>
        
    @endpush
</x-app-layout>
