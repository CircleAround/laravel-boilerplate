<x-layout>
    <x-slot name="title">Users</x-slot>
    <h1><a href="{{ route('admin.users.index') }}">Admin/Users</a></h1>

    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>actions</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ route('admin.users.show', $user) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>
                  <a href="{{ route('admin.users.edit', $user) }}">edit</a>
                </td>
            </tr>
        @endforeach
    </table>
</x-layout>
