@extends('layouts/app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/stamp.css') }}">
@endsection


@section('content')

<form action="/logout" method="post">
  @csrf
  <input class="header__link" type="submit" value="logout">
</form>
@endsection
