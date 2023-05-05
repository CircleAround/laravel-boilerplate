<x-layout>
    <x-slot name="title">Team: (id:{{ $team->id }})</x-slot>
    <h2>{{ $team->name }}(id:{{ $team->id }})</h2>
    <a href="{{ route('manager.teams.edit', $team) }}" class="btn btn-primary">編集</a>
</x-layout>
