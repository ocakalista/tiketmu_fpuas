@extends('layouts.admin')

@section('header')
Voucher Management
@endsection

@section('content')
<div class="mb-4">
    <span class="inline-block text-sm text-blue-600 cursor-pointer" x-data @click="$dispatch('open-modal', 'create-voucher')">
        + Add New Voucher
    </span>
</div>

<table class="w-full border-collapse border text-sm bg-white rounded shadow">
    <thead class="bg-gray-100 text-gray-700">
        <tr>
            <th class="border px-4 py-2 text-left">Code</th>
            <th class="border px-4 py-2 text-left">Quota</th>
            <th class="border px-4 py-2 text-left">Discount (%)</th>
            <th class="border px-4 py-2 text-left">Valid Until</th>
            <th class="border px-4 py-2 text-left">Status</th>
            <th class="border px-4 py-2 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($vouchers as $voucher)
        <tr class="hover:bg-gray-50">
            <td class="border px-4 py-2">{{ $voucher->code }}</td>
            <td class="border px-4 py-2">{{ $voucher->quota }}</td>
            <td class="border px-4 py-2">{{ $voucher->discount_percentage }}</td>
            <td class="border px-4 py-2">{{ $voucher->valid_until->format('Y-m-d') }}</td>
            <td class="border px-4 py-2">{{ ucfirst($voucher->status) }}</td>
            <td class="border px-4 py-2 space-x-3">
                <span class="text-blue-600 hover:underline cursor-pointer" x-data @click="$dispatch('open-modal', 'edit-{{ $voucher->id }}')">Edit</span>
                <span class="text-red-600 hover:underline cursor-pointer" x-data @click="$dispatch('open-modal', 'delete-voucher-{{ $voucher->id }}')">Delete</span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-gray-500 py-4">No vouchers available.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $vouchers->links() }}
</div>

<x-modal name="create-voucher" focusable>
    <div class="p-6">
        <h2 class="text-lg font-semibold mb-4">Create Voucher</h2>
        <form method="POST" action="{{ route('admin.vouchers.store') }}" class="space-y-4">
            @csrf

            <p class="text-sm text-gray-500">*Voucher code will be generated automatically.</p>

            <div>
                <x-input-label for="quota" value="Quota" />
                <x-text-input name="quota" type="number" class="w-full" required />
            </div>

            <div>
                <x-input-label for="discount_percentage" value="Discount (%)" />
                <x-text-input name="discount_percentage" type="number" class="w-full" required />
            </div>

            <div>
                <x-input-label for="valid_until" value="Valid Until" />
                <x-text-input name="valid_until" type="date" class="w-full" required />
            </div>

            <div>
                <x-input-label for="status" value="Status" />
                <select name="status" class="w-full border-gray-300 rounded-md">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <x-secondary-button type="button" @click="$dispatch('close-modal', 'create-voucher')">Cancel</x-secondary-button>
                <x-primary-button type="submit">Create</x-primary-button>
            </div>
        </form>
    </div>
</x-modal>

@foreach ($vouchers as $voucher)
<x-modal name="edit-{{ $voucher->id }}" focusable>
    <div class="p-6">
        <h2 class="text-lg font-semibold mb-4">Edit Voucher</h2>
        <form method="POST" action="{{ route('admin.vouchers.update', $voucher) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="code-{{ $voucher->id }}" value="Code" />
                <x-text-input id="code-{{ $voucher->id }}" name="code" value="{{ $voucher->code }}" class="w-full" required readonly />
            </div>

            <div>
                <x-input-label for="quota-{{ $voucher->id }}" value="Quota" />
                <x-text-input id="quota-{{ $voucher->id }}" name="quota" type="number" class="w-full" value="{{ $voucher->quota }}" required />
            </div>

            <div>
                <x-input-label for="discount-{{ $voucher->id }}" value="Discount (%)" />
                <x-text-input id="discount-{{ $voucher->id }}" name="discount_percentage" type="number" class="w-full" value="{{ $voucher->discount_percentage }}" required />
            </div>

            <div>
                <x-input-label for="valid_until-{{ $voucher->id }}" value="Valid Until" />
                <x-text-input id="valid_until-{{ $voucher->id }}" name="valid_until" type="date" class="w-full" value="{{ $voucher->valid_until->format('Y-m-d') }}" required />
            </div>

            <div>
                <x-input-label for="status-{{ $voucher->id }}" value="Status" />
                <select name="status" id="status-{{ $voucher->id }}" class="w-full border-gray-300 rounded-md">
                    <option value="active" @selected($voucher->status == 'active')>Active</option>
                    <option value="inactive" @selected($voucher->status == 'inactive')>Inactive</option>
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <x-secondary-button type="button" @click="$dispatch('close-modal', 'edit-{{ $voucher->id }}')">Cancel</x-secondary-button>
                <x-primary-button type="submit">Save</x-primary-button>
            </div>
        </form>
    </div>
</x-modal>

<x-modal name="delete-voucher-{{ $voucher->id }}" focusable>
    <div class="p-6">
        <h2 class="text-lg font-bold text-red-600 mb-4">Delete Confirmation</h2>
        <p>Are you sure you want to delete voucher <strong>{{ $voucher->code }}</strong>?</p>

        <form method="POST" action="{{ route('admin.vouchers.destroy', $voucher) }}" class="mt-6 flex justify-end gap-3">
            @csrf
            @method('DELETE')
            <x-secondary-button type="button" @click="$dispatch('close-modal', 'delete-voucher-{{ $voucher->id }}')">
                Cancel
            </x-secondary-button>
            <x-danger-button type="submit">Delete</x-danger-button>
        </form>
    </div>
</x-modal>
@endforeach

@endsection