<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Safe Code Game
        </h2>
    </x-slot>

    @php
        $totalTries = 5;
        $usedTries = count($history ?? []);
        $triesLeft = max($totalTries - $usedTries, 0);
        $hasReachedLimit = $usedTries >= $totalTries;
    @endphp

@if (session('message'))
<div class="max-w-xl mx-auto mt-4 px-4">
    <div class="alert {{ session('success') ? 'bg-green-100 border-green-400' : 'bg-red-100 border-red-400' }} text-center mb-4 border-l-4 p-4"
        role="alert">
        <div class="flex justify-center items-center gap-2">
            <i class="{{ session('success') ? 'bi bi-check-circle' : 'bi bi-x-circle' }}"></i>
            <p class="text-lg font-semibold mb-0">
                {{ session('message') }}
            </p>
        </div>
    </div>
</div>
@endif

   
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md sm:max-w-xl bg-white shadow-xl rounded-2xl p-6 sm:p-8 space-y-6">
            <div class="text-center">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">🔐 خمن الرقم واكسب</h1>
            </div>

            <!-- 🎁 Selected Products -->
            <div class="flex justify-center">
                <div class="w-full max-w-5xl px-4">
                    <h2 class="text-center text-base font-semibold text-gray-700 mb-4">🎁 الهدايا الي هتكسبها</h2>

                    <div class="grid justify-items-center grid-cols-2 sm:grid-cols-3 md:grid-cols-2 gap-6">
                        @foreach ($products as $product)
                            <a href="{{ route('product.details', ['id' =>$product->id]) }}"
                                class="w-full max-w-[140px] bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition overflow-hidden text-center p-2.5">
                                <img src="{{ asset('storage/' . $product->path) }}" alt="{{ $product->name }}"
                                    class="w-full h-20 object-cover rounded-md mb-2">
                                <h3 class="text-xs font-medium text-gray-800 truncate">
                                    {{ $product->name }}
                                </h3>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>


            <!-- Tries Count -->
            <div class="text-center text-sm text-gray-700 font-medium">
                Tries Used: <span class="font-bold">{{ $usedTries }} / {{ $totalTries }}</span>
            </div>

            <!-- Code Form -->
            <form method="POST" action="{{ route('events.try') }}"
                class="flex flex-wrap justify-center items-center gap-3 mt-4">
                @csrf
                @for ($i = 0; $i < 4; $i++)
                    <input type="text" name="code[]" maxlength="1" required
                        {{ $hasReachedLimit ? 'disabled' : '' }}
                        class="w-12 sm:w-14 h-12 sm:h-14 text-center text-xl font-bold text-gray-800 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white disabled:opacity-50">
                @endfor

                <button type="submit" {{ $hasReachedLimit ? 'disabled' : '' }}
                    class="w-full sm:w-auto mt-3 sm:mt-0 bg-pink-600 hover:bg-pink-700 transition text-white font-bold px-5 py-2 rounded-lg disabled:opacity-50">
                    Try
                </button>
            </form>

            <!-- Try History -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-2">📝 Try History</h2>

                @if ($history && count($history) > 0)
                    <ul
                        class="space-y-1 max-h-40 overflow-y-auto text-sm border border-gray-200 p-3 rounded-lg bg-gray-50">
                        @foreach (array_reverse($history) as $attempt)
                            <li class="flex justify-between bg-white px-3 py-1 rounded-md shadow-sm">
                                <span class="font-mono tracking-wider">{{ implode('', $attempt['code']) }}</span>
                                <span class="{{ $attempt['success'] ? 'text-green-600' : 'text-red-500' }}">
                                    {{ $attempt['success'] ? 'Correct' : 'Wrong' }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">No attempts yet.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
