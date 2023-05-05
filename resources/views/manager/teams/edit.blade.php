<x-layout>
    <x-slot name="title">Team: (id:{{ $team->id }})/edit</x-slot>
    <h2>{{$team->name}}編集</h2>
    <x-form-error />
    <x-mini-panel>
        <form action="{{ route('manager.teams.update', $team) }}" method="post">
            @csrf
            @method('patch')

            @include('components.manager.team-fields')

            <input type="submit" value="更新" class="btn btn-primary">
        </form>
    </x-mini-panel>
</x-layout>
