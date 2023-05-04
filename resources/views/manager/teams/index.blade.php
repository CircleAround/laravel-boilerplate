<x-layout>
    <x-slot name="title">Teams</x-slot>
    <h2><a href="{{ route('manager.teams.index') }}">チーム管理</a></h2>

    <div class="text-end mb-2">
        <a href="{{ route('manager.teams.create') }}" class="btn btn-primary">新規作成</a>
    </div>

    <table class="table table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teams as $team)
                <tr>
                    <th scope="row">{{ $team->id }}</th>
                    <td><a href="{{ route('manager.teams.show', $team) }}">{{ $team->name }}</a></td>
                    <td>
                        <a href="{{ route('manager.teams.edit', $team) }}" class="btn btn-primary btn-sm">edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
