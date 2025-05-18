<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Check Out') }}
        </h2>
    </x-slot>
    <br>
    @if (session('error'))
        <div style="color: red; background: #ffe6e6; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
            <center>
                {{ session('error') }}
            </center>
        </div>
    @endif

    @if (session('success'))
        <div style="color: green; background: #e6ffe6; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
            <center>
                {{ session('success') }}
            </center>
        </div>
    @endif
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg border border-gray-300 p-6 md:p-8"
        style="max-width: 800px">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Checkout</h2>
        <form action="{{ route('cart.order') }}" method="post">
            @csrf
            <!-- Total Price -->
            <div class="flex justify-between items-center bg-gray-100 p-4 rounded-md mb-6">
                <span class="text-lg font-medium text-gray-700">Total Price:</span>
                <span
                    class="text-xl font-semibold text-green-600">{{ number_format($totalPrice, 2) . '+' . $shippingCost->cost }}
                    EGP</span>
            </div>

            <!-- Contact Information -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone"
                        class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                        placeholder="Enter your phone number">
                </div>
                @error('phone')
                    <div style="color: rgb(255, 0, 0)" class="text-danger">{{ $message }}</div>
                @enderror
                <div>
                    <label class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea name="address" class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                        placeholder="Enter your full address"></textarea>
                </div>
            </div>
            @error('address')
                <div style="color: rgb(255, 0, 0)" class="text-danger">{{ $message }}</div>
            @enderror
            <!-- Shipping Info -->
            <div class="bg-gray-100 p-4 rounded-md mt-6">
                <h3 class="text-lg font-semibold text-gray-700">Shipping Information</h3>
                <p class="text-sm text-gray-600 mt-1">Estimated delivery: <strong>3-5 business days</strong>.</p>
                <p class="text-sm text-gray-600 mt-1">Shipping method: Standard delivery</p>
                <p class="text-sm text-gray-600 mt-1">Cost: 50 EGP</p>
            </div>

            <!-- Checkout Button -->
            <div class="mt-6">
                <div class="flex justify-center mt-6">
                    <button
                        style="
    background-color: #ff0076;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;">
                        Order Now
                    </button>

                </div>

            </div>
        </form>
    </div>
    <br>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
</x-app-layout>
