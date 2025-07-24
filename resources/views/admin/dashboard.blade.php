@extends('layouts.admin')

@section('header')
Dashboard
@endsection

@section('content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- Active Vouchers -->
    <div class="bg-white shadow-md rounded-2xl p-6 border-l-4 border-blue-500">
        <h3 class="text-sm uppercase text-gray-500 font-semibold">Active Vouchers</h3>
        <p class="text-3xl font-bold text-blue-700 mt-2">{{ $voucherAktif }}</p>
        <p class="text-sm text-gray-400 mt-1">Currently available for redemption</p>
    </div>

    <!-- Active Events -->
    <div class="bg-white shadow-md rounded-2xl p-6 border-l-4 border-green-500">
        <h3 class="text-sm uppercase text-gray-500 font-semibold">Active Events</h3>
        <p class="text-3xl font-bold text-green-700 mt-2">{{ $eventAktif }}</p>
        <p class="text-sm text-gray-400 mt-1">Ongoing or upcoming events</p>
    </div>

    <!-- Orders This Year -->
    <div class="bg-white shadow-md rounded-2xl p-6 border-l-4 border-yellow-500">
        <h3 class="text-sm uppercase text-gray-500 font-semibold">Orders</h3>
        <p class="text-3xl font-bold text-yellow-700 mt-2">{{ $orderTahunIni }}</p>
        <p class="text-sm text-gray-400 mt-1">Total tickets sold</p>
    </div>

    <!-- Registered Users -->
    <div class="bg-white shadow-md rounded-2xl p-6 border-l-4 border-indigo-500">
        <h3 class="text-sm uppercase text-gray-500 font-semibold">Registered Users</h3>
        <p class="text-3xl font-bold text-indigo-700 mt-2">{{ $jumlahUser }}</p>
        <p class="text-sm text-gray-400 mt-1">Total platform users</p>
    </div>

    <!-- Total Revenue -->
    <div class="bg-white shadow-md rounded-2xl p-6 border-l-4 border-pink-500">
        <h3 class="text-sm uppercase text-gray-500 font-semibold">Total Revenue (IDR)</h3>
        <p class="text-3xl font-bold text-pink-700 mt-2">Rp {{ number_format($totalPendapatan, 2, ',', '.') }}</p>
        <p class="text-sm text-gray-400 mt-1">Across all orders</p>
    </div>

</div>

@endsection