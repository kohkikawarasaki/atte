@extends('layouts/app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user_list.css') }}">
@endsection

@section('content')
    <div class="attendance-head">
        <p>ユーザー一覧</p>
    </div>

    <table class="attendance-table">
        <tr>
            <th>名前</th>
            <th></th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>
                    <form action="/user_attendance" method="GET">
                    @csrf
                    <input type="hidden" name="userId" value="{{$user->id}}">
                    <button>詳細</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $users->links('vendor.pagination.bootstrap-4') }}
@endsection
