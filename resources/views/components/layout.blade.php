<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ? env('APP_NAME') . " - {$title} -" : env('APP_NAME') }}</title>
</head>

<body>
    <header>
        @if (Auth::check())
            @php
                $user = Auth::user();
            @endphp
            <span>すでに{{ $user->name }}としてログイン済みです</span>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <input type="submit" value="ログアウト">
            </form>
        @else
            <a href="{{ route('login') }}">ログイン</a>
        @endif
    </header>
    {{ $slot }}
</body>

</html>
