@extends('layouts.app')

@section('header')
<h2 class="text-xl font-semibold">Ticket Details</h2>
@endsection

@section('content')

<div class="p-4 max-w-3xl mx-auto space-y-6">
    <div class="relative overflow-hidden border border-dashed rounded-xl shadow-lg {{ $isExpired ? 'bg-gray-200 grayscale text-gray-500' : 'bg-white' }}">
        @if ($isExpired)
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center z-10 pointer-events-none">
            <span class="text-3xl font-bold text-white bg-red-600 px-6 py-2 rounded shadow">Event Expired</span>
        </div>
        @endif

        <div class="bg-red-500 text-white px-4 py-1 text-sm font-bold absolute top-0 right-0 rounded-bl-lg z-20">
            Admit One
        </div>

        <div class="border-b border-dashed border-gray-300 px-6 py-4">
            <h3 class="text-2xl font-extrabold text-gray-800">{{ $order->event->title }}</h3>
            <p class="text-sm text-gray-500">Valid for Entry - {{ $order->event->event_date->translatedFormat('d M Y H:i') }}</p>
            <p class="text-sm text-gray-500">Total Price: Rp. {{ number_format($order->total_price, 0, ',', '.') }}</p>
        </div>

        <div class="px-6 py-4 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm relative z-20" x-data="{ showNik: false }">
            <div>
                <p class="text-gray-500">Name</p>
                <p class="font-semibold">{{ $order->orderDetail->first()->buyer_name }}</p>
            </div>
            <div>
                <p class="text-gray-500">National ID (NIK)</p>
                <p class="font-semibold">
                    <span x-show="!showNik">{{ substr($order->orderDetail->first()->buyer_nik, 0, 4) . str_repeat('*', 8) . substr($order->orderDetail->first()->buyer_nik, -4) }}</span>
                    <span x-show="showNik" x-cloak>{{ $order->orderDetail->first()->buyer_nik }}</span>
                    <button type="button" class="text-blue-500 text-xs ml-2" @click="showNik = !showNik" x-text="showNik ? 'Hide' : 'Show'"></button>
                </p>
            </div>
            <div>
                <p class="text-gray-500">Ticket Code</p>
                <p class="font-mono text-lg tracking-widest">{{ $order->orderDetail->first()->ticket_code }}</p>
            </div>
            <div>
                <p class="text-gray-500">Event Date</p>
                <p>{{ $order->event->event_date->translatedFormat('d M Y H:i') }}</p>
            </div>
        </div>

        <div class="border-t border-dashed border-gray-300 px-6 py-6 flex items-center justify-center z-1 relative">
            <div class="text-center">
                <p class="text-sm text-gray-500 mb-2">Scan at the entrance</p>
                <div class="mx-auto">{!! $qrCode !!}</div>
            </div>
        </div>

        <div class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-white w-4 h-8 rounded-r-full border border-gray-300 z-20"></div>
        <div class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-white w-4 h-8 rounded-l-full border border-gray-300 z-20"></div>
    </div>
</div>
@endsection