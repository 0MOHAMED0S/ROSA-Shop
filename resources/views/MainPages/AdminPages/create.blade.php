<x-app-layout>
    <link rel="stylesheet" href="{{ asset('CSS/create.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="page-home">

                    <form action="{{route('store')}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <center>
                            <H1> <span>CREATE </span> PRODUCT</H1>
                        </center>


                        <div class="form-header">
                            <div class="header-product">
                                <label for="add">Add name product</label>
                                <input type="text" name="title" id="add" placeholder="Add name "
                                    value="{{ old('title') }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            
                            <div class="header-product">
                                <label for="price">Add price product</label>
                                <input type="number" name="price" id="price" placeholder="Add price "
                                    value="{{ old('price') }}">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <center>
                            <label for="image">Choose The product image</label>
                            <input type="file" name="path" id="image" value="{{ old('path') }}">
                            @error('path')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </center>
                        <label for="description">Add description</label>
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Add description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <center><button id="submitButton">CREATE</button></center>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('JS/spam.js') }}"></script>
</x-app-layout>
