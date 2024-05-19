@extends('layouts/app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
    <h2>会員登録</h2>
    <form class="register-form" action="/register" method="POST">
        @csrf
        <input type="text" name="name" placeholder="名前" value="{{ old('name') }}">
        <p class="register-form__error">
            @error('name')
                {{ $message }}
            @enderror
        </p>
        <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
        <p class="register-form__error">
            @error('email')
                {{ $message }}
            @enderror
        </p>
        <input type="password" name="password" placeholder="パスワード">
        <p class="register-form__error">
            @error('password')
                {{ $message }}
            @enderror
        </p>
        <input type="password" name="password_confirmation" placeholder="確認用パスワード">
        <button type="submit">会員登録</button>
    </form>
    <div class="login-link">
        <p>アカウントをお持ちの方はこちらから</p>
        <a href="/login">ログイン</a>
    </div>
@endsection
