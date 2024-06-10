@extends('layouts/app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user_attendance.css') }}">
@endsection

@section('content')
    <div class="attendance-head">
        <p>{{ $userName }}</p>
    </div>

    <table class="attendance-table">
        <tr>
            <th>日付</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>
        @foreach ($stampData as $stampdatum)
            <tr>
                <td>{{ $stampdatum['work']->work_date }}</td>
                <td>{{ $stampdatum['work']->start_time }}</td>
                <td>{{ $stampdatum['work']->end_time }}</td>
                <td>{{ $stampdatum['totalBreakTime'] }}</td>
                <td>{{ $stampdatum['totalWorkTime'] }}</td>
            </tr>
        @endforeach
    </table>
    {{ $stampData->links('vendor.pagination.bootstrap-4') }}
@endsection
