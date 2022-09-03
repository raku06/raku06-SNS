@extends('layouts.login')

@section('content')
<form action="{{ url('search')}}" method="GET">
    <input type="search" placeholder="ユーザー名" name="search" value="@if (isset($search)) {{ $search }} @endif">
        <button type="submit">検索</button>
</form>

@foreach ($users as $user)
    <a href="{{ route('users.show', ['user_id' => $users->id]) }}">
        {{ $users-> username }}
    </a>
@endforeach


<div>
<!-- 下記のようにページネーターを記述するとページネートで次ページに遷移しても、検索結果を保持する -->
    {{ $institutions->appends(request()->input())->links() }}
</div>


@endsection
