<div>
    <div class="rating-favorite">
        @if (auth('web')->check())
    <a wire:click="toggleFavorite">
        @if ($rose)
        <i class="fa-solid fa-heart heart active"></i>
        @else
        <i class="fa-solid fa-heart heart "></i>
        @endif
    </a>
    @else
    <a href="{{route('auth.google')}}">
    <i class="fa-solid fa-heart heart "></i>
    </a>
    @endif

    </div>
</div>
