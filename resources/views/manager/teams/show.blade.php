<x-layout>
    <x-slot name="title">Team: (id:{{ $team->id }})</x-slot>
    <h2>{{ $team->name }}(id:{{ $team->id }})</h2>

    <div class="text-end mb-2">
      <a href="{{route('manager.teams.tasks.create', $team)}}" class="btn btn-primary">タスクの新規作成</a>
      <a href="{{route('manager.teams.members.index', $team)}}" class="btn btn-primary">メンバー管理</a>
      <a href="{{ route('manager.teams.edit', $team) }}" class="btn btn-primary">編集</a>
    </div>

    <table class="table table-striped align-middle">
      <thead class="table-light">
          <tr>
              <th scope="col">タスクID</th>
              <th scope="col">タイトル</th>
              <th scope="col">作成日時</th>
              <th scope="col">操作</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($team->tasks as $task)
              <tr>
                  <th scope="row">{{ $task->id }}</th>
                  <td>{{ $task->title }}</td>
                  <td>
                      {{ $task->created_at }}
                  </td>
                  <td>
                    <a href="{{ route('manager.teams.tasks.edit', [$team, $task]) }}" class="btn btn-primary btn-sm">編集</a>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
</x-layout>
