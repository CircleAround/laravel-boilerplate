<x-layout>
    <x-slot:title>Login</x-slot>
    @php
        $user = Auth::user();
    @endphp
    @if ($user)
        <span>すでに{{ $user->name }}としてログイン済みです</span>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label for="email">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
            @endif
        </div>
        <div>
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required>
        </div>
        <div>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">{{ __('Remember Me') }}</label>
        </div>
        <div>
            <button type="submit">{{ __('Login') }}</button>
        </div>
    </form>
</x-layout>
