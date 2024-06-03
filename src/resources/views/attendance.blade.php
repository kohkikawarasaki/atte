@extends('layouts/app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
    <div class="attendance-head">
        <form action="/attendance" method="GET">
            @csrf
            <input type="hidden" name="date" value="{{ $date->copy()->subDay()->toDateString() }}">
            <button><</button>
        </form>
        <p>{{ $date->toDateString() }}</p>
        <form action="/attendance" method="GET">
            @csrf
            <input type="hidden" name="date" value="{{ $date->copy()->addDay()->toDateString() }}">
            <button>></button>
        </form>
    </div>

    <table class="attendance-table">
        <tr>
            <th>名前</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>
        @foreach ($StampData as $Stampdatum)
            <tr>
                <td>{{ $Stampdatum['user']->name }}</td>
                <td>{{ $Stampdatum['work']->start_time }}</td>
                <td>{{ $Stampdatum['work']->end_time }}</td>
                <td>{{ $Stampdatum['totalBreakTime'] }}</td>
                <td>{{ $Stampdatum['totalWorkTime'] }}</td>
            </tr>
        @endforeach
    </table>
    {{ $StampData->links('vendor.pagination.bootstrap-4') }}
@endsection
