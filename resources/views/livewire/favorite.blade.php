<div>
    <div class="rating-favorite">
        @auth('web')
            <a wire:click="toggleFavorite">
                <i class="fa-solid fa-heart heart {{ $favorite ? 'active' : '' }}"></i>
            </a>
        @else
            <a href="{{ route('auth.google') }}">
                <i class="fa-solid fa-heart heart"></i>
            </a>
        @endauth
    </div>
</div>
