<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-8 px-4">

        {{-- Title --}}
        <div class="text-center mb-10">
            <h3 class="text-2xl font-bold text-gray-800">Select Your Payment Method</h3>
            <p class="text-gray-500 mt-2">Choose how you’d like to pay for your order.</p>
        </div>

        {{-- Payment Method Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Cash on Delivery --}}
            <a href="{{route('cart.checkout')}}"
                class="group block bg-white border border-gray-200 rounded-xl shadow hover:shadow-lg hover:border-indigo-500 transition duration-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-600">Cash on Delivery</h4>
                        <p class="text-sm text-gray-500 mt-1">Pay with cash when your order arrives.</p>
                    </div>
                    <div
                        class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            {{-- Online / Wallet --}}
            <a href="{{route('cart.online_check_out')}}"
                class="group block bg-white border border-gray-200 rounded-xl shadow hover:shadow-lg hover:border-indigo-500 transition duration-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-600">Online / Wallet</h4>
                        <p class="text-sm text-gray-500 mt-1">Pay securely using card or digital wallet.</p>
                    </div>
                    <div
                        class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
