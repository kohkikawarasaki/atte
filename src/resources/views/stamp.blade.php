@extends('layouts/app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/stamp.css') }}">
@endsection

@section('content')
    <h2 class="stamp-head">
        {{ $userName }}さんお疲れ様です！
    </h2>

    <div class="stamp-content">
    <form class="stamp-content__work_start" action="/work_start" method="POST">
        @csrf
        <button {{ $canStartWork ? '' : 'disabled' }}>勤務開始</button>
    </form>

    <form class="stamp-content__work_end" action="/work_end" method="POST">
        @csrf
        <button {{ $canEndWork ? '' : 'disabled' }}>勤務終了</button>
    </form>

    <form class="stamp-content__break_start" action="/break_start" method="POST">
        @csrf
        <button {{ $canStartBreak ? '' : 'disabled' }}>休憩開始</button>
    </form>

    <form class="stamp-content__break_end" action="/break_end" method="POST">
        @csrf
        <button {{ $canEndBreak ? '' : 'disabled' }}>休憩終了</button>
    </form>
    </div>
@endsection
