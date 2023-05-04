<x-layout>
    <x-slot name="title">Task作成</x-slot>
    <h2><a href="{{ route('manager.teams.show', $team) }}">{{$team->name}}</a> / タスク作成</h2>
    <x-form-error />
    <x-mini-panel>
        <form action="{{ route('manager.teams.tasks.store', $team) }}" method="post">
            @csrf

            @include('components.manager.task-fields')

            <input type="submit" value="作成" class="btn btn-primary">
        </form>
    </x-mini-panel>
</x-layout>
