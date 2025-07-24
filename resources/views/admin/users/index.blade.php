@extends('layouts.admin')

@section('header')
Users
@endsection

@section('content')
<table class="w-full border-collapse border text-sm bg-white rounded shadow">
    <thead class="bg-gray-100 text-gray-700">
        <tr>
            <th class="border px-4 py-2 text-left">Name</th>
            <th class="border px-4 py-2 text-left">Email</th>
            <th class="border px-4 py-2 text-left">Role</th>
            <th class="border px-4 py-2 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
        <tr class="hover:bg-gray-50">
            <td class="border px-4 py-2">{{ $user->name }}</td>
            <td class="border px-4 py-2">{{ $user->email }}</td>
            <td class="border px-4 py-2 capitalize">{{ $user->role }}</td>
            <td class="border px-4 py-2">
                <span class="text-blue-600 hover:underline cursor-pointer text-sm" x-data x-on:click="$dispatch('open-modal', 'edit-user-{{ $user->id }}')">
                    Edit
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center text-gray-500 py-4">No users found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $users->links() }}
</div>

@foreach ($users as $user)
<x-modal name="edit-user-{{ $user->id }}" focusable>
    <div class="p-6">
        <h2 class="text-lg font-semibold mb-4">Edit User</h2>
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="name-{{ $user->id }}" value="Name" />
                <x-text-input id="name-{{ $user->id }}" name="name" type="text" class="w-full" value="{{ $user->name }}" required readonly />
            </div>

            <div>
                <x-input-label for="email-{{ $user->id }}" value="Email" />
                <x-text-input id="email-{{ $user->id }}" name="email" type="email" class="w-full" value="{{ $user->email }}" required readonly />
            </div>

            <div>
                <x-input-label for="role-{{ $user->id }}" value="Role" />
                <select name="role" id="role-{{ $user->id }}" class="w-full border-gray-300 rounded-md">
                    <option value="user" @selected($user->role === 'user')>User</option>
                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <x-secondary-button type="button" @click="$dispatch('close-modal', 'edit-user-{{ $user->id }}')">
                    Cancel
                </x-secondary-button>

                <x-primary-button type="submit">
                    Save
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
@endforeach

@endsection
