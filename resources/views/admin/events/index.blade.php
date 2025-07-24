@extends('layouts.admin')

@section('header')
Event Management
@endsection

@section('content')

<div class="mb-4">
    <span class="inline-block text-sm text-blue-600 hover:underline cursor-pointer" x-data @click="$dispatch('open-modal', 'create')">
        + Add New Event
    </span>
</div>

<table class="w-full border-collapse border text-sm bg-white rounded shadow">
    <thead class="bg-gray-100 text-gray-700">
        <tr>
            <th class="border px-4 py-2 text-left">Title</th>
            <th class="border px-4 py-2 text-left">Date</th>
            <th class="border px-4 py-2 text-left">Category</th>
            <th class="border px-4 py-2 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($events as $event)
        <tr class="hover:bg-gray-50">
            <td class="border px-4 py-2 text-left">{{ $event->title }}</td>
            <td class="border px-4 py-2 text-left">{{ $event->event_date }}</td>
            <td class="border px-4 py-2 text-left capitalize">{{ $event->category }}</td>
            <td class="border px-4 py-2 text-left text-sm space-x-4">
                <span class="text-blue-600 hover:underline cursor-pointer" x-data @click="$dispatch('open-modal', 'edit-{{ $event->id }}')">Edit</span>
                <span class="text-red-600 hover:underline cursor-pointer" x-data @click="$dispatch('open-modal', 'delete-{{ $event->id }}')">Delete</span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center py-4 text-gray-500">No events available.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">{{ $events->links() }}</div>

<!-- Create Modal -->
<x-modal name="create">
    <div class="p-6">
        <h2 class="text-lg font-bold mb-4">Create New Event</h2>

        <form method="POST" action="{{ route('admin.events.store') }}" class="space-y-4">
            @csrf
            <div>
                <x-input-label for="title" value="Event Title" />
                <x-text-input name="title" id="title" required class="w-full" />
            </div>

            <div>
                <x-input-label for="event_date" value="Event Date" />
                <x-text-input name="event_date" id="event_date" type="datetime-local" required class="w-full" />
            </div>

            <div>
                <select name="category" id="category" required class="w-full border-gray-300 rounded-md">
                    <option value="music">Music</option>
                    <option value="theater">Theater</option>
                    <option value="seminar">Seminar</option>
                    <option value="exhibition">Exhibition</option>
                </select>
            </div>

            <div>
                <x-input-label for="description" value="Event Description" />
                <textarea name="description" id="description" rows="4" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">{{ old('description') }}</textarea>
            </div>

            <div>
                <x-input-label for="ticket_price" value="Ticket Price" />
                <x-text-input name="ticket_price" id="ticket_price" type="number" step="0.01" required class="w-full" />
            </div>

            <div>
                <x-input-label for="quota" value="Quota" />
                <x-text-input name="quota" id="quota" type="number" required class="w-full" />
            </div>

            <div>
                <x-input-label for="banner_url" value="Banner URL" />
                <x-text-input name="banner_url" id="banner_url" type="url" required class="w-full" />
            </div>

            <div class="flex justify-end gap-3">
                <x-secondary-button type="button" @click="$dispatch('close-modal', 'create')">Cancel</x-secondary-button>
                <x-primary-button type="submit">Save</x-primary-button>
            </div>
        </form>
    </div>
</x-modal>

@foreach ($events as $event)
<!-- Edit Modal -->
<x-modal name="edit-{{ $event->id }}">
    <div class="p-6">
        <h2 class="text-lg font-bold mb-4">Edit Event</h2>
        <form method="POST" action="{{ route('admin.events.update', $event->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="title-{{ $event->id }}" value="Event Title" />
                <x-text-input name="title" id="title-{{ $event->id }}" value="{{ $event->title }}" required class="w-full" />
            </div>

            <div>
                <x-input-label for="event_date-{{ $event->id }}" value="Event Date" />
                <x-text-input name="event_date" id="event_date-{{ $event->id }}" type="datetime-local" value="{{ $event->event_date->format('Y-m-d\TH:i') }}" required class="w-full" />
            </div>

            <div>
                <x-input-label for="category-{{ $event->id }}" value="Category" />
                <select name="category" id="category-{{ $event->id }}" required class="w-full border-gray-300 rounded-md">
                    <option value="music" {{ $event->category == 'music' ? 'selected' : '' }}>Music</option>
                    <option value="theater" {{ $event->category == 'theater' ? 'selected' : '' }}>Theater</option>
                    <option value="seminar" {{ $event->category == 'seminar' ? 'selected' : '' }}>Seminar</option>
                    <option value="exhibition" {{ $event->category == 'exhibition' ? 'selected' : '' }}>Exhibition</option>
                </select>
            </div>

            <div>
                <x-input-label for="description-{{ $event->id }}" value="Event Description" />
                <textarea name="description" id="description-{{ $event->id }}" rows="4" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">{{ old('description', $event->description) }}</textarea>
            </div>

            <div>
                <x-input-label for="ticket_price-{{ $event->id }}" value="Ticket Price" />
                <x-text-input name="ticket_price" id="ticket_price-{{ $event->id }}" type="number" step="0.01" value="{{ old('ticket_price', $event->ticket_price) }}" required class="w-full" />
            </div>

            <div>
                <x-input-label for="quota-{{ $event->id }}" value="Quota" />
                <x-text-input name="quota" id="quota-{{ $event->id }}" type="number" value="{{ old('quota', $event->quota) }}" required class="w-full" />
            </div>

            <div>
                <x-input-label for="banner_url-{{ $event->id }}" value="Banner URL" />
                <x-text-input name="banner_url" id="banner_url-{{ $event->id }}" type="url" value="{{ old('banner_url', $event->banner_url) }}" required class="w-full" />
            </div>

            <div class="flex justify-end gap-3">
                <x-secondary-button type="button" @click="$dispatch('close-modal', 'edit-{{ $event->id }}')">Cancel</x-secondary-button>
                <x-primary-button type="submit">Update</x-primary-button>
            </div>
        </form>
    </div>
</x-modal>

<!-- Delete Modal -->
<x-modal name="delete-{{ $event->id }}">
    <div class="p-6">
        <h2 class="text-lg font-bold mb-4 text-red-600">Delete Confirmation</h2>
        <p>Are you sure you want to delete <strong>{{ $event->title }}</strong>?</p>

        <form method="POST" action="{{ route('admin.events.destroy', $event) }}" class="mt-6 flex justify-end gap-3">
            @csrf
            @method('DELETE')

            <x-secondary-button type="button" @click="$dispatch('close-modal', 'delete-{{ $event->id }}')">
                Cancel
            </x-secondary-button>

            <x-danger-button type="submit">
                Delete
            </x-danger-button>
        </form>
    </div>
</x-modal>
@endforeach

@endsection