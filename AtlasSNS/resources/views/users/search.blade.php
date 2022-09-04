@extends('layouts.login')

@section('content')
<form action="{{ url('search')}}" method="POST">
  @csrf
    <input type="search" placeholder="ユーザー名" name="search" value="">
        <button type="submit">検索</button>
</form>

@foreach ($users as $user)
    <p>{{ $user-> username }}</p>
@endforeach

@endsection
