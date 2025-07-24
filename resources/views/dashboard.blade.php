@extends('layouts.app')

@section('header')
<h2 class="text-xl font-semibold"> Hi, {{ Auth::user()->name }} &#128075;</h2>
@endsection

@section('content')
<div class="px-4 space-y-4">
    <x-content-card>
        <div class="flex items-center justify-center">
            <form method="GET" class="flex flex-wrap gap-2 w-full">
                <x-text-input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search title or description..."
                    class="w-full sm:w-[calc(50%-8px)]" />

                <div class="w-full sm:w-[calc(50%-8px)] flex gap-2">
                    <select
                        name="category"
                        class="w-full sm:w-[calc(35%-8px)] rounded border-gray-300">
                        <option value="">Category</option>
                        @foreach(['music', 'theater', 'seminar', 'exhibition'] as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                            {{ ucfirst($cat) }}
                        </option>
                        @endforeach
                    </select>
                    <x-text-input
                        type="date"
                        name="date"
                        value="{{ request('date') }}"
                        class="w-full sm:w-[calc(35%-8px)]" />
                    <x-primary-button class="w-full sm:w-[calc(30%-8px)]">Search</x-primary-button>
                </div>
            </form>
        </div>
    </x-content-card>

    @if ($events->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($events as $event)
        <div class="{{ $event->is_registered ? 'bg-gray-100' : 'bg-white' }} shadow-lg rounded-xl overflow-hidden border border-gray-300 flex flex-col">
            <img src="{{ $event->banner_url }}" class="w-full h-40 object-cover {{ $event->is_registered ? 'opacity-50 grayscale' : '' }}">
            <div class="px-4 pt-4 flex-1">
                <h3 class="font-semibold text-lg {{ $event->is_registered ? 'text-gray-500' : '' }}">{{ $event->title }}</h3>
                <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}</p>
                <p class="text-xs mt-1 text-gray-500">{{ ucfirst($event->category) }}</p>
                <div class="text-sm mt-1 text-gray-700">{{ Str::limit($event->description, 20) }}</div>
            </div>
            <!-- Flex container for Like and More buttons -->
            <div class="flex justify-between px-4 pb-4 pt-1">
                <!-- Like Button -->
                <div class="flex items-center space-x-2">
                    <form action="{{ route('event.like', $event->id) }}" method="POST" class="flex items-center">
                        @csrf
                        <button type="submit" class="flex items-center space-x-1">
                            @if ($event->is_liked)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="red" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733C11.285 4.876 9.623 3.75 7.688 3.75
                             5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="gray" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733C11.285 4.876 9.623 3.75 7.688 3.75
                             5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                            @endif
                            <span class="text-xs text-gray-500">{{ $event->total_likes }}</span>
                        </button>
                    </form>
                </div>

                <!-- More Button -->
                <a href="{{ route('event.show', $event->id) }}">
                    <x-secondary-button class="w-auto py-2 px-4 text-sm {{ $event->is_registered ? 'opacity-50 pointer-events-none' : '' }}">
                        More
                    </x-secondary-button>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $events->withQueryString()->links() }}
    </div>
    @else
    <p class="text-gray-600">No event found.</p>
    @endif
</div>
@endsection

@section('footer')
@include('layouts.footer')
@endsection