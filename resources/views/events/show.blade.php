@extends('layouts.app')

@section('header')
<h2 class="text-xl font-semibold">Detail - {{ $event->title }}</h2>
@endsection

@section('content')
<div class="p-4 max-w-5xl mx-auto space-y-4">

    <x-content-card>
        <h3 class="text-2xl font-bold">{{ $event->title }}</h3>
    </x-content-card>

    <div class="md:grid md:grid-cols-10 md:gap-6 space-y-4 md:space-y-0">

        <div class="md:col-span-7 space-y-4">
            <x-content-card>
                <img src="{{ $event->banner_url }}" class="w-full h-full object-cover rounded-xl shadow" alt="{{ $event->title }}">
            </x-content-card>

            <x-content-card>
                <h4 class="text-lg font-semibold">Description</h4>
                <p class="text-gray-700">{{ $event->description }}</p>
            </x-content-card>
        </div>

        <div class="md:col-span-3 space-y-4 flex flex-col">
            <x-content-card>
                <p class="text-gray-600">Date: {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y H:i') }}</p>
                <p class="text-gray-600">Category: {{ ucfirst($event->category) }}</p>
                <p class="text-gray-600">Ticket left: {{ $event->quota }}</p>
            </x-content-card>

            <x-content-card>
                <h4 class="text-lg font-semibold">Voucher Code</h4>
                <form action="{{ route('event.show', $event->id) }}" method="GET">
                    @csrf
                    <div class="flex space-x-2">
                        <x-text-input id="voucher_code" name="voucher_code" class="w-full mt-1" placeholder="Enter voucher code"
                            value="{{ old('voucher_code', session('voucher_code')) }}" />
                        <x-primary-button type="submit" class="self-center">Apply</x-primary-button>
                    </div>
                </form>

                @if(session('voucher_error'))
                <p class="text-red-500">{{ session('voucher_error') }}</p>
                @endif
            </x-content-card>

            @if(session('total_price'))
            <x-content-card>
                <h4 class="text-lg font-semibold">Total Price</h4>
                <p class="text-xl font-bold">Rp. {{ number_format(session('total_price'), 0, ',', '.') }}</p>
            </x-content-card>
            @endif

            <form action="{{ route('checkout.show', $event->id) }}" method="GET">
                @csrf
                <input type="hidden" name="voucher_code" value="{{ session('voucher_code') }}" />
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-md">Checkout</button>
            </form>
        </div>
    </div>
</div>

@endsection