<x-layout>
    <x-slot name="title">Users</x-slot>
    <h2><a href="{{ route('admin.users.index') }}">Admin/Users</a></h2>

    <div class="text-end mb-2">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">新規作成</a>
    </div>

    <table class="table table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td><a href="{{ route('admin.users.show', $user) }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm">edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
