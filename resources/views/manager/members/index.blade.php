<x-layout>
    <x-slot name="title">Teams</x-slot>
    <h2><a href="{{ route('manager.teams.show', $team) }}">{{ $team->name }}(id:{{ $team->id }})</a> / メンバー管理</h2>

    <div class="text-end mb-2">
        <form action="{{ route('manager.teams.members.store', $team) }}" method="POST">
            @csrf

            <span>新規メンバー追加: </span>
            <select name="user_id">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <input type="submit" class="btn btn-primary btn-sm" value="追加">
    </div>

    <table class="table table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">役割</th>
                <th scope="col">名前</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <th scope="row">
                        <!-- 後で適切に実装しましょう -->
                        @if ($member->role === 0)
                            通常
                        @else
                            マネージャー
                        @endif
                    </th>
                    <th scope="row">{{ $member->user->name }}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
