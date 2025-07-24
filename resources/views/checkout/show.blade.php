@extends('layouts.app')

@section('header')
<h2 class="text-xl font-semibold">Checkout - {{ $event->title }}</h2>
@endsection

@section('content')
<div class="p-4 max-w-xl mx-auto space-y-6">

    {{-- Event Information --}}
    <x-content-card>
        <h3 class="text-lg font-semibold text-gray-800">Event Information</h3>
        <p class="text-gray-700">{{ $event->title }}</p>
        <p class="text-gray-600">Date: {{ $event->event_date->translatedFormat('d M Y H:i') }}</p>
        <p class="text-gray-600">Remaining Quota: {{ $event->quota }}</p>
    </x-content-card>

    {{-- Checkout Form --}}
    <x-content-card>
        <form method="POST" action="{{ route('checkout.store', $event->id) }}" class="space-y-3">
            @csrf
            <h3 class="text-lg font-semibold text-gray-700">Buyer Details</h3>
            <div>
                <x-input-label for="buyer_name" value="Full Name" />
                <x-text-input id="buyer_name" name="buyer_name" required class="w-full mt-1" placeholder="Enter your name" />
                <x-input-error :messages="$errors->get('buyer_name')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="buyer_nik" value="National ID Number (NIK)" />
                <x-text-input id="buyer_nik" name="buyer_nik" required maxlength="16" class="w-full mt-1" placeholder="e.g. 3201XXXXXXXXXXXX" />
                <x-input-error :messages="$errors->get('buyer_nik')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="payment_method" value="Payment Method" />
                <select id="payment_method" name="payment_method" class="w-full mt-1 border-gray-300 rounded">
                    <option value="transfer">Bank Transfer</option>
                    <option value="ewallet">E-Wallet</option>
                </select>
                <x-input-error :messages="$errors->get('payment_method')" class="mt-1" />
            </div>

            <div class="mt-4">
                <h4 class="text-lg font-semibold">Final Price</h4>
                <p class="text-xl font-bold">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</p>
            </div>

            <div class="pt-2">
                <form action="{{ route('checkout.store', $event->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="voucher_code" value="{{ session('voucher_code') }}" />
                    <input type="hidden" name="total_price" value="{{ $totalPrice }}" />
                    <x-primary-button class="w-full">Proceed to Payment</x-primary-button>
                </form>
            </div>
        </form>
    </x-content-card>
</div>

@endsection