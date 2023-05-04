<x-layout>
    <x-slot name="title">Task: (id:{{ $task->id }})/edit</x-slot>
    <h2><a href="{{ route('manager.teams.show', $team) }}">{{$team->name}}</a> / {{$task->title}}編集</h2>
    <x-form-error />
    <x-mini-panel>
        <form action="{{ route('manager.teams.tasks.update', [$team, $task]) }}" method="post">
            @csrf
            @method('patch')

            @include('components.manager.task-fields')

            <input type="submit" value="更新" class="btn btn-primary">
        </form>
    </x-mini-panel>
</x-layout>
