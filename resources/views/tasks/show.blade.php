<x-layout>
    <x-slot name="title">担当タスク</x-slot>
    <h2>{{ $task->team->name }} / {{ $task->title }}</h2>
    <x-form-error />
    <x-mini-panel>
        <h3>内容</h3>
        {{ $task->body }}
    </x-mini-panel>
</x-layout>
