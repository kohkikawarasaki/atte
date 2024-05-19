@extends('layouts/app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection


@section('content')
    <h2>ログイン</h2>
    <form class="login-form" action="/login" method="POST">
        @csrf
        <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
        <p class="login-form__error">
            @error('email')
                {{ $message }}
            @enderror
        </p>
        <input type="password" name="password" placeholder="パスワード">
        <p class="login-form__error">
            @error('password')
                {{ $message }}
            @enderror
        </p>
        <button type="submit">ログイン</button>
    </form>
    <div class="register-link">
        <p>アカウントをお持ちでない方はこちらから</p>
        <a href="/register">会員登録</a>
    </div>
@endsection
