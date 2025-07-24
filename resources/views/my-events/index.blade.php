@extends('layouts.app')

@section('header')
<h2 class="text-xl font-semibold">My Event</h2>
@endsection

@section('content')
<div class="p-4 space-y-4">
    @forelse ($orders as $order)
    <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center">
        <div>
            <h3 class="font-semibold text-lg">{{ $order->event->title }}</h3>
            <p class="text-sm text-gray-600">
                Date: {{ $order->event->event_date->translatedFormat('d M Y H:i') }}
                | Buyer: {{ $order->orderDetail->first()->buyer_name }}
            </p>
        </div>

        <div>
            <a href="{{ route('ticket.show', $order->id) }}">
                <x-primary-button>View Ticket</x-primary-button>
            </a>
        </div>
    </div>
    @empty
    <p class="text-gray-500">No tickets purchased yet.</p>
    @endforelse
</div>
@endsection