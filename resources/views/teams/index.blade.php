<x-layout>
    <x-slot name="title">Teams</x-slot>
    <h2>チーム管理</h2>

    <table class="table table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teams as $team)
                <tr>
                    <th scope="row">{{ $team->id }}</th>
                    <td><a href="{{ route('manager.teams.show', $team) }}">{{ $team->name }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
