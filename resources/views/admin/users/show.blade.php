<x-layout>
    <x-slot name="title">User: (id:{{ $user->id }})</x-slot>
    <h2><a href="{{ route('admin.users.index') }}">Admin/Users</a> / {{ $user->name }}(id:{{ $user->id }})</h2>
</x-layout>
