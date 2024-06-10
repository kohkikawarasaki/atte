@extends('layouts/app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/verify-email.css') }}">
@endsection

@section('content')
    <h2>メールアドレス認証</h2>
    <p>メールアドレスの認証が必要です。</p>
    <p>ご登録されたメールアドレスにお送りした認証メールをご確認ください。</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">認証メールを再送信する</button>
    </form>
@endsection
