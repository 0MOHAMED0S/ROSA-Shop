<x-app-layout>
    <link rel="stylesheet" href="{{asset('CSS/contact_us.css')}}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="    display: flex;
            justify-content: center;">
                <div class="body">
                    <div class="login-container">
                        <form class="login-form">
                            <center>
                                <img class="img1" src="../files/main_images/paper-plane-330.png" alt="">
                            </center>
                            <center>
                                <h2 class="h2">contact us</h2>
                                <div>
                                    <label for="expiry_month"><h4>Why are you contacting us?</h4></label>
                                    <select id="expiry_month" name="expiry_month" >
                                        <option  value="Choice">Choice</option>
                                        <option value="Would you like to tell us a suggestion?">Would you like to tell us a suggestion?</option>
                                        <option value="Would you like to tell us about a problem?">Would you like to tell us about a problem?</option>
                                        <option value="Would you like to tell us about a problem?">Request a product that is not available ?</option>
                                        <option value="something else">something else</option>
                                    </select>
                                </div>
                            </center>
                            <br>
                            <label class="lab1" for="">Username</label>
                            <input type="text" placeholder="Username " required>
                            <br>
                            <label class="lab2" for="">E-mail</label>
                            <input type="email" placeholder="E-mail" required>
                            <br>
                            <label class="lab3" for="">Message</label>
                            <textarea name="" id="message" cols="30" rows="10" placeholder="Add message"></textarea>
                            <br>
                            <br>
            
                            <button type="submit">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
