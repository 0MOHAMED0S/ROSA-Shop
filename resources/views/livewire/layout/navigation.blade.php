<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('Home') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
                <!-- Navigation Links -->
                @if (auth()->check() && auth()->user()->status == 1)
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                @endif


                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('Home')" :active="request()->routeIs('Home')">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('AllProducts')" :active="request()->routeIs('AllProducts')">
                        {{ __('Products') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('blogs.index')" :active="request()->routeIs('blogs.index')">
                        {{ __('Blogs') }}
                    </x-nav-link>
                </div>
                @if (auth('web')->check())
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('user.orders')" :active="request()->routeIs('user.orders')">
                        {{ __('Orders') }}
                    </x-nav-link>
                </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('favorites')" :active="request()->routeIs('favorites')">
                            <img width="35" height="30" src="{{ asset('files/main_images/heart (3).png') }}"
                                alt="">
                        </x-nav-link>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
                            <img width="35" height="30" src="{{ asset('files/main_images/flower-shop.png') }}"
                                alt="">
                        </x-nav-link>
                    </div>
                @endif
            </div>

            @if (auth('web')->check())
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div style="color: #ff0076;" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                    x-on:profile-updated.window="name = $event.detail.name"></div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class='block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out'>
                                    <i class="fa fa-power-off me-1 ms-1"></i>
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
            <div class="hidden sm:flex items-center text-center text-[#ff0076]">
                <a href="{{ route('auth.google') }}">Login</a>
            </div>
            @endif
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        @if (auth()->check() && auth()->user()->status == 1)
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard.index')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>
        @endif
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('Home')" :active="request()->routeIs('Home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('AllProducts')" :active="request()->routeIs('AllProducts')">
                {{ __('Products') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('blogs.index')" :active="request()->routeIs('blogs.index')">
                {{ __('Blogs') }}
            </x-responsive-nav-link>
        </div>

        {{-- <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('about_ra3d')" :active="request()->routeIs('about_ra3d')" wire:navigate>
                {{ __('About Ra3d') }}
            </x-responsive-nav-link>
        </div> --}}
        @if (auth()->check())
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('user.orders')" :active="request()->routeIs('user.orders')">
                    {{ __('Orders ') }}
                </x-responsive-nav-link>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('favorites')" :active="request()->routeIs('favorites')">
                    <img width="35" height="30" src="{{ asset('files/main_images/heart (3).png') }}"
                        alt="">
                </x-responsive-nav-link>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
                    <img width="35" height="30" src="{{ asset('files/main_images/flower-shop.png') }}"
                        alt="">
                </x-responsive-nav-link>
            </div>
        @endif
        @if (auth('web')->check())
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                        x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile')" >
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <button wire:click="logout" class="w-full text-start">
                        <x-responsive-nav-link>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>
        @else
            <div
                style="align-items: center;
            text-align: center;
            display: flex;    margin: 10px;
            font-size: 19px;
            padding-left: 5px;color: #ff0076;">
                <a href="{{ route('auth.google') }}">Login</a>
            </div>
        @endif
    </div>
</nav>
