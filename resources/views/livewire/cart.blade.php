<div>
    @auth('web')
        <button class="btn {{ $cart ? 'active' : '' }}" wire:click="toggleCartItem">
            <i class="fa-duotone fa-cart-shopping"></i>
        </button>
    @else
        <button class="btn">
            <a href="{{ route('auth.google') }}">
                <i class="fa-duotone fa-cart-shopping"></i>
            </a>
        </button>
    @endauth
</div>
