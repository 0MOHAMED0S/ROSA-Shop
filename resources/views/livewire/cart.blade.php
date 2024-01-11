<div>
    @if (auth('web')->check())
    @if ($rose)
    <button class="btn active" wire:click="toggleFavorite">
        <i class="fa-duotone fa-cart-shopping "></i>
        {{-- <p class="message-byn">تمت الاضافة</p> --}}
    </button>
@else
    <button class="btn " wire:click="toggleFavorite">
        <i class="fa-duotone fa-cart-shopping  "></i>
        {{-- <p class="message-byn">تمت الازاله</p> --}}
    </button>
@endif

@else
<button class="btn " >
    <a href="{{route('login')}}">  
        <i class="fa-duotone fa-cart-shopping "></i>
    </a>
    {{-- <p class="message-byn">تمت الاضافة</p> --}}
</button>
@endif
</div>
