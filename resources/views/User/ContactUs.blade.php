<x-app-layout>
    @push('styles')
        <style>
            .custom-contact-container {
                display: flex;
                flex-wrap: wrap;
                background: white;
                width: 100%;
                max-width: 800px;
                height: auto;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

            .contact-form {
                width: 100%;
                max-width: 400px;
                padding: 40px 30px;
                box-sizing: border-box;
                flex: 1 1 50%;
            }

            .contact-form h2 {
                margin-bottom: 10px;
                font-size: 28px;
                color: #ec1172;
            }

            .contact-form p {
                font-size: 14px;
                color: #666;
                margin-bottom: 20px;
            }

            .contact-form input,
            .contact-form textarea {
                width: 100%;
                margin-bottom: 15px;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-size: 14px;
            }

            .contact-form button {
                background-color: #ec1172;
                color: white;
                border: none;
                padding: 10px 20px;
                font-size: 14px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .contact-form button:hover {
                background-color: #d01065;
            }

            .image-section {
                width: 100%;
                max-width: 400px;
                background-color: #fff0f7;
                display: flex;
                align-items: center;
                justify-content: center;
                flex: 1 1 50%;
                padding: 20px;
                box-sizing: border-box;
            }

            .image-section img {
                width: 100%;
                max-width: 300px;
                height: auto;
            }

            @media (max-width: 768px) {
                .custom-contact-container {
                    flex-direction: column;
                }

                .image-section,
                .contact-form {
                    max-width: 100%;
                }
            }
        </style>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact Us') }}
        </h2>
    </x-slot>
    <div class="py-12  min-h-screen flex items-center justify-center">
        <div class="custom-contact-container">
            <div class="contact-form">
                <h2>Contact Us</h2>
                <p>Please fill in the form below and we will get back to you shortly.</p>
            
                {{-- Alerts and Validation Errors --}}
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif
            
                @if (session('error'))
                    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                        {{ session('error') }}
                    </div>
                @endif
            
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            
                <form method="POST" action="{{ route('contact.send.rosa') }}">
                    @csrf
                    <textarea name="message" rows="5" placeholder="Write your message here..." required>{{ old('message') }}</textarea>
                    <button type="submit">Submit</button>
                </form>
            </div>
            
            <div class="image-section">
                <img src="{{asset('files/main_images/logo/logo2.png')}}" alt="Support">
            </div>
        </div>
    </div>
</x-app-layout>
