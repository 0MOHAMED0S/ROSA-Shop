<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pay Ment') }}
        </h2>
    </x-slot>

    <div class="py-12" style="    display: flex;justify-content: center;">
        <div class="container" style="    width: -webkit-fill-available;
        max-width: 636px;">
            <div class="row"
                style=" 
            padding: 20px;
            border: 1px solid red;
            border-radius: 20px;">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading display-table"
                            style="    padding-bottom: 10px;
                        border: 1px solid;
                        border-color: transparent transparent red transparent;">
                            <h3 style="display: flex;     justify-content: space-between;" class="panel-title">
                                Payment
                                <div style="display:flex;">
                                    <img width="60" height="60"
                                        src="{{ asset('files/main_images/WhatsApp Image 2023-12-12 at 19.35.41_7342f2bd.jpg') }}"
                                        alt="">
                                    <img width="60" height="60"
                                        src="{{ asset('files/main_images/WhatsApp Image 2023-12-12 at 19.35.41_2faf5f60.jpg') }}"
                                        alt="">
                                </div>
                            </h3>
                        </div>
                        <div class="panel-body">

                            @if (Session::has('success'))
                                <div style="background-color: rgb(255, 166, 166);color:rgb(255, 255, 255);"
                                    class="alert alert-success text-center">
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div style="background-color: rgb(255, 116, 116);color:rgb(255, 255, 255);    padding: 10px;
                            border-radius: 20px;margin-top:10px;"
                                    class="alert alert-danger text-center">
                                    <p>{{ Session::get('error') }}</p>
                                </div>
                            @endif

                            <form style="    margin: 18px;                            " role="form"
                                action="{{ route('stripe.post') }}" method="post" class="require-validation"
                                data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                id="payment-form">
                                @csrf

                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group required'
                                        style="    display: grid; margin: 10px;                                   ">
                                        <label class='control-label'>Name on Card</label> <input
                                            style="    border-radius: 5px;
                                        border: 1px solid #cacaca;"
                                            class='form-control' size='4' type='text' value="Visa">
                                    </div>
                                </div>
                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group required' style="    display: grid;margin: 10px; ">
                                        <input
                                            style="    border-radius: 5px;
                                        border: 1px solid #cacaca;"
                                            name="totalprice" hidden type='text' value="{{ $totalPrice }}">
                                    </div>
                                </div>
                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group card required'
                                        style="    display: grid; margin: 10px; ">
                                        <label class='control-label'>Card Number</label> <input
                                            style="    border-radius: 5px;
                                        border: 1px solid #cacaca;"
                                            autocomplete='off' class='form-control card-number' size='20'
                                            type='text' value="4242424242424242">
                                    </div>
                                </div>

                                <div class='form-row row'
                                    style="    display: flex;
                                gap: 50px;margin: 10px;">
                                    <div class='col-xs-12 col-md-4 form-group cvc required' style="    display: grid;">
                                        <label class='control-label'>CVC</label> <input autocomplete='off'
                                            style="    border-radius: 5px;
                                        border: 1px solid #cacaca;"
                                            class='form-control card-cvc' placeholder='ex. 311' size='4'
                                            type='text' value="501">
                                    </div>
                                    <div style="    gap: 8px;display: grid;    margin: 10px;                                    "
                                        class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Month</label> <input
                                            style="    border-radius: 5px;
                                        border: 1px solid #cacaca;"
                                            class='form-control card-expiry-month' placeholder='MM' size='2'
                                            type='text' value="02">
                                    </div>
                                    <div style="    gap: 8px;display: grid;    margin: 10px;                                    "
                                        class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Year</label> <input
                                            style="    border-radius: 5px;
                                        border: 1px solid #cacaca;"
                                            class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                            type='text' value="2026">
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-md-12 error form-group hide'>
                                        <div style="color:rgb(255, 0, 0);    padding: 10px;
                                        border-radius: 20px;"
                                            class='alert-danger alert'></div>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group required'
                                        style="    display: grid; margin: 10px;                                   ">
                                        <label class='control-label'>Number</label> <input name="number"
                                            style="    border-radius: 5px;
                                        border: 1px solid #cacaca;"
                                            class='form-control' size='4' type="number" value="01110562097">
                                    </div>
                                    @error('number')
                                    <div style="color: rgb(255, 0, 0)" class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group required'
                                        style="    display: grid; margin: 10px;                                   ">
                                        <label class='control-label'>Address</label> <input name="address"
                                            style="    border-radius: 5px;
                                        border: 1px solid #cacaca;"
                                            class='form-control' size='4' type='text' value="cairo">
                                    </div>
                                    @error('address')
                                    <div style="color: rgb(255, 0, 0)" class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <button
                                            style="width: -webkit-fill-available;
                                        background: #aaaaff;
                                        padding: 10px;
                                        text-align: center;
                                        color: white;
                                        margin: 10px;"
                                            class="btn btn-primary btn-lg btn-block"
                                            id="submitButton"   type="submit">{{ $totalPrice }} $</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="{{ asset('JS/stripe.js') }}"></script>
    <script src="{{ asset('JS/spam.js') }}"></script>

</x-app-layout>
