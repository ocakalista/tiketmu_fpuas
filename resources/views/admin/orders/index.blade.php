@extends('layouts.admin')

@section('header')
Orders
@endsection

@section('content')

<table class="w-full border-collapse text-sm bg-white rounded shadow">
    <thead class="bg-gray-100 text-gray-700">
        <tr>
            <th class="border px-4 py-2">Order ID</th>
            <th class="border px-4 py-2">User</th>
            <th class="border px-4 py-2 ">Total Price</th>
            <th class="border px-4 py-2 ">Payment Method</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($orders as $order)
        <tr class="hover:bg-gray-50">
            <td class="border px-4 py-2">{{ $order->id }}</td>
            <td class="border px-4 py-2">{{ $order->user->name }}</td>
            <td class="border px-4 py-2 ">{{ number_format($order->total_price, 2) }}</td>
            <td class="border px-4 py-2 ">{{ $order->payment_method }}</td>
            <td class="border px-4 py-2">
                <span class="text-blue-600 cursor-pointer" x-data @click="$dispatch('open-modal', 'order-detail-{{ $order->id }}')">
                    View Details
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-gray-500 py-4">No orders available.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@foreach ($orders as $order)
<x-modal name="order-detail-{{ $order->id }}" focusable>
    <div class="p-6">
        <h2 class="text-lg font-semibold mb-4">Order Details for Order #{{ $order->id }}</h2>
        <p><strong>Buyer Name:</strong> {{ $order->orderDetail->buyer_name }}</p>
        <p><strong>Buyer NIK:</strong> {{ $order->orderDetail->buyer_nik }}</p>
        <p><strong>Ticket Code:</strong> {{ $order->orderDetail->ticket_code }}</p>

        <div class="flex justify-end gap-3">
            <x-secondary-button type="button" @click="$dispatch('close-modal', 'order-detail-{{ $order->id }}')">Close</x-secondary-button>
        </div>
    </div>
</x-modal>
@endforeach

<div class="mt-4">
    {{ $orders->links() }}
</div>

@endsection