@extends('layouts.login')

@section('content')
<form action="{{ url('search')}}" method="POST" class="user-search">
  @csrf
    <input type="search" placeholder="ユーザー名" name="search" value="">
    <button type="submit" class="button">
        <img src="/images/search-h2.png" alt="">
        <img src="/images/search.png" alt="">
    </button>
    @if (!empty($search))
    <span class="search-result">検索ワード：{{$search}}</span>
@endif
</form>
    <table>
@foreach ($users as $user)
@if ($user->id !== Auth::user()->id)
    <tr>
              <!-- プロフィール写真 -->
              <td class="user-img">
                <div><img src="{{ asset('storage/'.$user->images)}}" alt="icon"></div>
              </td>
              <!-- アカウント名 -->
              <td class="username">
                <div>{{ $user->username }}</div>
              </td>
          @if ($user->id !== Auth::user()->id)
              <!-- フォローボタン -->
              <td class="follow-btn">
                <div>
                @if (Auth::user()->isFollowing($user->id)) <!-- ボタン切り替えのためのif文 -->
                <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method("DELETE")


                    <button type="submit" class="btn btn-danger">フォロー解除</button>
                </form>
            @else
                <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-primary">フォローする</button>
                </form>
            @endif
                </div>
              </td>
          @endif
@endif
    </tr>
@endforeach
    </table>

@endsection
