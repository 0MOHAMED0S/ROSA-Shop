<x-app-layout>
    <link rel="stylesheet" href="{{ asset('CSS/create.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="page-home">

                    <form action="{{ route('update', $rose->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                        <center>
                            <H1> <span>Edit </span> PRODUCT</H1>
                        </center>


                        <div class="form-header">
                            <div class="header-product">
                                <label for="add">Add name product</label>
                                <input type="text" name="title" id="add" placeholder="Add name " value="{{old('title',$rose->title)}}">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="header-product">
                                <label for="price">Add price product</label>
                                <input type="number" name="price" id="price" placeholder="Add price " value="{{old('price',$rose->price)}}">
                                @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <center>
                            <div class="header-product">
                                <label for="discount">Add price discount</label>
                                <input type="number" name="discount" id="discount" placeholder="Add discount " value="{{old('discount',$rose->discount)}}">
                                @error('discount')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </center>
                        <center>
                            <label for="image">Choose The product image</label>
                            <input type="file" name="path" id="image">
                            {{$rose->path}}
                            @error('path')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </center>

                        <label for="description">Add description</label>
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Add description" >{{old('description',$rose->description)}}</textarea>
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
