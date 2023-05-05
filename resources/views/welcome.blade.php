<x-layout>
    <x-slot name="title">Top</x-slot>

    @if (Auth::check())
        @php
            $user = Auth::user();
        @endphp

        <h2>アサインされているタスク</h2>

        <table class="table table-striped align-middle">
            <thead class="table-light">
                <th>チーム</th>
                <th>タスクID</th>
                <th>タイトル</th>
                <th>担当者</th>
                <th>作成日時</th>
                <th>操作</th>
            </thead>
            <tbody>
                @foreach ($user->assignedTasks as $task)
                    <tr>
                        <td scope="row">{{ $task->team->name }}</td>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>
                            {{ $task->assignee ? $task->assignee->name : 'なし' }}
                        </td>
                        <td>
                            {{ $task->created_at }}
                        </td>
                        <td>
                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-primary btn-sm">詳細</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>所属しているチーム</h2>

        <div class="text-end mb-2">
            <a href="{{ route('teams.create') }}" class="btn btn-primary">チーム作成</a>
        </div>

        <table class="table table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col">チームID</th>
                    <th scope="col">チーム名</th>
                    <th scope="col">役割</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->teams as $team)
                    @php
                        $member = $team->memberOf($user);
                    @endphp
                    <tr>
                        <th scope="row">{{ $team->id }}</th>
                        <td>{{ $team->name }}</td>
                        <td>
                            @if ($member->role === 0)
                                通常
                            @else
                                マネージャー
                            @endif
                        </td>
                        <td>
                          @if($member->role === 1)
                            <a href="{{ route('manager.teams.show', $team) }}" class="btn btn-primary btn-sm">管理</a>
                          @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        ログインして操作してください
    @endif
</x-layout>
