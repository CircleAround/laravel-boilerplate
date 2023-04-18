<x-layout>
    <x-slot name="title">User: (id:{{ $user->id }})/edit</x-slot>
    <h1>Users:edit</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', ['user' => $user]) }}" method="post">
        @csrf
        @method('patch')

        @include('components.admin.user-fields')
        <input type="submit" value="更新">
    </form>
</x-layout>
