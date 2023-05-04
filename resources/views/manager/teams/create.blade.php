<x-layout>
    <x-slot name="title">Team作成</x-slot>
    <h2><a href="{{ route('manager.teams.index') }}">チーム管理</a> / 新規作成</h2>
    <x-form-error />
    <x-mini-panel>
        <form action="{{ route('manager.teams.store') }}" method="post">
            @csrf

            @include('components.manager.team-fields')

            <input type="submit" value="作成" class="btn btn-primary">
        </form>
    </x-mini-panel>
</x-layout>
