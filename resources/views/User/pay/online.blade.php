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
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Checkout With Paymob</h2>
        <form action="{{ route('paymentProcess') }}" method="post">
            @csrf

            <!-- Total Price -->
            <div class="flex justify-between items-center bg-gray-100 p-4 rounded-md mb-6">
                <span class="text-lg font-medium text-gray-700">Total Price:</span>
                <span class="text-xl font-semibold text-green-600">
                    {{ number_format($totalPrice, 2) . '+' . $shippingCost->cost }} EGP
                </span>
            </div>

            <!-- Address -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <textarea name="address" class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                    placeholder="Enter your full address">{{ old('address') }}</textarea>
                @error('address')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Shipping Data Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="shipping_data[first_name]" value="{{ old('shipping_data.first_name') }}"
                        class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                        placeholder="First Name" required>
                    @error('shipping_data.first_name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="shipping_data[last_name]" value="{{ old('shipping_data.last_name') }}"
                        class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                        placeholder="Last Name" required>
                    @error('shipping_data.last_name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" readonly name="shipping_data[email]" value="{{ Auth::user()->email }}"
                        class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                        placeholder="Email@test.com" required>
                    @error('shipping_data.email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" name="shipping_data[phone_number]"
                        value="{{ old('shipping_data.phone_number') }}"
                        class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                        placeholder="01110562097" required>
                    @error('shipping_data.phone_number')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Shipping Info -->
            <div class="bg-gray-100 p-4 rounded-md mt-6">
                <h3 class="text-lg font-semibold text-gray-700">Shipping Information</h3>
                <p class="text-sm text-gray-600 mt-1">Estimated delivery: <strong>3-5 business days</strong>.</p>
                <p class="text-sm text-gray-600 mt-1">Shipping method: Standard delivery</p>
                <p class="text-sm text-gray-600 mt-1">Cost: {{ $shippingCost->cost }} EGP</p>
            </div>

            <!-- Checkout Button -->
            <div class="mt-6 flex justify-center">
                <button type="submit"
                    class="bg-blue-600 hover:bg-pink-700 text-white font-bold py-2 px-6 rounded-lg transition">
                    Order Now With Paymob
                </button>
            </div>
        </form>

    </div>
    <br>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
</x-app-layout>
